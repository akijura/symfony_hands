<?php

namespace App\DataFixtures;

use App\Entity\MicroPost;
use App\Entity\User;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $userPasswordHasher
    )
    {

    } 
    public function load(ObjectManager $manager): void
    {
        $user1 = new User();
        $user1->setEmail('test@test.com');
        $user1->setPassword(
            $this->userPasswordHasher->hashPassword(
                $user1,
                '123'
            )
            );
        $manager->persist($user1);

        $user2 = new User();
        $user2->setEmail('john@test.com');
        $user2->setPassword(
            $this->userPasswordHasher->hashPassword(
                $user2,
                '123'
            )
            );
        $manager->persist($user2);

        $micro_post = new MicroPost;
        $micro_post->setTitle('Welcone to Poland');
        $micro_post->setText('Welcome to Poland');
        $micro_post->setCreated(new DateTime());
        $micro_post->setAuthor($user1);
        $micro_post->setExtraPrivacy(false);
        $manager->persist($micro_post);

        $micro_post2 = new MicroPost;
        $micro_post2->setTitle('Welcone to Germany');
        $micro_post2->setText('Welcome to Germany');
        $micro_post2->setCreated(new DateTime());
        $micro_post2->setAuthor($user2);
        $micro_post2->setExtraPrivacy(false);
        $manager->persist($micro_post2);

        $micro_post3 = new MicroPost;
        $micro_post3->setTitle('Welcone to Uzb');
        $micro_post3->setText('Welcome to Uzb');
        $micro_post3->setCreated(new DateTime());
        $micro_post3->setAuthor($user1);
        $micro_post3->setExtraPrivacy(false);
        $manager->persist($micro_post3);

        $manager->flush();
    }
}
