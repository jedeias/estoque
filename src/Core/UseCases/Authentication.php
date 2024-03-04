<?php

namespace Estoque\Core\UseCases;

use Estoque\Core\Entities\User\User;
use Estoque\Core\Entities\Repository\IUserRepository;
use Estoque\Core\UseCases\Session\Session;

class Authentication {

    private IUserRepository $userRepository;

    public function __construct(IUserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function loginRequest($email, $password) {

        $dataUser = $this->userRepository->getByEmail($email);

        if ($dataUser && $email == $dataUser["email"] && $dataUser["password"] == $password) {

            $session = new Session();

            $user = new User($dataUser['name'], $dataUser['email'], $dataUser['password'], $dataUser['type']);

            $user->setPrimaryKey($dataUser['pkUser']);

            $serialize = serialize($user);

            $session->set("serializeUser", $serialize);

            return "success";

        }

        return "email or password incorrect";
    }
}