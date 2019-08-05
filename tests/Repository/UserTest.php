<?php
declare(strict_types=1);

namespace App\Tests\Repository;

use App\Entity\User;
use App\Service\UserServiceInterface;

class UserTest extends DataFixturesTestCase
{
    /**
     * @var UserServiceInterface
     */
    protected $service;

    public function setUp()
    {
        parent::setUp();
    }

    public function testGetAllUsersById(): void
    {
        $id = 1;
        $userMocked = $this->mockUser($id);

        $user = $this->entityManager->getRepository(User::class)->getUserById($id);

        $this->assertEquals($userMocked->getId(), $user->getId());
    }
}
