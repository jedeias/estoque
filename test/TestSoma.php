<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use Estoque\Core\Soma;

Class TestSoma extends TestCase{

    protected $soma;

    public function setUp() : void {
        $this->soma = new Soma(1,2);
    }

    public function testInstanceOfSoma() : void {
        $this->assertInstanceOF(Soma::class, $this->soma);
    }

    public function testGetterAndSetter() : void {
        $value1 = 12;
        $value2 = 24;
        
        $this->soma->setNumber1($value1);
        $this->soma->setNumber2($value2);

        $this->assertEquals($value1, $this->soma->getNumber1());
        $this->assertEquals($value2, $this->soma->getNumber2());

    }
    
}