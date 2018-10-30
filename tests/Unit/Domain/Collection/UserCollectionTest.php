<?php declare(strict_types=1);

namespace App\Tests\Unit\Domain\Collection;

use App\Domain\Collection\UserCollection;
use App\Domain\Collection\UserCollectionInterface;
use App\Domain\Model\User;
use App\Domain\Model\UserInterface;
use PHPUnit\Framework\TestCase;

class UserCollectionTest extends TestCase
{
    public function testImplementation()
    {
        $this->assertInstanceOf(UserCollectionInterface::class, new UserCollection([]));
    }

    public function testEmptyConstruction()
    {
        $subject = new UserCollection([]);

        $this->assertCount(0, $subject->all());
    }

    public function testConstructionWithUsers()
    {
        $user1 = $this->createUser(['login' => 'user1']);
        $user2 = $this->createUser(['login' => 'user2']);

        $subject = new UserCollection([$user1, $user2]);

        $this->assertCount(2, $subject->all());
        $this->assertSame([$user1, $user2], $subject->all());
    }

    public function testItCanAddAndRetrieveUsers()
    {
        $user1 = $this->createUser(['login' => 'user1']);
        $user2 = $this->createUser(['login' => 'user2']);

        $subject = new UserCollection([$user1]);

        $this->assertCount(1, $subject->all());

        $subject->add($user2);

        $this->assertCount(2, $subject->all());
        $this->assertSame([$user1, $user2], $subject->all());

        $this->assertSame($user1, $subject->get('user1'));
        $this->assertSame($user2, $subject->get('user2'));
    }

    public function testItCannotRetrieveNonExistingUser()
    {
        $subject = new UserCollection([]);

        $this->assertNull($subject->get('invalid'));
    }

    private function createUser(array $data): UserInterface
    {
        return new User(
            $data['login'] ?? 'login',
            $data['password'] ?? 'password',
            $data['title'] ?? 'title',
            $data['lastname'] ?? 'lastname',
            $data['firstname'] ?? 'firstname',
            $data['gender'] ?? 'gender',
            $data['email'] ?? 'email',
            $data['picture'] ?? 'picture',
            $data['address'] ?? 'address'
        );
    }
}