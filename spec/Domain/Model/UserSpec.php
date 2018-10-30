<?php

namespace spec\App\Domain\Model;

use App\Domain\Model\User;
use App\Domain\Model\UserInterface;
use PhpSpec\ObjectBehavior;

class UserSpec extends ObjectBehavior
{
    private $login = 'johndoe';
    private $password = 'password';
    private $title = 'mr';
    private $firstname = 'John';
    private $lastname = 'Doe';
    private $gender = 'male';
    private $email = 'john@doe.com';
    private $picture = 'http://example.com/johndoe.jpg';
    private $address = '123 Some Street SomeVille 99999';

    function let()
    {
        $this->beConstructedWith(
            $this->login,
            $this->password,
            $this->title,
            $this->lastname,
            $this->firstname,
            $this->gender,
            $this->email,
            $this->picture,
            $this->address);
    }

    function it_is_initializable()
    {
        $this->shouldImplement(User::class);
    }

    function it_implements_UserInterface()
    {
        $this->shouldImplement(UserInterface::class);
    }

    function it_can_retrieve_login()
    {
        $this->getLogin()->shouldBeString();
        $this->getLogin()->shouldReturn($this->login);
    }

    function it_can_retrieve_password()
    {
        $this->getPassword()->shouldBeString();
        $this->getPassword()->shouldReturn($this->password);
    }

    function it_can_retrieve_title()
    {
        $this->getTitle()->shouldBeString();
        $this->getTitle()->shouldReturn($this->title);
    }

    function it_can_retrieve_lastname()
    {
        $this->getLastname()->shouldBeString();
        $this->getLastname()->shouldReturn($this->lastname);
    }

    function it_can_retrieve_firstname()
    {
        $this->getFirstname()->shouldBeString();
        $this->getFirstname()->shouldReturn($this->firstname);
    }

    function it_can_retrieve_gender()
    {
        $this->getGender()->shouldBeString();
        $this->getGender()->shouldReturn($this->gender);
    }

    function it_can_retrieve_email()
    {
        $this->getEmail()->shouldBeString();
        $this->getEmail()->shouldReturn($this->email);
    }

    function it_can_retrieve_picture()
    {
        $this->getPicture()->shouldBeString();
        $this->getPicture()->shouldReturn($this->picture);
    }

    function it_can_retrieve_address()
    {
        $this->getAddress()->shouldBeString();
        $this->getAddress()->shouldReturn($this->address);
    }
}
