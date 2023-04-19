<?php

namespace App\DataFixtures;

use App\Entity\MicroPost;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $micro_post = new MicroPost;
        $micro_post->setTitle('Welcone to Poland');
        $micro_post->setText('Welcome to Poland');
        $micro_post->setCreated(new DateTime());
        $manager->persist($micro_post);

        $micro_post2 = new MicroPost;
        $micro_post2->setTitle('Welcone to Germany');
        $micro_post2->setText('Welcome to Germany');
        $micro_post2->setCreated(new DateTime());
        $manager->persist($micro_post2);

        $micro_post3 = new MicroPost;
        $micro_post3->setTitle('Welcone to Uzb');
        $micro_post3->setText('Welcome to Uzb');
        $micro_post3->setCreated(new DateTime());
        $manager->persist($micro_post3);

        $manager->flush();
    }
}
