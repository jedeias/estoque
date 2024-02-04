<?php

namespace Estoque\Core;

class Soma{

    private $number1;
    private $number2;


    public function __construct($number1, $number2) {
        $this->setNumber1($number1);
        $this->setNumber2($number2);
    }

    public function somar() : self{
        $this->getNumber1() + $this->getNumber2();
        return $this;
    }

    public function getNumber1()
    {
        return $this->number1;
    }

    public function setNumber1($number1): self
    {
        $this->number1 = $number1;

        return $this;
    }

    public function getNumber2()
    {
        return $this->number2;
    }

    public function setNumber2($number2): self
    {
        $this->number2 = $number2;

        return $this;
    }
}
