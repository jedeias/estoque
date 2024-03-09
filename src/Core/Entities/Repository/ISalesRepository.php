<?php

namespace Estoque\Core\Entities\Repository;

use Estoque\Core\Entities\Repository\IRepository;
use Estoque\Core\Entities\Sales\ISales;
interface ISalesRepository extends IRepository{

    function save(ISales $sales);
    function update(ISales $sales);

}