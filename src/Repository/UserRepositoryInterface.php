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
     * @param int $id
     * @return User|null
     */
    public function getUserById(int $id): ?User;

    /**
     * @param User $user
     * @return User
     */
    public function insertUser(User $user): User;

    /**
     * @param int $id
     * @param User $user
     * @return User
     */
    public function updateUser(int $id, User $user): User;

    /**
     * @param int $id
     */
    public function delete(int $id): void;
}
