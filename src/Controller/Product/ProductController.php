<?php

namespace Estoque\Controller\Product\ProductController;

use Estoque\Core\Entities\Products\Products;
use Estoque\Infra\DataRepository\ProductsRepository;

header("Content-Type: application/json");

require_once __DIR__ . '/../../../vendor/autoload.php';


class ProductController{

    function productRegister(){
        
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
        } catch(Exception $e) {
            echo json_encode($e->getMessage());
        }

    }

    function productRequest(){

        $repository = new ProductsRepository();
        $productList = $repository->getAll();
        echo json_encode($productList);

    }

}


if (isset($_POST["method"])){
    $methodName = $_POST["method"];
}else{
    echo die(json_encode("Method not found"));
}


$userController = new ProductController();

$userController->$methodName();
