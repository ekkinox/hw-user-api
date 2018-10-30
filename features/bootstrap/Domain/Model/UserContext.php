<?php declare(strict_types=1);

namespace Domain\Model;

use App\Domain\Model\User;
use App\Domain\Model\UserInterface;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use PHPUnit\Framework\Assert;

/**
 * Defines User context.
 */
class UserContext implements Context
{
    /** @var UserInterface */
    private $user;

    /**
     * @When I construct an user object with following business data:
     */
    public function iConstructAnUserObjectWithFollowingBusinessData(TableNode $table)
    {
        $data = $table->getRowsHash();

        $this->user = new User(
            $data['login'],
            $data['password'],
            $data['title'],
            $data['lastname'],
            $data['firstname'],
            $data['gender'],
            $data['email'],
            $data['picture'],
            $data['address']
        );
    }

    /**
     * @Then the user object login must be :login
     */
    public function theUserObjectLoginMustBe($login)
    {
        Assert::assertEquals($login, $this->user->getLogin());
    }

    /**
     * @Then the user object password must be :password
     */
    public function theUserObjectPasswordMustBe($password)
    {
        Assert::assertEquals($password, $this->user->getPassword());
    }

    /**
     * @Then the user object title must be :title
     */
    public function theUserObjectTitleMustBe($title)
    {
        Assert::assertEquals($title, $this->user->getTitle());
    }

    /**
     * @Then the user object lastname must be :lastname
     */
    public function theUserObjectLastnameMustBe($lastname)
    {
        Assert::assertEquals($lastname, $this->user->getLastname());
    }

    /**
     * @Then the user object firstname must be :firstname
     */
    public function theUserObjectFirstnameMustBe($firstname)
    {
        Assert::assertEquals($firstname, $this->user->getFirstname());
    }

    /**
     * @Then the user object gender must be :gender
     */
    public function theUserObjectGenderMustBe($gender)
    {
        Assert::assertEquals($gender, $this->user->getGender());
    }

    /**
     * @Then the user object email must be :email
     */
    public function theUserObjectEmailMustBe($email)
    {
        Assert::assertEquals($email, $this->user->getEmail());
    }

    /**
     * @Then the user object picture must be :picture
     */
    public function theUserObjectPictureMustBe($picture)
    {
        Assert::assertEquals($picture, $this->user->getPicture());
    }

    /**
     * @Then the user object address must be :address
     */
    public function theUserObjectAddressMustBe($address)
    {
        Assert::assertEquals($address, $this->user->getAddress());
    }
}
