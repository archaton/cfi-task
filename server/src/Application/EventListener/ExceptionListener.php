<?php

declare(strict_types=1);

namespace Cfi\Application\EventListener;

use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\Messenger\Exception\ValidationFailedException;
use Symfony\Component\Validator\ConstraintViolation;

class ExceptionListener
{
    private SerializerInterface $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function onKernelException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();

        if ($exception instanceof ValidationFailedException) {
            $errors = [];
            foreach ($exception->getViolations() as $violation) {
                /* @var ConstraintViolation $violation */
                $errors[] = [
                    'code' => $violation->getCode(),
                    'field' => $violation->getPropertyPath(),
                    'message' => $violation->getMessage(),
                ];
            }
            $content = $this->serializer->serialize(['errors' => $errors], 'json');
            $response = new JsonResponse($content, Response::HTTP_BAD_REQUEST, [], true);
            $event->setResponse($response);
        }
    }
}
