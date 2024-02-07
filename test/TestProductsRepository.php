<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use Estoque\Infra\DataRepository\ProductsRepository;
use Estoque\Core\Entities\Products\Products;

class TestProductsRepository extends TestCase{


    private $productsRepository;
    
    private $products;

    function setUp() : void {
        $this->productsRepository = new ProductsRepository();
        $this->products = new Products("pen", 2, "BIC", "2099-12-31");
    }

    function testSave() : void {
        $name = "pen";
        $price = 2.3;
        $mark = "BIC";
        $validate = "2099-12-31";
        
        $saveProduct = new Products($name, $price, $mark, $validate);

        $this->productsRepository->save($saveProduct);

    }

    function testGetById() : void {
        
        $productName = $this->productsRepository->getById(1);

        $this->assertEquals($productName['name'], "wather");

    }
    public function testGetAll(): void
    {
        $result = $this->productsRepository->getAll();
        $this->assertIsArray($result);
    }

}