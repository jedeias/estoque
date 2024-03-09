<?php

namespace Estoque\Core\Entities\Repository;

use Estoque\Core\Entities\Repository\IRepository;
use Estoque\Core\Entities\Location\ILocation;
interface ILocationRepository extends IRepository{

    function save(ILocation $location);
    function update(ILocation $location);

}