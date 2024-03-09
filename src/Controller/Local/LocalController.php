<?php

namespace Estoque\Controller\LocalController;

use Estoque\Infra\DataRepository\LocationRepository;
use Estoque\Core\Entities\Location\Location;

header("Content-Type: application/json");

require_once __DIR__ . '/../../../vendor/autoload.php';

class LocalController{
    function localRegister() : void {
        
        $local = $_POST["local"];
        $product = $_POST["product"];
        $amount = $_POST["amount"];
        
        
        if (empty($local) || empty($product) || empty($amount)) {
            echo json_encode("Send values not found");
            exit;
        }

        echo json_encode("recebido");
        
        $location = new Location($local, $product, $amount);
        
        echo json_encode(print_r($location));
        
        $repository = new locationRepository();
        
        $repository->save($location);
        
    }

    function localRequest() {

        $repository = new LocationRepository();
        $local = $repository->getAll();
        echo json_encode($local);

    }
    function localUpdate() {

        foreach ($_POST as $input){
            if ($input == null){
                echo json_encode('Send values not found');
                exit;
            }
        }
        
        
        $pk = $_POST['pk'];
        $local= $_POST['local'];
        $product= $_POST['product'];
        $amount= $_POST['amount'];
        
        $repository = new LocationRepository();
        
        $location = new Location($local, $product, $amount);
        $location->setPrimaryKey($pk);

        echo json_encode(print_r($location));
        
        $status = $repository->update($location);

        echo json_encode($status);

    }

}

if (isset($_POST["method"])){
    $methodName = $_POST["method"];
}else{
    echo die(json_encode("Method not found"));
}

$userController = new LocalController();

$userController->$methodName();
