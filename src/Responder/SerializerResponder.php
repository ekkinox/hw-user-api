<?php declare(strict_types=1);

namespace App\Responder;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Throwable;

class SerializerResponder
{
    /** @var SerializerInterface */
    private $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function createJsonResponse($data, int $statusCode = 200, array $headers = []): JsonResponse
    {
        return JsonResponse::fromJsonString(
            $this->serializer->serialize($data, 'json'),
            $statusCode,
            $headers
        );
    }

    public function createErrorJsonResponse(Throwable $exception, int $statusCode = 500, array $headers = []): JsonResponse
    {
        $exceptionData = [
            'message' => $exception->getMessage(),
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
        ];

        return JsonResponse::fromJsonString(
            $this->serializer->serialize($exceptionData, 'json'),
            $exception instanceof HttpExceptionInterface ? $exception->getStatusCode() : $statusCode,
            $exception instanceof HttpExceptionInterface ? $exception->getHeaders() : $headers
        );
    }
}
