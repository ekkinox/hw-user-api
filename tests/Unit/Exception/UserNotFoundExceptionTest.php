<?php declare(strict_types=1);

namespace App\Tests\Unit\Exception;

use App\Exception\UserNotFoundException;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class UserNotFoundExceptionTest extends TestCase
{
    /** @var UserNotFoundException */
    private $subject;

    public function setUp()
    {
        $this->subject = new UserNotFoundException();
    }

    public function testImplementation()
    {
        $this->assertInstanceOf(HttpExceptionInterface::class, $this->subject);
    }

    public function testStatusCode()
    {
        $this->assertEquals(404, $this->subject->getStatusCode());
    }

    public function testHeaders()
    {
        $this->assertEquals([], $this->subject->getHeaders());
    }
}