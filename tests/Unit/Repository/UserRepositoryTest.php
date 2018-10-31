<?php declare(strict_types=1);

namespace App\Tests\Unit\Repository;

use App\Domain\Collection\UserCollection;
use App\Domain\Collection\UserCollectionInterface;
use App\Domain\Model\User;
use App\Domain\Model\UserInterface;
use App\Repository\UserRepository;
use PHPUnit\Framework\TestCase;

class UserRepositoryTest extends TestCase
{
    /**
     * @expectedException \App\Exception\UserNotFoundException
     * @expectedExceptionMessage User with id 'invalid' cannot be found.
     */
    public function testItCannotFindANonExistingUser()
    {
        $subject = new UserRepository($this->createUserCollection());

        $subject->find('invalid');
    }

    public function testItCanFindAnUser()
    {
        $subject = new UserRepository($this->createUserCollection([
            [
                'login' => 'user1',
                'firstname' => 'firstname'
            ]
        ]));

        $result = $subject->find('user1');

        $this->assertEquals('user1', $result->getId());
        $this->assertEquals('user1', $result->getLogin());
        $this->assertEquals('firstname', $result->getFirstname());
    }


    private function createUserCollection(array $data = []): UserCollectionInterface
    {
        return new UserCollection(array_map(
           function (array $userData): UserInterface {
               return $this->createUser($userData);
           },
           $data
        ));
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