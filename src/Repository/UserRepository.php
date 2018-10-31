<?php declare(strict_types=1);

namespace App\Repository;

use App\Domain\Collection\UserCollectionInterface;
use App\Domain\Model\UserInterface;
use App\Exception\UserNotFoundException;

class UserRepository
{
    /** @var UserCollectionInterface */
    private $userCollection;

    public function __construct(UserCollectionInterface $userCollection)
    {
        $this->userCollection = $userCollection;
    }

    /**
     * @throws UserNotFoundException
     */
    public function find(string $userId): UserInterface
    {
        $user = $this->userCollection->get($userId);

        if (null === $user) {
            throw new UserNotFoundException(sprintf("User with id '%s' cannot be found.", $userId));
        }

        return $user;
    }
}