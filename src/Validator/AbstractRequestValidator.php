<?php declare(strict_types=1);

namespace App\Validator;

use App\Exception\RequestValidationException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class AbstractRequestValidator
{
    /** @var ValidatorInterface */
    private $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @throws RequestValidationException
     */
    public function getValidatedData(Request $request): array
    {
        $requestData = $this->getRequestData($request);

        $violations = $this->validator->validate($requestData, $this->getRequestValidationConstraint());

        if ($violations->count() > 0) {
            $messages = [];
            foreach ($violations as $violation) {
                $messages[] = sprintf('%s: %s', $violation->getPropertyPath(), $violation->getMessage());
            }

            throw new RequestValidationException(implode(',', $messages));
        }

        return $requestData;
    }

    abstract protected function getRequestData(Request $request): array;

    abstract protected function getRequestValidationConstraint(): Constraint;
}
