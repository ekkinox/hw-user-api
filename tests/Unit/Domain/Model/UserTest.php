<?php declare(strict_types=1);

namespace App\Tests\Unit\Domain\Model;

use App\Domain\Model\User;
use App\Domain\Model\UserInterface;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testImplementation()
    {
        $this->assertInstanceOf(UserInterface::class, $this->createUser());
    }

    public function testGettersPostConstruction()
    {
        $subject = $this->createUser();

        $this->assertEquals('login', $subject->getId());
        $this->assertEquals('login', $subject->getLogin());
        $this->assertEquals('password', $subject->getPassword());
        $this->assertEquals('title', $subject->getTitle());
        $this->assertEquals('lastname', $subject->getLastname());
        $this->assertEquals('firstname', $subject->getFirstname());
        $this->assertEquals('gender', $subject->getGender());
        $this->assertEquals('email', $subject->getEmail());
        $this->assertEquals('picture', $subject->getPicture());
        $this->assertEquals('address', $subject->getAddress());
    }

    public function testUserLoginIsUsedAsUserId()
    {
        $subject = $this->createUser();

        $this->assertEquals($subject->getLogin(), $subject->getId());
    }

    private function createUser(): UserInterface
    {
        return new User(
            'login',
            'password',
            'title',
            'lastname',
            'firstname',
            'gender',
            'email',
            'picture',
            'address'
        );
    }
}