<?php

use PHPUnit\Framework\TestCase;
use Estoque\Controller\User\UserController;

require_once __DIR__ . '/../vendor/autoload.php';

class TestUserController extends TestCase
{
    public function testUserRegisterWithValidData()
    {
        $_POST["name"] = "John Doe";
        $_POST["email"] = "john@example.com";
        $_POST["password"] = "password";
        $_POST["type"] = "Administrator";
        $_POST["method"] = "userRegister";

        $controller = new UserController();
        $this->expectOutputString(json_encode("Send values not found"));

        $controller->userRegister();
    }

    public function testUserRequest()
    {
        $_POST["method"] = "userRequest";

        $controller = new UserController();
        $this->expectOutputString(json_encode([]));

        $controller->userRequest();
    }
}
