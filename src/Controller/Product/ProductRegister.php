<?php

namespace Estoque\Controller;

use Estoque\Core\Entities\Products\Products;
use Estoque\Infra\DataRepository\ProductsRepository;

header("Content-Type: application/json");

require_once __DIR__ . '/../../../vendor/autoload.php';

$name = $_POST["name"];
$price = $_POST["price"];
$mark = $_POST["mark"];
$validate = $_POST["validate"];


if (empty($name) || empty($price) || empty($mark) || empty($validate)) {
    echo json_encode("Send values not found");
    exit;
}

$product = new Products($name, $price, $mark, $validate);

$repository = new ProductsRepository();

try{
    $repository->save($product);
} catch(e) {
    echo json_encode($e->getMessage());
}

