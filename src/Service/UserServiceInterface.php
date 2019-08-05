<?php
declare(strict_types=1);

namespace App\Service;

use App\Entity\User;

interface UserServiceInterface
{
    /**
     * @return User[]
     */
    public function listUsersFromDatabase(): array;

    /**
     * @var integer $id
     * @return User[]
     */
    public function listUsersExceptIdByDatabase(int $id): array;

    /**
     * @var integer $id
     * @return User|null
     */
    public function selectUserById(int $id): ?User;
}
