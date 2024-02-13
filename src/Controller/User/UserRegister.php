<?php

namespace Estoque\Controller;

use Estoque\Infra\DataRepository\UserRepository;
use Estoque\Core\Entities\User\User;

header("Content-Type: application/json");

require_once __DIR__ . '/../../../vendor/autoload.php';

$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];
$type = $_POST["type"];



if (empty($email) || empty($password) || empty($type) || empty($name)) {
    echo json_encode("Send values not found");
    exit;
}

$user = new User($name, $email, $password, $type);

echo json_encode(print_r($user));

$repository = new UserRepository();

$status = $repository->save($user);

echo json_encode(var_dump($status));

// echo json_encode("recebido");