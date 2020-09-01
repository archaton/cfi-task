<?php

declare(strict_types=1);

namespace Cfi\Application\Command\CreateUser;


use Cfi\Application\Bus\Command;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

class CreateUserCommand implements Command
{
    /**
     * @var string
     * @Serializer\Type("string")
     * @Assert\NotBlank()
     * @Assert\Type("string")
     * @Assert\Uuid()
     */
    private $userId;

    public function __construct(string $userId)
    {
        $this->userId = $userId;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

}
