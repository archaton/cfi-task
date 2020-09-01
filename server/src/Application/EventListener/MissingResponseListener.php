<?php

declare(strict_types=1);

namespace Cfi\Application\EventListener;

use Cfi\Application\Bus\QueryBus\ApiPresenter;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ViewEvent;

class MissingResponseListener
{
    private SerializerInterface $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function onKernelView(ViewEvent $event): void
    {
        $controllerResult = $event->getControllerResult();
        if (null === $controllerResult) {
            $event->setResponse(new JsonResponse(null));
        }

        if (is_a($controllerResult, ApiPresenter::class)) {
            $content = $this->serializer->serialize($controllerResult, 'json');
            $event->setResponse(new JsonResponse($content, 200, [], true));
        }
    }
}
