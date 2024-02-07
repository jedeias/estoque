<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Estoque\Core\Entities\Location\Location;
use PHPUnit\Framework\TestCase;

class Testlocation extends TestCase{

    private $location;

    function setUp() : void {
        $this->location = new Location("stock", 1, 24);
    }

    function testInstanceOfLocation() : void {
        $this->assertInstanceOf(Location::class, $this->location);
    }

    function testGetterAndSetter() : void {
        $local = "matriz";
        $productsKey = 3;
        $amount = 12;
        $date = date('Y-m-d');

        $this->location->setLocal($local);
        $this->location->setProductsKey($productsKey);
        $this->location->setAmount($amount);

        $this->assertEquals($local, $this->location->getLocal());
        $this->assertEquals($productsKey, $this->location->getProductsKey());
        $this->assertEquals($amount, $this->location->getAmount());
        $this->assertEquals($date, $this->location->getEntryDate());
        
        $primaryKey = 1;
        $this->location->setPrimaryKey($primaryKey);
        $this->assertEquals($primaryKey, $this->location->getPrimaryKey());
        
        $date = "2024-03-02";
        
        $this->location->setEntryDate($date);
        $this->assertEquals($date, $this->location->getEntryDate());

    }

}
