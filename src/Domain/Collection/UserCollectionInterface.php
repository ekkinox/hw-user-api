<?php declare(strict_types=1);

namespace App\Domain\Collection;

use App\Domain\Model\UserInterface;

interface UserCollectionInterface
{
    /** @return UserInterface[] */
    public function all(): array;

    public function add(UserInterface $user);

    public function get(string $userId): ?UserInterface;
}
