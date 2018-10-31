<?php declare(strict_types=1);

namespace App\Validator;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;
use Symfony\Component\Validator\Constraints\Length;

class ListUsersRequestValidator extends AbstractRequestValidator
{
    protected function getRequestData(Request $request): array
    {
        return [
            'login' => $request->get('login'),
            'offset' => $request->get('offset'),
            'limit' => $request->get('limit'),
        ];
    }

    protected function getRequestValidationConstraint(): Constraint
    {
        return new Collection([
            'login' => new Length(['min' => 1]),
            'offset' => new GreaterThanOrEqual(0),
            'limit' => new GreaterThanOrEqual(0),
        ]);
    }
}
