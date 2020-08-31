<?php

declare(strict_types=1);

namespace Cfi\Infrastructure\Doctrine\DBAL\Type;


use Cfi\Domain\ValueObject\IpAddress;

class IpAddressType extends AbstractType
{
    protected function getClassName(): string
    {
        return IpAddress::class;
    }

    public function getName()
    {
        return 'ipAddress';
    }
}
