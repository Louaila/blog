<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Commentaires;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i=0; $i<20; $i++) {
            // création des nouveaux objets correspondants aux entités
            $commentaire = new Commentaires();

            //Commentaires
            $randomString = $this->getString();
            $commentaire->setTitle($randomString);
            $randomString = $this->getString();
            $commentaire->setContent($randomString);
            $commentaire->setDateCreation(new \DateTime);
            $randomString = $this->getString();
            $commentaire->setCategory($randomString);
            $manager->persist($commentaire);

        }

        $manager->flush();
    }

    function getString() {
        $n = rand(5, 30);
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return $randomString;
    }

}