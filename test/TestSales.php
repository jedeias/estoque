<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use Estoque\Core\Entities\Sales\ISales;
use Estoque\Core\Entities\Sales\Sales;
use Estoque\Core\Entities\Products\IProducts;
use Estoque\Core\Entities\Location\ILocation;
class TestSales extends TestCase{

    private $sales;

    function setUp() : void {

        $product = $this->createMock(IProducts::class);
        $local = $this->createMock(ILocation::class);

        $this->sales = new Sales(2, 5, $product, $local);
    }

    function testInstanceOfSales() : void {
        $this->assertInstanceOf(Sales::class, $this->sales);
    }

    function testSpecialMethods() : void {
        $amount = 100;
        $sales = 32;
        
        $this->sales->setAmount($amount);
        $this->sales->setSales($sales);

        $this->assertEquals($amount, $this->sales->getAmount());
        $this->assertEquals($sales, $this->sales->getSales());

    }
}

