<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{/*
    public const EPISODES = [
        ['season' => "1",
         'title' =>  "Objectif Hollande",
         'number' =>  "1",
         'synopsis' =>  "Depuis la Normandie vers la Hollande, en passant par Lille et sa célèbre braderie, Nans et Mouts prennent la route avec l'espoir de rencontrer assez d'âmes charitables pour vivre une expérience agréable.",
         'program' => "Nus et culottés"],

         ['season' => "1",
         'title' =>  "Objectif Alpes",
         'number' =>  "2",
         'synopsis' =>  "Nans et Mouts décident cette fois-ci les Alpes en partant depuis la Camargue. Et évidemment, ils prendront la route sans aucun bien matériel, se reposant sur la générosité des personnes rencontrées.",
         'program' => "Nus et culottés"],

         ['season' => "1",
         'title' =>  "Objectif Angleterre",
         'number' =>  "3",
         'synopsis' =>  "Nans et Mouts souhaitent rallier l'Angleterre depuis la Bretagne sans aucun bien matériel. Il leur faudra donc compter sur la générosité des personnes qu'ils vont croiser.",
         'program' => "Nus et culottés"],

         ['season' => "4",
         'title' =>  "Olivia",
         'number' =>  "1",
         'synopsis' =>  "Un nouveau voisin s'installe dans le lotissement et c'est... une voisine! Oggy craque, Olivia est charmante.Sauf que les cafards s'en mêlent. Que va penser la voisine quand elle saura qu'il y a des cafards chez Oggy?",
         'program' => "Oggy et les cafards"],
         
         ['season' => "2",
         'title' =>  "Objectif Belgique",
         'number' =>  "1",
         'synopsis' =>  "Départ d'Alsace pour aller manger un chocolat avec le roi de la Belgique à Bruxelles. Partir des vignobles alsaciens, voilà un commencement des plus gourmets pour se mettre en quête du roi belge !",
         'program' => "Nus et culottés"],

         ['season' => "1",
         'title' =>  "Chocolat Amer",
         'number' =>  "1",
         'synopsis' =>  "Oggy reçoit une boîte de chocolats par la poste. Gourmand, il décide de la manger tout de suite mais les cafards la prennent assez rapidement, sans qu'Oggy puisse en manger un seul.",
         'program' => "Oggy et les cafards"],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::EPISODES as $episodeList){
            $episode = new Episode(); 
            $episode->setTitle($episodeList['title']);
            $episode->setNumber($episodeList['number']);
            $episode->setSynopsis($episodeList['synopsis']); 
            $episode->setSeason($this->getReference('season_' . $episodeList['season']. $episodeList['program']));
            $manager->persist($episode);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
          SeasonFixtures::class,
        ];
    }*/
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        foreach (ProgramFixtures::PROGRAMS as $program) {
            for ($j = 1; $j <= 5; $j++) {
                for ($i = 1; $i <= 10; $i++) {
                    $episode = new Episode();

                    $episode->setTitle($faker->text(30));
                    $episode->setNumber($i);
                    $episode->setSynopsis($faker->paragraph(2,true));
                    $episode->setSeason($this->getReference('season_' . $j .  $program['title']));
                    
                    $manager->persist($episode);
                }
            }
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
           SeasonFixtures::class,
        ];
    } 
}