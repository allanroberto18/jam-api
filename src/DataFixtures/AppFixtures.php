<?php

namespace App\DataFixtures;

use App\Entity\Invitation;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user0 = new User('user 0', 'user0@jam-api.com');
        $manager->persist($user0);

        $user1 = new User('user 1', 'user1@jam-api.com');
        $manager->persist($user1);

        $user2 = new User('user 2', 'user2@jam-api.com');
        $manager->persist($user2);

        $invitation01 = new Invitation($user0, $user1);
        $manager->persist($invitation01);

        $invitation02 = new Invitation($user0, $user2);
        $manager->persist($invitation02);

        $invitation10 = new Invitation($user1, $user0);
        $manager->persist($invitation10);

        $invitation12 = new Invitation($user1, $user2);
        $manager->persist($invitation12);

        $invitation20 = new Invitation($user2, $user0);
        $manager->persist($invitation20);

        $invitation21 = new Invitation($user2, $user1);
        $manager->persist($invitation21);

        $manager->flush();
    }
}
