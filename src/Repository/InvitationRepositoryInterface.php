<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\Invitation;

interface InvitationRepositoryInterface
{
    /**
     * @param integer $userId
     * @return Invitation[]
     */
    public function getInvitationsBySender(int $userId): array;

    /**
     * @param integer $userId
     * @return Invitation[]
     */
    public function getInvitationsByInvited(int $userId): array;

    /**
     * @param integer $invitation
     * @param integer $state
     * @throws \Exception
     */
    public function updateStateOfInvitation(int $invitation, int $state): void;
}
