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

    public function testItCanFindAnUserById()
    {
        $subject = new UserRepository($this->createUserCollection([
            [
                'login' => 'user',
                'firstname' => 'firstname'
            ]
        ]));

        $result = $subject->find('user');

        $this->assertEquals('user', $result->getId());
        $this->assertEquals('user', $result->getLogin());
        $this->assertEquals('firstname', $result->getFirstname());
    }

    public function testItCanFindAnUserByCriteriaWithoutPagination()
    {
        $subject = new UserRepository($this->createUserCollection([
            [
                'login' => 'someuser1'
            ],
            [
                'login' => 'someuser2'
            ],
            [
                'login' => 'someuser3'
            ]
        ]));

        $results = $subject->findBy(['login' => 'user']);

        $this->assertCount(3, $results);
    }

    public function testItCanFindAnUserByCriteriaWithPagination()
    {
        $subject = new UserRepository($this->createUserCollection([
            [
                'login' => 'someuser1',
                'firstname' => 'firstname1'
            ],
            [
                'login' => 'someuser2',
                'firstname' => 'firstname2'
            ],
            [
                'login' => 'someuser3',
                'firstname' => 'firstname3'
            ]
        ]));

        $results = $subject->findBy([
            'login' => 'user',
            'offset' => 1,
            'limit' => 1,
        ]);

        $this->assertCount(1, $results);

        $result = current($results);

        $this->assertEquals('someuser2', $result->getId());
        $this->assertEquals('someuser2', $result->getLogin());
        $this->assertEquals('firstname2', $result->getFirstname());
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