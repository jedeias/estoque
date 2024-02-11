<?php

namespace Estoque\Controller;

use Estoque\Infra\DataRepository\LocationRepository;
use Estoque\Core\Entities\Location\Location;

header("Content-Type: application/json");

require_once __DIR__ . '/../../../vendor/autoload.php';


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