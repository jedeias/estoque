<?php

namespace Estoque\Infra\DataRepository;

use Estoque\Core\Entities\Repository\ISalesRepository;
use Estoque\Core\Entities\Sales\ISales;;
use Estoque\infra\Data\Sql;
use PDO;


class SalesRepository implements ISalesRepository{

    private ISales $products;
    private $sql;

    public function __construct() {
        $this->sql = new Sql();
    }
    
    public function getById($id) : array {
        try{

            $stmt = $this->sql->getConnect()->prepare("call getSalesById(:pk)");
            $stmt->bindParam(":pk", $id);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC)[0];

        }catch(PDOException $e){
            foreach( $e as $key){
                echo $key;
            }
            return ['error' . $key];
        }
    }

    public function getAll() : array {
        try{

            $stmt = $this->sql->getConnect()->prepare("SELECT * FROM sales");
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        }catch(PDOException $e){
            foreach( $e as $key){
                echo $key;
            }
            return ['error' . $key];
        }
    }

    public function save(Isales $sales) {
        try {
            $stmt = $this->sql->getConnect()->prepare("call insertSales(:fkLocation, :fkProduct, :amount, :sales)");
            if (!$stmt) {
                return ['error' => 'prepare failed'];
            }
            $stmt->bindValue(':fkLocation', $sales->getLocation()->getPrimaryKey());
            $stmt->bindValue(':fkProduct', $sales->getProducts()->getPrimaryKey());
            $stmt->bindValue(':amount', $sales->getAmount());
            $stmt->bindValue(':sales', $sales->getSales());
            $success = $stmt->execute();
            if (!$success) {
                return ['error' => 'execute failed'];
            }
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (!$result) {
                return ['error' => 'no result'];
            }
            return $result[0];
        } catch(\PDOException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function update(Isales $sales){
        
    }

    public function getProducts(): ISales
    {
        return $this->products;
    }

    public function setProducts(ISales $products): self
    {
        $this->products = $products;
        return $this;
    }
}
