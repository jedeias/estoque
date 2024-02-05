<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use Estoque\Core\Entities\User\User;

Class TestUser extends TestCase{
    protected $user;

    public function setUp(): void{
        $this->user = new User();
    }

    public function testInstanceOfUser(): void{
        $this->assertInstanceOf(User::class, $this->user);
    }

    public function testGetterAndSetter(): void{
        $name = 'test';
        $email = 'test@estoque.com';
        $password = "password";
        $type = "Administrator";

        $this->user->setName($name);
        $this->user->setEmail($email);
        $this->user->setPassword($password);
        $this->user->setType($type);

        $this->assertEquals($name, $this->user->getName());
        $this->assertEquals($email, $this->user->getEmail());
        $this->assertEquals($password, $this->user->getPassword());
        $this->assertEquals($type, $this->user->getType());

        $type2 = "Assistant";
        $this->user->setType("ass");
        $this->assertEquals($type2, $this->user->getType());

    }

}