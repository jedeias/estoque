<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use Estoque\Infra\DataRepository\SalesRepository;
use Estoque\Core\Entities\Location\Location;
use Estoque\Core\Entities\Products\Products;
use Estoque\Core\Entities\Sales\Sales;

class TestSalesRepository extends TestCase
{
    private $salesRepository;
    
    private $sales;
    private $products;
    private $location;

    protected function setUp(): void
    {
        $this->salesRepository = new SalesRepository();
        $this->products = new Products("pen", 2.5, "BIC", "2024-02-10");
        $this->location = new Location("Stock", $this->products->getPrimaryKey(), 50);
        $this->sales = new Sales(10, 25.5, $this->products, $this->location);
    }

    public function testSave(): void
    {
        $this->products->setPrimaryKey(1);
        $this->location->setPrimaryKey(1);

        $result = $this->salesRepository->save($this->sales);
        $this->assertIsArray($result);
        $this->assertArrayHasKey('error', $result);
    }

    public function testGetById(): void
    {
        $salesId = 1;
        $result = $this->salesRepository->getById($salesId);
        $this->assertIsArray($result);
    }

    public function testGetAll(): void
    {
        $result = $this->salesRepository->getAll();
        $this->assertIsArray($result);
    }
}
