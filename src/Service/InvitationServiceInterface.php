<?php
declare(strict_types=1);

namespace App\Service;

use App\Entity\Invitantion;

interface InvitationServiceInterface
{
    /**
     * @param integer $userSenderId
     * @return Invitantion[]
     */
    public function listInvitationsBySender(int $userSenderId): array;

    /**
     * @param integer $userInvitedId
     * @return Invitantion[]
     */
    public function listInvitationsByInvited(int $userInvitedId): array;

    /**
     * @param integer $invitation
     * @param integer $state
     */
    public function updateInvitationStatus(int $invitation, int $state): void;
}
