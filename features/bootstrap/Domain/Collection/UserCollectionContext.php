<?php declare(strict_types=1);

namespace Domain\Collection;

use App\Domain\Model\User;
use Behat\Gherkin\Node\TableNode;
use App\Domain\Collection\UserCollection;
use App\Domain\Collection\UserCollectionInterface;
use Behat\Behat\Context\Context;
use PHPUnit\Framework\Assert;

/**
 * Defines UserCollection context.
 */
class UserCollectionContext implements Context
{
    /** @var UserCollectionInterface */
    private $userCollection;

    /**
     * @When I construct an empty user collection
     */
    public function iConstructAnEmptyUserCollection()
    {
        $this->userCollection = new UserCollection([]);
    }

    /**
     * @Then the user collection has :usersCount users
     */
    public function theUserCollectionHasUsers($usersCount)
    {
        Assert::assertEquals($usersCount, sizeof($this->userCollection->all()));
    }

    /**
     * @When I construct an user collection with following business data:
     */
    public function iConstructAnUserCollectionWithFollowingBusinessData(TableNode $table)
    {
        $users = [];

        foreach ($table->getColumnsHash() as $data) {
            $users[] = new User(
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

        $this->userCollection = new UserCollection($users);
    }

    /**
     * @Then the user form the user collection with id :userId firstname is :firstname
     */
    public function theUserFormTheUserCollectionWithIdFirstnameIs($userId, $firstname)
    {
        Assert::assertEquals($firstname, $this->userCollection->get($userId)->getFirstname());
    }

    /**
     * @Then the user form the user collection with id :userId cannot be found
     */
    public function theUserFormTheUserCollectionWithIdCannotBeFound($userId)
    {
        Assert::assertNull($this->userCollection->get($userId));
    }

    /**
     * @When I add an user to the user collection with following business data:
     */
    public function iAddAnUserToTheUserCollectionWithFollowingBusinessData(TableNode $table)
    {
        $data = $table->getRowsHash();

        $user = new User(
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

        $this->userCollection->add($user);
    }
}
