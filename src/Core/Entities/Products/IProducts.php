<?php

namespace Estoque\Core\Entities\Products;

interface IProducts{
    function getName() : string;
    function setName(string $name) : self;
    function getPrice() : float;
    function setPrice(float $price) : self;
    function getMark() : string;
    function setMark(string $mark) : self;
    function getValidate() : string;
    function setValidate(string $validator) : self;
    function getPrimaryKey();
    function setPrimaryKey($primaryKey);
}
