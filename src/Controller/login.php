<?php

namespace Estoque\Controller;

use Estoque\Core\UseCases\Authentication;
use Estoque\Infra\DataRepository\UserRepository;

header("Content-Type: application/json");

require_once __DIR__ . '/../../vendor/autoload.php';

var_dump($_POST);
$array = array(
    '{"email":"demo@demo_com","password":"123456789"}' => ''
);

$jsonString = key($array);

$data = json_decode($jsonString, true);

var_dump($data);

if (empty($data['email']) || empty($data['password'])) {
    echo json_encode("Send values not found");
    exit;
}

$email = $data['email'];
$password = $data['password'];

$userRepository = new UserRepository();
$authentication = new Authentication($userRepository);

$loginStats = $authentication->loginRequest($email, $password);

if ($loginStats === "email or password incorrect") {
    echo json_encode(array("error" => "Invalid credentials"));
    session_destroy();
    exit;
}

echo json_encode($loginStats);
