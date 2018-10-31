<?php declare(strict_types=1);

namespace App\Tests\Integration\Validator;

use App\Validator\ListUsersRequestValidator;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ListUsersRequestValidatorTest extends KernelTestCase
{
    /** @var ListUsersRequestValidator */
    private $subject;

    public function setUp()
    {
        parent::setUp();

        static::bootKernel();

        $this->subject = new ListUsersRequestValidator(
            static::$container->get(ValidatorInterface::class)
        );
    }

    /**
     * @expectedException \App\Exception\RequestValidationException
     * @expectedExceptionMessage [offset]: This value should be greater than or equal to 0.
     * @expectedExceptionMessage [limit]: This value should be greater than or equal to 0.
     */
    public function testValidationFailure()
    {
        $this->subject->getValidatedData($this->createRequest('login', -1, -1));
    }

    public function testValidationSuccess()
    {
        $this->assertEquals(
            [
                'login' => 'login',
                'offset' => 1,
                'limit' => 1,
            ],
            $this->subject->getValidatedData($this->createRequest('login', 1, 1))
        );
    }

    private function createRequest($login, $offset, $limit): Request
    {
        return new Request(
            [
                'login' => $login,
                'offset' => $offset,
                'limit' => $limit,
            ]
        );
    }
}