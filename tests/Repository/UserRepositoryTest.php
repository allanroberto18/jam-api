<?php
declare(strict_types=1);

namespace App\Tests\Repository;

use App\Entity\User;
use App\Repository\UserRepositoryInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class UserRepositoryTest extends TestCase
{
    /** @var MockObject */
    private $repository;

    protected function setUp()
    {
        parent::setUp();

        $this->repository = $this->getMockBuilder(UserRepositoryInterface::class)->getMock();
    }

    public function testGetAllUsers(): void
    {
        $listMocked = [
            0 => $this->getEntityMocked(1),
            1 => $this->getEntityMocked(2),
            2 => $this->getEntityMocked(3)
        ];

        $this->repository->expects($this->any())->method('getAllUsers')->willReturn($listMocked);
        $list = $this->repository->getAllUsers();

        $this->assertEquals(sizeof($list), sizeof($listMocked));
    }

    public function testGetAllUsersExceptedId(): void
    {
        $listMocked = [
            1 => $this->getEntityMocked(2),
            2 => $this->getEntityMocked(3)
        ];

        $this->repository->expects($this->any())->method('getUserExceptId')->willReturn($listMocked);
        $list = $this->repository->getUserExceptId(1);

        $this->assertEquals(sizeof($list), sizeof($listMocked));
    }

    /**
     * @depends testInsertUser
     */
    public function testGetUserById(): void
    {
        $entityMocked = $this->getEntityMocked(1);

        $this->repository
            ->expects($this->any())
            ->method('getUserById')
            ->willReturn($entityMocked);

        $entity = $this->repository->getUserById(1);

        $this->assertEquals($entity->getId(), $entityMocked->getId());
        $this->assertEquals($entity->getUserName(), $entityMocked->getUserName());
        $this->assertEquals($entity->getEmail(), $entityMocked->getEmail());
    }

    /**
     * @param int|null $id
     * @return MockObject
     */
    private function getEntityMocked(?int $id): MockObject
    {
        $entityMocked = $this->getMockBuilder(User::class)->disableOriginalConstructor()->getMock();
        if (empty($id) === false) {
            $entityMocked->expects($this->any())->method('getId')->willReturn($id);
        }

        $entityMocked->expects($this->any())->method('getUserName')->willReturn(sprintf('user%d test', $id));
        $entityMocked->expects($this->any())->method('getEmail')->willReturn(sprintf('user%d@test.com', $id));

        return $entityMocked;
    }
}
