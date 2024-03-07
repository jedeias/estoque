<?php

namespace Estoque\Core\Entities\Repository;

use Estoque\Core\Entities\Repository\IRepository;
use Estoque\Core\Entities\Products\IProducts;

interface IProductsRepository extends IRepository{
    function save(IProducts $products);
    function update(IProducts $products);
}