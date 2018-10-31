<?php declare(strict_types=1);

namespace App\Exception;

use RuntimeException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class UserNotFoundException extends RuntimeException implements HttpExceptionInterface
{
    public function getStatusCode()
    {
        return 404;
    }

    public function getHeaders()
    {
        return [];
    }
}
