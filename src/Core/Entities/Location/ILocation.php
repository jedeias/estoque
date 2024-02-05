<?php

namespace Estoque\Core\Entities\Location;

Interface ILocation{
    function getLocal();
    function setLocal($local):self;
    function getProductsKey();
    function setProductsKey($key):self;
    function getAmount();
    function setAmount($amount):self;
    function getEntryDate();
    function setEntryDate($date):self;
}