<?php

namespace App\Tests\Repository;

use App\Repository\SerieRepository;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class SerieRepositoryTest extends KernelTestCase
{
    private $dataBaseTool;

    protected function setUp(): void
    {
        parent::setUp();
        $this->dataBaseTool = static::getContainer()->get(DatabaseToolCollection::class)->get();
    }

    public function testCount(): void
    {
        $kernel = self::bootKernel();

        $this->dataBaseTool->loadFixtures(['App\DataFixtures\SerieFixture']);

        $nbSerie = static::getContainer()->get(SerieRepository::class)->count([]);

        $this->assertEquals(20, $nbSerie);
        // $routerService = static::getContainer()->get('router');
        // $myCustomService = static::getContainer()->get(CustomService::class);
    }

    protected function tearDown(): void
    {
        parent::tearDown(); // TODO: Change the autogenerated stub
        unset($this->dataBaseTool);
    }
}
