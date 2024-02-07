<?php 

namespace Estoque\Core\Entities\Repository;

use Estoque\Core\Entities\Repository\IRepository;
use Estoque\Core\Entities\User\IUser;

interface IUserRepository extends IRepository{
    function getByEmail($email) : array;
    function save(IUser $user);
    function upload(IUser $user);
    
}