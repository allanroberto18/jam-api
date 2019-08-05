<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\Invitation;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class InvitationRepository extends ServiceEntityRepository implements InvitationRepositoryInterface
{
    /**
     * InvitationRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Invitation::class);
    }

    /**
     * @param integer $userId
     * @return Invitation[]
     */
    public function getInvitationsBySender(int $userId): array
    {
        return $this->createQueryBuilder('invitation')
            ->join('invitation.userSender', 'userSender')
            ->where('userSender.id = :userSenderId')
            ->setParameter('userSenderId', $userId)
            ->orderBy('invitation.state', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @param integer $userId
     * @return Invitation[]
     */
    public function getInvitationsByInvited(int $userId): array
    {
        return $this->createQueryBuilder('invitation')
            ->join('invitation.userInvited', 'userInvited')
            ->where('userInvited.id = :userInvitedId')
            ->orderBy('invitation.state', 'ASC')
            ->setParameter('userInvitedId', $userId)
            ->getQuery()
            ->getResult();
    }

    /**
     * @param integer $invitation
     * @param integer $state
     * @throws \Exception
     */
    public function updateStateOfInvitation(int $invitation, int $state): void
    {
        /** @var Invitation $invitation */
        $invitation = $this->find($invitation);
        if (empty($invitation) === true) {
            throw new \Exception('Invitation not found');
        }

        $invitation->setState($state);

        $this->getEntityManager()->flush();
    }

    /**
     * @param User $userSender
     * @param User $userInvited
     * @return Invitation
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function sendInvitation(User $userSender, User $userInvited): Invitation
    {
        $invitation = new Invitation($userSender, $userInvited);

        $this->getEntityManager()->persist($invitation);
        $this->getEntityManager()->flush();

        return $invitation;
    }


}
