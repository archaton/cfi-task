<?php

declare(strict_types=1);

namespace Cfi\Infrastructure\Doctrine\DBAL\Type;


use Cfi\Domain\ValueObject\WordId;

class WordIdType extends UuidType
{

    protected function getClassName(): string
    {
        return WordId::class;
    }

    public function getName()
    {
        return 'wordId';
    }
}
