<?php
declare(strict_types=1);

namespace App\Tests\Repository;

use App\Entity\User;
use App\Service\UserServiceInterface;
use PHPUnit\Framework\MockObject\MockObject;

class ListUsersTest extends DataFixturesTestCase
{
    /**
     * @var UserServiceInterface
     */
    protected $service;

    public function setUp()
    {
        parent::setUp();
    }

    public function testUserRespository(): void
    {
        // getAll
        $users = $this->entityManager->getRepository(User::class)->getAllUsers();
        $this->assertEquals(3, sizeof($users));

        // getAllExceptId $id
        $id = 1;
        $usersMocked = [
            0 => $this->mockUser(2),
            1 => $this->mockUser(3),
        ];

        $users = $this->entityManager->getRepository(User::class)->getUserExceptId($id);
        for ($i = 0; $i < sizeof($users); $i++) {
            if ($users[$i]->getId() === $id) {
                throwException('User cannot be inside this list');
            }

            $this->assertEquals($usersMocked[$i]->getId(), $users[$i]->getId());
        }

        // Test getUserById
        $id = 1;
        $userMocked = $this->mockUser($id);

        $user = $this->entityManager->getRepository(User::class)->getUserById($id);

        $this->assertEquals($userMocked->getId(), $user->getId());
    }
}
