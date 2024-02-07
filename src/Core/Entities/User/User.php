<?php

namespace Estoque\Core\Entities\User;
use Estoque\Core\Entities\User\Iuser;

class User implements Iuser{

    private $primaryKey;
    private $name;
    private $email;
    private $password;
    private $type;

    public function __construct($name, $email, $password,  $type) {
        $this->setName($name);
        $this->setEmail($email);
        $this->setPassword($password);
        $this->setType($type);
    }
    
    public function getName()
    {
        return $this->name;
    }

    public function setName($name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password): self
    {
        $this->password = $password;
        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type): self
    {
        if($type == "Administrator" || $type == "Assistant"){
            $this->type = $type;
        }else{
            $this->type = "Assistant";
        }

        return $this;
    }

    public function getPrimaryKey()
    {
        return $this->primaryKey;
    }

    public function setPrimaryKey($primaryKey): self
    {
        $this->primaryKey = $primaryKey;

        return $this;
    }
}
