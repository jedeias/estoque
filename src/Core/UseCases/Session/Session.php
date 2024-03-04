<?php

namespace Estoque\Core\UseCases\Session;

use Estoque\Core\UseCases\Session\ISession;

class Session implements ISession{

    function __construct() {
    
        session_start();
    
    }
   
    function set($sessionName, $var) {
    
        $_SESSION[$sessionName] = $var;
    
    }

    function get($name) {
        
        if (isset($_SESSION[$name])) {
            return $_SESSION[$name];
        }
        return null;

    }
   
    function destroy() {
        
        session_destroy();
    
    }
}