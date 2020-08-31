<?php

declare(strict_types=1);

namespace Cfi\Infrastructure\Doctrine\DBAL\Type;


use Doctrine\DBAL\Platforms\AbstractPlatform;

abstract class UuidType extends AbstractType
{
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform): string
    {
        return 'uuid';
    }
}
