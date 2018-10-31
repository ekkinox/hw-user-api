<?php declare(strict_types=1);

namespace App\Action;

use App\Repository\UserRepository;
use App\Responder\SerializerResponder;
use App\Validator\ListUsersRequestValidator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Throwable;

class ListUsersAction
{
    /** @var ListUsersRequestValidator */
    private $validator;

    /** @var UserRepository */
    private $repository;

    /** @var SerializerResponder */
    private $responder;

    public function __construct(
        ListUsersRequestValidator $validator,
        UserRepository $repository,
        SerializerResponder $responder
    ) {
        $this->validator = $validator;
        $this->repository = $repository;
        $this->responder = $responder;
    }

    public function __invoke(Request $request): JsonResponse
    {
        try {
            return $this->responder->createJsonResponse(
                $this->repository->findBy($this->validator->getValidatedData($request))
            );
        } catch (Throwable $exception) {
            return $this->responder->createErrorJsonResponse($exception);
        }
    }
}
