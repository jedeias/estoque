<?php

namespace Estoque\Infra\DataRepository;

use Estoque\Core\Entities\Repository\ILogsRepository;
use Estoque\infra\Data\Sql;
use PDO;
class LogsRepository implements ILogsRepository{

    private $sql;

    public function __construct() {
        $this->sql = new Sql();
    }

    public function getAll() : array{
        try{

            $stmt = $this->sql->getConnect()->prepare("SELECT * FROM logs");
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        }catch(PDOException $e){
            foreach( $e as $key){
                echo $key;
            }
            return ['error' . $key];
        }
    }

}

