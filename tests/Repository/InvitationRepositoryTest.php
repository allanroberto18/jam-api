<?php
declare(strict_types=1);

namespace App\Tests\Repository;

use App\Entity\Invitation;
use App\Entity\User;
use App\Repository\InvitationRepositoryInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class InvitationRepositoryTest extends TestCase
{
    /** @var MockObject */
    private $repository;

    protected function setUp()
    {
        parent::setUp();

        $this->repository = $this->getMockBuilder(InvitationRepositoryInterface::class)->getMock();
    }

    public function testGetInvitationsBySender(): void
    {
        $invitations = [
            0 => $this->getMockEntity(1, 1, 2, 0),
            1 => $this->getMockEntity(2, 1, 3, 1),
        ];

        $this->repository->expects($this->any())->method('getInvitationsBySender')->willReturn($invitations);
        $list = $this->repository->getInvitationsBySender(1);

        $this->assertEquals(2, sizeof($list));
    }

    public function testGetInvitationsByInvited(): void
    {
        $invitations = [
            0 => $this->getMockEntity(1, 1, 2, 0),
            1 => $this->getMockEntity(2, 2, 2, 1),
        ];

        $this->repository->expects($this->any())->method('getInvitationsByInvited')->willReturn($invitations);
        $list = $this->repository->getInvitationsByInvited(2);

        $this->assertEquals(2, sizeof($list));
    }

    /**
     * @param integer $id
     * @param integer $sender
     * @param integer $invited
     * @param integer $state
     * @return MockObject
     */
    private function getMockEntity(int $id, int $sender, int $invited, int $state): MockObject
    {
        $sender = $this->getMockBuilder(User::class)->disableOriginalConstructor()->getMock();
        $sender->expects($this->any())->method('getId')->willReturn($sender);

        $invited = $this->getMockBuilder(User::class)->disableOriginalConstructor()->getMock();
        $invited->expects($this->any())->method('getId')->willReturn($invited);

        $invitation = $this->getMockBuilder(Invitation::class)->disableOriginalConstructor()->getMock();
        $invitation->expects($this->any())->method('getId')->willReturn($id);
        $invitation->expects($this->any())->method('getUserSender')->willReturn($sender);
        $invitation->expects($this->any())->method('getUserInvited')->willReturn($invited);
        $invitation->expects($this->any())->method('getState')->willReturn($state);

        return $invitation;
    }
}
