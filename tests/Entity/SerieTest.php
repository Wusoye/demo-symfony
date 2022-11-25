<?php

namespace App\Tests\Entity;

use App\Entity\Serie;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class SerieTest extends KernelTestCase
{

    public function getEntity() {
        $serie = new Serie();
        $serie->setName("name");
        $serie->setOverview("overview");
        $serie->setStatus("Cancelled");
        $serie->setVote("8");
        $serie->setPopularity("150");
        $serie->setGenre("genre");
        $serie->setFirstAirDate(new \DateTime("2022-11-23"));
        $serie->setLastAirDate(new \DateTime("2023-11-23"));
        $serie->setDateCreated(new \DateTime());

        return $serie;
    }

    public function testValidEntity(): void {
        $kernel = self::bootKernel();

        $serie = $this->getEntity();

        $errors = static::getContainer()->get('validator')->validate($serie);

        $this->assertCount(0, $errors);
    }

    public function testInvalideEntityBlankName(): void {
        $kernel = self::bootKernel();

        $serie = $this->getEntity();
        $serie->setName('');

        $errors = static::getContainer()->get('validator')->validate($serie);

        $this->assertCount(2, $errors);
    }

    public function testInvalideEntityLengthName(): void {
        $kernel = self::bootKernel();

        $serie = $this->getEntity();
        $serie->setName('n');

        $errors = static::getContainer()->get('validator')->validate($serie);

        $this->assertCount(1, $errors);
    }

    public function testInvalideEntityStatus(): void {
        $kernel = self::bootKernel();

        $serie = $this->getEntity();
        $serie->setStatus("invalideStatu");

        $errors = static::getContainer()->get('validator')->validate($serie);

        $this->assertCount(1, $errors);
    }

    public function testInvalideEntityDate(): void {
        $kernel = self::bootKernel();

        $serie = $this->getEntity();
        $serie->setFirstAirDate(new \DateTime("2022-11-20"));
        $serie->setLastAirDate(new \DateTime("2022-11-19"));

        $errors = static::getContainer()->get('validator')->validate($serie);

        $this->assertCount(1, $errors);
    }
}
