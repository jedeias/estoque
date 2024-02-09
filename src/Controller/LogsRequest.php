<?php

namespace Estoque\Controller;


require_once __DIR__ . '/../../vendor/autoload.php';

use Estoque\Infra\DataRepository\LogsRepository;

$repository = new LogsRepository();

$logs = $repository->getAll();

header("Content-Type: application/json");

echo json_encode($logs);

// print_r($logs);
