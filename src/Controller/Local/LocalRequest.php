<?php

namespace Estoque\Controller;

use Estoque\Infra\DataRepository\LocationRepository;

header("Content-Type: application/json");

require_once __DIR__ . '/../../../vendor/autoload.php';


$repository = new LocationRepository();

$userList = $repository->getAll();

echo json_encode($userList);
