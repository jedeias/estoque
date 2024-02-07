<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use Estoque\Infra\DataRepository\UserRepository;
use Estoque\Core\Entities\User\User;
class TestUserRepository extends TestCase
{
    private $userRepository;

    protected function setUp(): void
    {
        $this->userRepository = new UserRepository();
    }

    public function testGetById(): void
    {
        $result = $this->userRepository->getById(1);
        $this->assertIsArray($result);
    }

    public function testGetByEmail(): void
    {
        $result = $this->userRepository->getByEmail('jorge@mail.com');
        $this->assertIsArray($result);
    }

    public function testGetAll(): void
    {
        $result = $this->userRepository->getAll();
        $this->assertIsArray($result);
    }
    
    public function testSaveUser(): void
    {

        $name = "test";
        $email = "test@mail.com";
        $password = "password";
        $type = "wateve";

        $user = new User($name, $email, $password, $type);
        $this->userRepository->save($user);

        $dataBaseEmail = $this->userRepository->getByEmail($email);

        $this->assertEquals($dataBaseEmail['email'], $user->getEmail()); 

    }
}