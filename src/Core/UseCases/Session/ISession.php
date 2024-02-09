<?php

namespace Estoque\Core\UseCases\Session;

interface ISession{

public function set($var, $session);
public function get($var);
public function destroy();

}
