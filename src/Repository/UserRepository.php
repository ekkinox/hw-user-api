<?php declare(strict_types=1);

namespace App\Repository;

use App\Domain\Collection\UserCollectionInterface;
use App\Domain\Model\UserInterface;
use App\Exception\UserNotFoundException;

class UserRepository
{
    private const DEFAULT_OFFSET = 0;
    private const DEFAULT_LIMIT = 100;

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

    /**
     * @return UserInterface[]
     */
    public function findBy(array $criteria): array
    {
        $users = $this->userCollection->all();

        $users = $this->filterCollectionByLogin($users, $criteria['login'] ?? null);

        return array_slice(
            $users,
            isset($criteria['offset']) ? (int)$criteria['offset'] : self::DEFAULT_OFFSET,
            isset($criteria['limit']) ? (int)$criteria['limit'] : self::DEFAULT_LIMIT
        );
    }

    private function filterCollectionByLogin(array $users, string $loginCriteria = null): array
    {
        if (!empty($loginCriteria)) {
            $users = array_filter($users, function (UserInterface $user) use ($loginCriteria): bool {
                return false !== strpos($user->getLogin(), $loginCriteria);
            });
        }

        return $users;
    }
}
