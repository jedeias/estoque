<?php

namespace Estoque\Infra\DataRepository;

use Estoque\Core\Entities\Repository\IUserRepository;
use Estoque\Core\Entities\User\IUser;
use Estoque\infra\Data\Sql;
use PDO;

class UserRepository implements IUserRepository{

    private IUser $user;
    private $sql;

    public function __construct() {
        $this->sql = new Sql();
    }

    function getById($id) : array {
        try {
            $stmt = $this->sql->getConnect()->prepare("CALL getUserById(:pk)");
            if (!$stmt) {
                return ['error' => 'prepare failed'];
            }
            $stmt->bindParam(':pk', $id, \PDO::PARAM_INT);
            $success = $stmt->execute();
            if (!$success) {
                return ['error' => 'execute failed'];
            }
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (!$result) {
                return ['error' => 'no result'];
            }
            return $result[0];
        } catch(\PDOException $e) {
            return ['error' => $e->getMessage()];
        }
    }
    

    function getByEmail($email) : array {
        try {
            $stmt = $this->sql->getConnect()->prepare("CALL getUserByEmail(:email)");
            if (!$stmt) {
                return ['error' => 'prepare failed'];
            }
            $stmt->bindParam(':email', $email, \PDO::PARAM_STR);
            $success = $stmt->execute();
            if (!$success) {
                return ['error' => 'execute failed'];
            }
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (!$result) {
                return ['error' => 'no result'];
            }
            return $result[0];
        } catch(\PDOException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    function getAll() : array{
        try{

            $stmt = $this->sql->getConnect()->prepare("SELECT pkUser, name, email, type FROM user");
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        }catch(PDOException $e){
            foreach( $e as $key){
                echo $key;
            }
            return ['error' . $key];
        }
    }

    function save(IUser $user){
        try {
            $stmt = $this->sql->getConnect()->prepare("CALL insertUser(:name, :email, :password, :type)");
            if (!$stmt) {
                return ['error' => 'prepare failed'];
            }
            $stmt->bindValue(':name', $user->getName());
            $stmt->bindValue(':email', $user->getEmail());
            $stmt->bindValue(':password', $user->getPassword());
            $stmt->bindValue(':type', $user->getType());
            $success = $stmt->execute();
            if (!$success) {
                return ['error' => 'execute failed'];
            }
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (!$result) {
                return ['error' => 'no result'];
            }
            return $result[0];
        } catch(\PDOException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    function  upload(IUser $user){
        try {
            $stmt = $this->sql->getConnect()->prepare("CALL updateUser(:pk, :name, :email, :password, :type)");
            if (!$stmt) {
                return ['error' => 'prepare failed'];
            }
            $stmt->bindValue(':pk', $user->getPrimaryKey());
            $stmt->bindValue(':name', $user->getName());
            $stmt->bindValue(':email', $user->getEmail());
            $stmt->bindValue(':password', $user->getPassword());
            $stmt->bindValue(':type', $user->getType());
            $stmt->execute();
            // if (!$success) {
            //     return ['error' => 'execute failed'];
            // }
            // $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // if (!$result) {
            //     return ['error' => 'no result'];
            // }
            // return $result[0];
        } catch(\PDOException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function getUser(): IUser
    {
        return $this->user;
    }

    public function setUser(IUser $user): self
    {
        $this->user = $user;

        return $this;
    }
}