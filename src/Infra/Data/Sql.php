<?php

namespace Estoque\Infra\Data;

require_once __DIR__ . './Host.php';

use PDO;

class Sql extends Host{

    private $connect; 

    public function __construct() {
        $this->connect = new PDO("mysql:host={$this->getHost()};dbname={$this->getDatabase()}", 
                                 $this->getUser(), 
                                 $this->getPassword());
    }

	public function getConnect() {
		return $this->connect;
	}

    function __destruct() {
        $this->connect = null;
    }

}
