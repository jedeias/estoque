<?php 

namespace Estoque\Core\Entities\Sales;

use Estoque\Core\Entities\Products\IProducts;
use Estoque\Core\Entities\Location\ILocation;

interface ISales {

    function getAmount() : int;
    function setAmount(int $amount) : self;
    function getSales() : float;
    function setSales(float $sales) : self;
    function getProducts() : IProducts;
    function setProducts(IProducts $product) : self;
    function getLocation() : ILocation;
    function setLocation(ILocation $location) : self;
}
