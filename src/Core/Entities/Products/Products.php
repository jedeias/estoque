<?php

namespace Estoque\Core\Entities\Products;

use Estoque\Core\Entities\Products\IProducts;

class Products implements IProducts{
    private string $name;
    private float $price;
    private string $mark;
    private string $validate;

    public function __construct($name, $price, $mark, $validate) {
        $this->setName($name);
        $this->setPrice($price);
        $this->setMark($mark);
        $this->setValidate($validate);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getMark(): string
    {
        return $this->mark;
    }

    public function setMark(string $mark): self
    {
        $this->mark = $mark;

        return $this;
    }

    public function getValidate(): string
    {
        return $this->validate;
    }

    public function setValidate(string $validate): self
    {
        $this->validate = $validate;

        return $this;
    }
}