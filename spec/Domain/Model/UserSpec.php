<?php declare(strict_types=1);

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

    public function let()
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
            $this->address
        );
    }

    public function it_is_initializable()
    {
        $this->shouldImplement(User::class);
    }

    public function it_implements_UserInterface()
    {
        $this->shouldImplement(UserInterface::class);
    }

    public function it_can_retrieve_id()
    {
        // same as id, since we use unique login for id
        $this->getId()->shouldBeString();
        $this->getId()->shouldReturn($this->login);
    }

    public function it_can_retrieve_login()
    {
        $this->getLogin()->shouldBeString();
        $this->getLogin()->shouldReturn($this->login);
    }

    public function it_can_retrieve_password()
    {
        $this->getPassword()->shouldBeString();
        $this->getPassword()->shouldReturn($this->password);
    }

    public function it_can_retrieve_title()
    {
        $this->getTitle()->shouldBeString();
        $this->getTitle()->shouldReturn($this->title);
    }

    public function it_can_retrieve_lastname()
    {
        $this->getLastname()->shouldBeString();
        $this->getLastname()->shouldReturn($this->lastname);
    }

    public function it_can_retrieve_firstname()
    {
        $this->getFirstname()->shouldBeString();
        $this->getFirstname()->shouldReturn($this->firstname);
    }

    public function it_can_retrieve_gender()
    {
        $this->getGender()->shouldBeString();
        $this->getGender()->shouldReturn($this->gender);
    }

    public function it_can_retrieve_email()
    {
        $this->getEmail()->shouldBeString();
        $this->getEmail()->shouldReturn($this->email);
    }

    public function it_can_retrieve_picture()
    {
        $this->getPicture()->shouldBeString();
        $this->getPicture()->shouldReturn($this->picture);
    }

    public function it_can_retrieve_address()
    {
        $this->getAddress()->shouldBeString();
        $this->getAddress()->shouldReturn($this->address);
    }
}
