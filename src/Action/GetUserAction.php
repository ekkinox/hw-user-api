<?php declare(strict_types=1);

namespace App\Action;

use App\Repository\UserRepository;
use App\Responder\SerializerResponder;
use Symfony\Component\HttpFoundation\JsonResponse;
use Throwable;

class GetUserAction
{
    /** @var UserRepository */
    private $repository;

    /** @var SerializerResponder */
    private $responder;

    public function __construct(UserRepository $repository, SerializerResponder $responder)
    {
        $this->repository = $repository;
        $this->responder = $responder;
    }

    public function __invoke(string $userId): JsonResponse
    {
        try {
            return $this->responder->createJsonResponse(
                $this->repository->find($userId)
            );
        } catch (Throwable $exception) {
            return $this->responder->createErrorJsonResponse($exception);
        }
    }
}
