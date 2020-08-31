<?php

declare(strict_types=1);

namespace Cfi\Application\Command\AddText;

use Cfi\Application\Bus\Command;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

class AddTextCommand implements Command
{
    /**
     * @var null|string
     * @Serializer\Type("string")
     * @Assert\NotBlank()
     * @Assert\Type("string")
     */
    private ?string $text;

    public function __construct(?string $text)
    {
        $this->text = $text;
    }

    public function getText(): string
    {
        return $this->text;
    }
}
