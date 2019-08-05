<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\Invitantion;

interface InvitationRepositoryInterface
{
    /**
     * @param integer $userId
     * @return Invitantion[]
     */
    public function getInvitationsBySender(int $userId): array;

    /**
     * @param integer $userId
     * @return Invitantion[]
     */
    public function getInvitationsByInvited(int $userId): array;

    /**
     * @param integer $invitation
     * @param integer $state
     * @throws \Exception
     */
    public function updateStateOfInvitation(int $invitation, int $state): void;
}
