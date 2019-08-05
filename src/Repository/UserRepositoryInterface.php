<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\User;

interface UserRepositoryInterface
{
    /**
     * @return array
     */
    public function getAllUsers(): array;

    /**
     * @var integer $id
     * @return User[]
     */
    public function getUserExceptId(int $id): array;

    /**
     * @param integer $id
     * @return User|null
     */
    public function getUserById(int $id): ?User;
}
