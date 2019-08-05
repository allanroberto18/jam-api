<?php
declare(strict_types=1);

namespace App\Service;

use App\Entity\Invitation;
use App\Repository\InvitationRepositoryInterface;

class InvitationService implements InvitationServiceInterface
{
    /** @var InvitationRepositoryInterface $repository */
    private $repository;

    /** @var UserServiceInterface $userService */
    private $userService;

    /**
     * InvitationService constructor.
     * @param InvitationRepositoryInterface $repository
     * @param UserServiceInterface $userService
     */
    public function __construct(InvitationRepositoryInterface $repository, UserServiceInterface $userService)
    {
        $this->repository = $repository;
        $this->userService = $userService;
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

    /**
     * @param integer $userSender
     * @param integer $userInvited
     * @return Invitation
     * @throws \Exception
     */
    public function sendInvitation(int $userSender, int $userInvited): Invitation
    {
        $sender = $this->userService->selectUserById($userSender);
        if (empty($sender) === true) {
            throw new \Exception('User Sender not found', 400);
        }

        $invited = $this->userService->selectUserById($userInvited);
        if (empty($invited) === true) {
            throw new \Exception('User Invited not found', 400);
        }

        return $this->repository->sendInvitation($sender, $invited);
    }


}
