<?php

namespace Estoque\Controller\User;

use Estoque\Infra\DataRepository\UserRepository;
use Estoque\Core\UseCases\Session\Session;
use Estoque\Core\Entities\User\User;

require_once __DIR__ . '/../../../vendor/autoload.php';

header("Content-Type: application/json");

class UserController{
    
    function userRegister(){
        try{

            $name = $_POST["name"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $type = $_POST["type"];
            
            if (empty($email) || empty($password) || empty($type) || empty($name)) {
                echo json_encode("Send values not found");
                exit;
            }
            
            $user = new User($name, $email, $password, $type);
            
            // echo json_encode(print_r($user));
            
            $repository = new UserRepository();
            
            $repository->save($user);
            
            // echo json_encode(($status));
        }catch(Exception $e){
            echo json_encode("has a error: " . $e->getMessage());
        }

    }

    function userUpdateAuth() {
        try{
            
            $session = new Session();

            $serializedUser = $session->get("serializeUser");
            $user = unserialize($serializedUser);

            $repository = new UserRepository();
            
            $user->setName($_POST['name']);
            $user->setPassword($_POST['password']);
            $user->setEmail($_POST['email']);
            
            $serialize = serialize($user);

            $session->set("serializeUser", $serialize);

            $status = $repository->upload($user);

            echo json_encode(print_r($status));
            
        }catch(Exception $e){
            echo json_encode("has a error: " . $e->getMessage());
        }
    }

    function userUpdate() {
        try{
            
            foreach ($_POST as $input){
                if ($input == null){
                    echo json_encode('Send values not found');
                    exit;
                }
            }
            
            $pk = $_POST["pkUser"];
            $name = $_POST["name"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $type = $_POST["type"];
            

            echo json_encode(($_POST));
            
            $user = new User($name, $email, $password, $type);
            $user->setPrimaryKey($pk);
            echo json_encode(print_r($user));
            
            $repository = new UserRepository();
            
            // $repository->upload($user);
            $status = $repository->upload($user);
            
            echo json_encode(($status));
        }catch(Exception $e){
            echo json_encode("has a error: " . $e->getMessage());
        }

    }

    function userRequest(){
        try{
            
            $repository = new UserRepository();
            
            $userList = $repository->getAll();
            
            echo json_encode($userList);
            
        }catch(Exception $e){

            echo json_encode("erro can't request user", $e->getMessage());

        }
    }

}

if (isset($_POST["method"])){
    $methodName = $_POST["method"];
    
    $userController = new UserController();

    $userController->$methodName();

}else{
    echo die(json_encode("Method not found"));
}
