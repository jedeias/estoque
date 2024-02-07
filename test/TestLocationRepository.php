<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use Estoque\Infra\DataRepository\LocationRepository;
use Estoque\Core\Entities\Location\Location;

class TestLocationRepository extends TestCase
{
    private $locationRepository;
    private $location;

    protected function setUp(): void
    {
        $this->locationRepository = new LocationRepository();
        $this->location = new Location("Estoque A", 1, 50);
    }

    public function testSave(): void
    {
        $result = $this->locationRepository->save($this->location);
        $this->assertIsArray($result);
    }

    public function testGetAll(): void
    {
        $result = $this->locationRepository->getAll();
        $this->assertIsArray($result);
    }

    public function testGetById(): void
    {
        $result = $this->locationRepository->getById(1);
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }
}