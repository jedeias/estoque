<?php

namespace Estoque\Core\Entities\Repository;

interface IRepository{
    function getById($id) : array;
    function getAll() : array;

}