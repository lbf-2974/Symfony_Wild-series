<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public const PROGRAMS = [
        ['title' => "Les 100 lieux qu'il faut voir",
         'synopsis' =>  "La France regorge de trésors naturels, architecturaux, historiques et gastronomiques.",
         'category' =>  "Documentaire"],

         ['title' => "Nus et culottés",
         'synopsis' =>  "Découvrez les aventures de Guillaume Mouton et Nans Thomassey, deux hommes qui réalisent leurs rêves sans vêtements ni argent.",
         'category' =>  "Voyage"],

         ['title' => "Oggy et les cafards",
         'synopsis' =>  "La série relate les aventures déjantées d'un chat bleu anthropomorphe nommé Oggy, vivant aux état-unis dans une immense maison pas comme les autres.",
         'category' =>  "Enfant"],

         ['title' => "Top Gear France",
         'synopsis' =>  "Top Gear France est l'adaptation de l'émission anglaise à succès Top Gear diffusée en Angleterre.",
         'category' =>  "Sport"],

         ['title' => "Shrinking",
         'synopsis' =>  "Jimmy peine à se remettre du décès de sa femme tout en assumant ses responsabilités de père, ami et psychologue. Il tente une nouvelle approche avec les personnes qui se présentent à lui : l’honnêteté totale et sans filtre.",
         'category' =>  "Comédie"]

    ];
    public function load(ObjectManager $manager)
    {
        foreach (self::PROGRAMS as $programList){
            $program = new Program(); 
            $program->setTitle($programList['title']);
            $program->setSynopsis($programList['synopsis']);
            $program->setCategory($this->getReference('category_'. $programList['category']));
            $manager->persist($program);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
          CategoryFixtures::class,
        ];
    }
}

