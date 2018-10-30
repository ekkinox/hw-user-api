<?php

namespace spec\App\Domain\Collection;

use App\Domain\Collection\UserCollection;
use App\Domain\Collection\UserCollectionInterface;
use App\Domain\Model\User;
use App\Domain\Model\UserInterface;
use PhpSpec\ObjectBehavior;

class UserCollectionSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith([]);
    }

    function it_is_initializable()
    {
        $this->shouldImplement(UserCollection::class);
    }

    function it_implements_UserCollectionInterface()
    {
        $this->shouldImplement(UserCollectionInterface::class);
    }

    function it_is_empty_by_default()
    {
        $this->all()->shouldBeArray();
        $this->all()->shouldReturn([]);
    }

    function it_can_be_constructed_with_users()
    {
        $user1 = $this->createUser(['login' => 'user1']);
        $user2 = $this->createUser(['login' => 'user2']);

        $this->beConstructedWith([$user1, $user2]);

        $this->all()->shouldBeArray();
        $this->all()->shouldReturn([$user1, $user2]);
    }

    function it_can_add_users()
    {
        $user1 = $this->createUser(['login' => 'user1']);
        $user2 = $this->createUser(['login' => 'user2']);

        $this->beConstructedWith([$user1]);

        $this->all()->shouldBeArray();
        $this->all()->shouldReturn([$user1]);

        $this->add($user2)->shouldReturn($this);

        $this->all()->shouldBeArray();
        $this->all()->shouldReturn([$user1, $user2]);
    }

    function it_can_add_and_retrieve_users()
    {
        $user = $this->createUser(['login' => 'user']);

        $this->add($user)->shouldReturn($this);
        $this->add($user)->shouldReturn($this);

        $this->get('user')->shouldReturnAnInstanceOf(UserInterface::class);
        $this->get('user')->shouldReturn($user);
    }

    function createUser(array $data): UserInterface
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
