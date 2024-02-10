<?php

namespace Estoque\Controller;

use Estoque\Infra\DataRepository\UserRepository;

header("Content-Type: application/json");

require_once __DIR__ . '/../../../vendor/autoload.php';


$repository = new UserRepository();

$userList = $repository->getAll();

echo json_encode($userList);
