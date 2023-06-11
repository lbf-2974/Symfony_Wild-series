<?php

namespace App\DataFixtures;

use App\Entity\Season;
use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{ /*
    public const SEASONS = [
        ['program' => "Nus et culottés",
         'number' =>  "1",
         'year' =>  "2012",
         'description' =>  "La saison 1 de Nus & culottés a été diffusée sur France 5 du jeudi 26 juillet 2012 au jeudi 30 août 2012. Elle comporte 6 épisodes"],
         
         ['program' => "Nus et culottés",
         'number' =>  "2",
         'year' =>  "2013",
         'description' =>  "La saison 2 de Nus & culottés a été diffusée sur France 5 du jeudi 25 juillet 2013 au jeudi 29 août 2013. Elle comporte 6 épisodes"],
         
         ['program' => "Oggy et les cafards",
         'number' =>  "4",
         'year' =>  "2013",
         'description' =>  "La saison 4 de Oggy et les cafards a été diffusée sur Gulli du samedi 2 juin 2012 au samedi 9 février 2013. Elle comporte 74 épisodes."],

         ['program' => "Oggy et les cafards",
         'number' =>  "1",
         'year' =>  "1998",
         'description' =>  "La saison 1 de Oggy et les cafards a été diffusée sur Gulli du dimanche 6 septembre 1998 au jeudi 11 février 1999. Elle comporte 78 épisodes. "]
         
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::SEASONS as $seasonList){
            $season = new Season(); 
            $season->setNumber($seasonList['number']);
            $season->setYear($seasonList['year']);
            $season->setDescription($seasonList['description']);
            $season->setProgram($this->getReference('program_'. $seasonList['program']));
            $manager->persist($season);
            $this->addReference('season_' . $seasonList['number'] . $seasonList['program'], $season);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
          ProgramFixtures::class,
        ];
    }*/

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        foreach (ProgramFixtures::PROGRAMS as $program){
            for($i = 1; $i <=5; $i++) {
                $season = new Season();
                $season->setNumber($i);
                $season->setYear($faker->year());
                $season->setDescription($faker->paragraphs(3, true));
                $season->setProgram($this->getReference('program_'. $program['title']));

                $this->addReference('season_'. $i . $program['title'], $season);

                $manager->persist($season);
        }
    }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
           ProgramFixtures::class,
        ];
    } 



}
