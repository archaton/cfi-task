<?php

declare(strict_types=1);

namespace Cfi\Infrastructure\Doctrine\DBAL\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use InvalidArgumentException;
use TypeError;

abstract class AbstractType extends Type
{
    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        if (null === $value) {
            return null;
        }
        if (!is_a($value, $this->getClassName())) {
            throw new InvalidArgumentException(sprintf("Expected '%s', got '%s'", $this->getClassName(), \is_object($value) ? \get_class($value) : \gettype($value)));
        }

        return (string) $value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if (null === $value) {
            return null;
        }

        $className = $this->getClassName();

        try {
            return new $className($value);
        } catch (TypeError $e) {
            try {
                return new $className((int) $value);
            } catch (TypeError $e) {
                if (method_exists($className, 'createFromString')) {
                    return $className::createFromString($value);
                }

                throw $e;
            }
        }
    }

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform): string
    {
        return $platform->getVarcharTypeDeclarationSQL($fieldDeclaration);
    }

    abstract protected function getClassName(): string;
}
