<?php

declare(strict_types=1);

namespace Cfi\Application\EventListener;


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ViewEvent;

class MissingResponseListener
{
    public function onKernelView(ViewEvent $event): void
    {
        if (null === $event->getControllerResult()) {
            $event->setResponse(new JsonResponse(null));
        }
    }
}
