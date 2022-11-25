<?php

namespace App\DataFixtures;

use App\Entity\Serie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SerieFixture extends Fixture
{

    public function getEntity() {
        $serie = new Serie();
        $serie->setName("name");
        $serie->setBackdrop("img.png");
        $serie->setPoster("img.png");
        $serie->setOverview("overview");
        $serie->setStatus("Cancelled");
        $serie->setVote("8");
        $serie->setPopularity("150");
        $serie->setGenre("genre");
        $serie->setFirstAirDate(new \DateTime("2022-11-23"));
        $serie->setLastAirDate(new \DateTime("2023-11-23"));
        $serie->setDateCreated(new \DateTime());
        $serie->setTmdbId(111);

        return $serie;
    }

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 20; $i++){
            $serie = $this->getEntity();

            $manager->persist($serie);
        }

        $manager->flush();
    }
}