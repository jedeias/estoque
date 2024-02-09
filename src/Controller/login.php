<?php

namespace Estoque\Controller;

use Estoque\Core\UseCases\Authentication;
use Estoque\Infra\DataRepository\UserRepository;

header("Content-Type: application/json");

require_once __DIR__ . '/../../vendor/autoload.php';

$data = json_decode(file_get_contents("php://input"));

$email = $data->email;
$password = $data->password;

//var_dump($data);

if (empty($email) || empty($password)) {
    echo json_encode("Send values not found");
    exit;
}

$userRepository = new UserRepository();
$authentication = new Authentication($userRepository);

$loginStats = $authentication->loginRequest($email, $password);

if ($loginStats === "email or password incorrect") {
    echo json_encode(array("error" => "Invalid credentials"));
    session_destroy();
    exit;
}

echo json_encode($loginStats);
