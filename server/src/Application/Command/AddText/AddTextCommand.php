<?php

declare(strict_types=1);

namespace Cfi\Application\Command\AddText;

use Cfi\Application\Bus\Command;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

class AddTextCommand implements Command
{
    /**
     * @var string
     * @Serializer\Type("string")
     * @Assert\NotBlank()
     * @Assert\Type("string")
     * @Assert\Uuid()
     */
    private $userId;
    /**
     * @var string
     * @Serializer\Type("string")
     * @Assert\NotBlank()
     * @Assert\Type("string")
     */
    private $text;

    public function __construct(string $userId, string $text)
    {
        $this->userId = $userId;
        $this->text = $text;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getText(): string
    {
        return $this->text;
    }
}
