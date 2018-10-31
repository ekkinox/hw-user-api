<?php declare(strict_types=1);

namespace App\Tests\Unit\Exception;

use App\Exception\RequestValidationException;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class RequestValidationExceptionTest extends TestCase
{
    /** @var RequestValidationException */
    private $subject;

    public function setUp()
    {
        $this->subject = new RequestValidationException();
    }

    public function testImplementation()
    {
        $this->assertInstanceOf(HttpExceptionInterface::class, $this->subject);
    }

    public function testStatusCode()
    {
        $this->assertEquals(400, $this->subject->getStatusCode());
    }

    public function testHeaders()
    {
        $this->assertEquals([], $this->subject->getHeaders());
    }
}