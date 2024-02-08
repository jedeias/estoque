<?php

namespace Estoque\Core\UseCases;

use Estoque\Core\Entities\User\User;
use Estoque\Core\Entities\Repository\IUserRepository;

class Authentication {

    private IUserRepository $userRepository;

    public function __construct(IUserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function loginRequest($email, $password) {

        $dataUser = $this->userRepository->getByEmail($email);

        if ($dataUser && $email == $dataUser["email"] && $dataUser["password"] == $password) {

            session_start();

            $user = new User($dataUser['name'], $dataUser['email'], $dataUser['password'], $dataUser['type']);

            $serialize = serialize($user);

            $_SESSION["serializeUser"] = $serialize;

            return "success";

        }

        return "email or password incorrect";
    }
}


// namespace Estoque\Core\UseCases;

// require_once __DIR__ . '/../../../vendor/';

// use Estoque\Core\Entities\User\User;
// use Estoque\Core\Entities\Repository\IUserRepository;
// use Estoque\Infra\DataRepository\UserRepository;

// class Authentication{

//     private IUserRepository $userRepository;

//     public function __construct() {
//         $this->userRepository = new UserRepository();
//     }

//     public function loginRequest($email, $password){

//         $dataUser = $this->userRepository->getByEmail($email);

//         if($dataUser && $dataUser["email"] == $email && $dataUser["password"] == $password){

//             session_start();

//             $user = new User($dataUser['name'], $dataUser['email'], $dataUser['password'], $dataUser['type']);

//             $serialize = serialize($user);

//             $_SESSION["serializeUser"] = $serialize;

//             return "success";

//         }

//         return "email or password incorrect";

//     }

// }