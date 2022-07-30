<?php

namespace App\DataFixtures;

use App\Entity\Guestbook;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class GuestbookFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $guestbook = new Guestbook();
        $guestbook->setUsername('test');
        $guestbook->setComment('This is my first comment');
        $manager->persist($guestbook);

        $guestbook2 = new Guestbook();
        $guestbook2->setUsername('testagain');
        $guestbook2->setComment('This is my second comment');
        $manager->persist($guestbook2);

        $manager->flush();
    }
}
