<?php

namespace Estoque\Infra\Data;

abstract class Host{

    private $host = "localhost";

    private $database = "estoque";
    
    private $user = "root";

    private $password = "";

	protected function getHost() {
		return $this->host;
	}
	
	protected function getDatabase() {
		return $this->database;
	}
	
	protected function getUser() {
		return $this->user;
	}
	
	protected function getPassword() {
		return $this->password;
	}
}
