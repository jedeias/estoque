<?php

namespace Estoque\Core\Entities\Sales;
use Estoque\Core\Entities\Sales\ISales;
use Estoque\Core\Entities\Products\IProducts;
use Estoque\Core\Entities\Location\ILocation;

class Sales implements ISales{
    private int $amount;
    private float $sales;
    private IProducts $products;
    private ILocation $location;

    public function __construct($amount, $sales, IProducts $products, ILocation $location) {
        $this->setAmount($amount);
        $this->setSales($sales);
        $this->setProducts($products);
        $this->setLocation($location);
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getSales(): float
    {
        return $this->sales;
    }

    public function setSales(float $sales): self
    {
        $this->sales = $sales;

        return $this;
    }

    public function getProducts(): IProducts
    {
        return $this->products;
    }

    public function setProducts(IProducts $products): self
    {
        $this->products = $products;

        return $this;
    }

    public function getLocation(): ILocation
    {
        return $this->location;
    }

    public function setLocation(ILocation $location): self
    {
        $this->location = $location;

        return $this;
    }
}