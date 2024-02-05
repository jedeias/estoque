<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Estoque\Core\Entities\Products\Products;
use PHPUnit\Framework\TestCase;

class TestProducts extends TestCase{

    private $products;

    function setUp() : void {
        $this->products = new Products("pen", 2, "BIC", "2099-12-31");
    }
    
    function testGetterAndSetter() : void {
        $name = "kandy";
        $price = 3;
        $mark= "Finne";
        $validate= "2025-05-3";

        $this->products->setName($name);
        $this->products->setPrice($price);
        $this->products->setMark($mark);
        $this->products->setValidate($validate);

        $this->assertEquals($name, $this->products->getName());
        $this->assertEquals($price, $this->products->getPrice());
        $this->assertEquals($mark, $this->products->getMark());
        $this->assertEquals($validate, $this->products->getValidate());

    }

}
