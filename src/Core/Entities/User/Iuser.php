<?php

namespace Estoque\Core\Entities\User;

Interface Iuser{
    function getName();
    function setName($name);
    function getEmail();
    function setEmail($email);
    function getPassword();
    function setPassword($password);
    function getType();
    function setType($type);
    function getPrimaryKey();
    function setPrimaryKey($primaryKey);
}