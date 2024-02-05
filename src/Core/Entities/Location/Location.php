<?php

namespace Estoque\Core\Entities\Location;
use Estoque\Core\Entities\Location\ILocation;

class Location implements ILocation{
    private $local;
    private $productsKey;
    private $amount;
    private $entryDate;
    
    public function __construct($local, $productsKey, $amount) {
        $this->setLocal($local);
        $this->setProductsKey($productsKey);
        $this->setAmount($amount);
        $this->setEntryDate(date('Y-m-d'));
    }

    public function getLocal()
    {
        return $this->local;
    }

    public function setLocal($local): self
    {
        $this->local = $local;

        return $this;
    }
    
    public function getAmount()
    {
        return $this->amount;
    }
    
    public function setAmount($amount): self
    {
        $this->amount = $amount;

        return $this;
    }
    
    public function getEntryDate()
    {
        return $this->entryDate;
    }
    
    public function setEntryDate($entryDate): self
    {

        $this->entryDate = $entryDate;

        return $this;
    }

    public function getProductsKey()
    {
        return $this->productsKey;
    }

    public function setProductsKey($productsKey): self
    {
        $this->productsKey = $productsKey;

        return $this;
    }
}