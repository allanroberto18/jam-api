<?php
declare(strict_types=1);

namespace App\Service;

use App\Entity\Invitation;

interface InvitationServiceInterface
{
    /**
     * @param integer $userSenderId
     * @return Invitation[]
     */
    public function listInvitationsBySender(int $userSenderId): array;

    /**
     * @param integer $userInvitedId
     * @return Invitation[]
     */
    public function listInvitationsByInvited(int $userInvitedId): array;

    /**
     * @param integer $invitation
     * @param integer $state
     */
    public function updateInvitationStatus(int $invitation, int $state): void;
}
