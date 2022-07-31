<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Guestbook;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class GuestbookFixtures extends Fixture
{
    private $userPasswordHasher;
    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userPasswordHasher = $userPasswordHasher;
    }
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setUsername('admin');   
        $user->setPassword(
            $this->userPasswordHasher->hashPassword(
                $user,
                'admin123'
            )
        );
        $user->setRoles(array('ROLE_ADMIN'));
        $manager->persist($user);
        $manager->flush();
        
        $user2 = new User();
        $user2->setUsername('firstuser');        
        $user2->setPassword(
            $this->userPasswordHasher->hashPassword(
                $user2,
                'first123'
            )
        );
        $user2->setRoles(array('ROLE_USER'));
        $manager->persist($user2);
        $manager->flush();

        $user3 = new User();
        $user3->setUsername('seconduser');        
        $user3->setPassword(
            $this->userPasswordHasher->hashPassword(
                $user3,
                'second123'
            )
        );
        $user3->setRoles(array('ROLE_USER'));
        $manager->persist($user3);
        $manager->flush();
        
        $guestbook = new Guestbook();
        $guestbook->setComment('Lorem Ipsum is simply dummy text of the printing and typesetting industry');
        $guestbook->setApprovalStatus(1);
        $guestbook->setUser($user);
        $manager->persist($guestbook);
        $manager->flush();

        $guestbook = new Guestbook();
        $guestbook->setComment('Lorem Ipsum is simply dummy text of the printing and typesetting industry');
        $guestbook->setUser($user2);
        $manager->persist($guestbook);
        $manager->flush();

        $guestbook = new Guestbook();
        $guestbook->setComment('Lorem Ipsum is simply dummy text of the printing and typesetting industry');
        $guestbook->setUser($user3);
        $guestbook->setApprovalStatus(1);
        $manager->persist($guestbook);
        $manager->flush();

        $guestbook = new Guestbook();
        $guestbook->setComment('Lorem Ipsum is simply dummy text of the printing and typesetting industry');
        $guestbook->setApprovalStatus(1);
        $guestbook->setUser($user);
        $manager->persist($guestbook);
        $manager->flush();

        $guestbook = new Guestbook();
        $guestbook->setComment('Lorem Ipsum is simply dummy text of the printing and typesetting industry');
        $guestbook->setApprovalStatus(1);
        $guestbook->setUser($user2);
        $manager->persist($guestbook);
        $manager->flush();

        $guestbook = new Guestbook();
        $guestbook->setComment('Lorem Ipsum is simply dummy text of the printing and typesetting industry');
        $guestbook->setApprovalStatus(1);
        $guestbook->setUser($user);
        $manager->persist($guestbook);
        $manager->flush();

        $guestbook = new Guestbook();
        $guestbook->setComment('Lorem Ipsum is simply dummy text of the printing and typesetting industry');
        $guestbook->setApprovalStatus(1);
        $guestbook->setUser($user2);
        $manager->persist($guestbook);
        $manager->flush();

        $guestbook = new Guestbook();
        $guestbook->setComment('Lorem Ipsum is simply dummy text of the printing and typesetting industry');
        $guestbook->setApprovalStatus(1);
        $guestbook->setUser($user3);
        $manager->persist($guestbook);
        $manager->flush();

        $guestbook = new Guestbook();
        $guestbook->setComment('Lorem Ipsum is simply dummy text of the printing and typesetting industry');
        $guestbook->setUser($user3);
        $guestbook->setApprovalStatus(1);
        $manager->persist($guestbook);
        $manager->flush();

        $guestbook = new Guestbook();
        $guestbook->setComment('Lorem Ipsum is simply dummy text of the printing and typesetting industry');
        $guestbook->setApprovalStatus(1);
        $guestbook->setUser($user);
        $manager->persist($guestbook);
        $manager->flush();

        $guestbook = new Guestbook();
        $guestbook->setComment('Lorem Ipsum is simply dummy text of the printing and typesetting industry');
        $guestbook->setApprovalStatus(1);
        $guestbook->setUser($user2);
        $manager->persist($guestbook);
        $manager->flush();

        $guestbook = new Guestbook();
        $guestbook->setComment('Lorem Ipsum is simply dummy text of the printing and typesetting industry');
        $guestbook->setApprovalStatus(1);
        $guestbook->setUser($user3);
        $manager->persist($guestbook);
        $manager->flush();

        $guestbook = new Guestbook();
        $guestbook->setComment('Lorem Ipsum is simply dummy text of the printing and typesetting industry');
        $guestbook->setUser($user3);
        $manager->persist($guestbook);
        $manager->flush();
    }
}
