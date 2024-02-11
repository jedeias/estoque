<?php

namespace Estoque\Controller;

use Estoque\Infra\DataRepository\ProductsRepository;

header("Content-Type: application/json");

require_once __DIR__ . '/../../../vendor/autoload.php';

$repository = new ProductsRepository();

$productList = $repository->getAll();

echo json_encode($productList);
