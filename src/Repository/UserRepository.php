<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\User;
use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository implements UserRepositoryInterface
{
    /**
     * @return array
     */
    public function getAllUsers(): array
    {
        return $this->findAll();
    }

    /**
     * @param integer $id
     * @return User|null
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function getUserById(int $id): ?User
    {
        return $this->getEntityManager()->find($id);
    }

    /**
     * @param User $user
     * @return User
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function insertUser(User $user): User
    {
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();

        return $user;
    }

    /**
     * @param integer $id
     * @param User $user
     * @return User
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function updateUser(int $id, User $user): User
    {
        $model = $this->getUserById($id);
        if (empty($user) === true) {
            return $this->insertUser($user);
        }

        $model->setUserName($user->getUserName());
        $model->setEmail($user->getEmail());

        $this->getEntityManager()->persist($model);
        return $user;
    }

    /**
     * @param integer $id
     * @return void
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete(int $id): void
    {
        $user = $this->find($id);
        if (empty($user) === true) {
            return;
        }

        $this->getEntityManager()->remove($user);
        $this->getEntityManager()->flush();
    }


}
