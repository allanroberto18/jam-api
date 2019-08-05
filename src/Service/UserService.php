<?php
declare(strict_types=1);

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepositoryInterface;

class UserService implements UserServiceInterface
{
    /** @var UserRepositoryInterface $userRepository */
    private $userRepository;

    /**
     * UserService constructor.
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @return User[]
     */
    public function listUsersFromDatabase(): array
    {
        return $this->userRepository->getAllUsers();
    }

    /**
     * @param integer $id
     * @return User[]
     */
    public function listUsersExceptIdByDatabase(int $id): array
    {
        return $this->userRepository->getUserExceptId($id);
    }

    /**
     * @param integer $id
     * @return User|null
     */
    public function selectUserById(int $id): ?User
    {
        return $this->userRepository->getUserById($id);
    }
}
