<?php declare(strict_types=1);

namespace App\Domain\Collection;

use App\Domain\Model\UserInterface;

class UserCollection implements UserCollectionInterface
{
    /** @var UserInterface[] */
    private $users = [];

    public function __construct(array $users)
    {
        foreach ($users as $user) {
            $this->add($user);
        }
    }

    public function all(): array
    {
        return array_values($this->users);
    }

    public function add(UserInterface $user): self
    {
        $this->users[$user->getId()] = $user;

        return $this;
    }

    public function get(string $userId): ?UserInterface
    {
        return $this->users[$userId] ?? null;
    }
}
