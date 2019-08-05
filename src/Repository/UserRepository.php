<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class UserRepository extends ServiceEntityRepository implements UserRepositoryInterface
{
    /**
     * UserRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * @return User[]
     */
    public function getAllUsers(): array
    {
        return $this->findAll();
    }

    /**
     * @param int $id
     * @return User[]
     */
    public function getUserExceptId(int $id): array
    {
        return $this->createQueryBuilder('user')
            ->where('user.id <> :userId')
            ->setParameter('userId', $id)
            ->getQuery()
            ->getResult()
        ;
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
        return $this->createQueryBuilder('user')
            ->where('user.id = :userId')
            ->setParameter('userId', $id)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }
}
