<?php
declare(strict_types=1);

namespace App\Service;

use App\Entity\Invitation;
use App\Repository\InvitationRepositoryInterface;

class InvitationService implements InvitationServiceInterface
{
    /** @var InvitationRepositoryInterface $repository */
    private $repository;

    /**
     * InvitationService constructor.
     * @param InvitationRepositoryInterface $repository
     */
    public function __construct(InvitationRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param integer $userSenderId
     * @return array
     */
    public function listInvitationsBySender(int $userSenderId): array
    {
        return $this->repository->getInvitationsBySender($userSenderId);
    }

    /**
     * @param integer $userInvitedId
     * @return array
     */
    public function listInvitationsByInvited(int $userInvitedId): array
    {
        return $this->repository->getInvitationsByInvited($userInvitedId);
    }

    /**
     * @param integer $invitation
     * @param integer $state
     * @throws \Exception
     */
    public function updateInvitationStatus(int $invitation, int $state): void
    {
        $this->repository->updateStateOfInvitation($invitation, $state);
    }
}
