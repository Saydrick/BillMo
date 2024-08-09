<?php 

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class ExceptionSubscriber implements EventSubscriberInterface
{
    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        if ($exception instanceof HttpExceptionInterface) {
            $data = [
                'status' => $exception->getStatusCode(),
                'message' => $exception->getMessage(),
            ];
            $statusCode = $exception->getStatusCode();
        } else {
            $data = [
                'status' => 500,
                'message' => 'An unexpected error occurred',
            ];
            $statusCode = 500;
        }

        $response = new JsonResponse($data);
        $response->setStatusCode($statusCode);
        $response->headers->set('Content-Type', 'application/json'); // Forcer le JSON

        $event->setResponse($response);
    }

    public static function getSubscribedEvents(): array
    {
        return [
            'kernel.exception' => ['onKernelException', 255], // Priorité élevée
        ];
    }
}
