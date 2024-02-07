<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use Estoque\Infra\DataRepository\ProductsRepository;
use Estoque\Infra\DataRepository\SalesRepository;
use Estoque\Core\Entities\Products\Products;
use Estoque\Core\Entities\Location\Location;
use Estoque\Core\Entities\Sales\Sales;

$repository = new SalesRepository();

$products = new Products("pen", 2.5, "BIC", "2024-02-10");
$location = new Location("Stock", $products->getPrimaryKey(), 50);
$sales = new Sales(10, 25.5, $products, $location);

$products->setPrimaryKey(1);

$location->setPrimaryKey(1);

$repository->save($sales);

$id = $repository->getAll();

var_dump($id);
