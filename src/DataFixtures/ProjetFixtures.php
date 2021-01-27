<?php

namespace App\DataFixtures;

use App\Entity\Projet;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProjetFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i=1;$i<5 ;$i++){

       $projet= new Projet();
       $projet->setTitel("titre de projet");
       $projet->setImage("https://cdn.pixabay.com/photo/2019/05/19/10/40/cinema-4213751_960_720.jpg");
       $projet->setDescription("desription du projet");
       $projet->setGithub("lien github");
       $projet->setWeblink("lien du project");

       $manager->persist($projet);

        }

        $manager->flush();
    }
}
