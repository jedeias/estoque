<?php

namespace Estoque\Infra\DataRepository;

use Estoque\Core\Entities\Repository\IProductsRepository;
use Estoque\Core\Entities\Products\IProducts;;
use Estoque\infra\Data\Sql;
use PDO;
class ProductsRepository implements IProductsRepository{

    private IProducts $products;
    private $sql;

    public function __construct() {
        $this->sql = new Sql();
    }

    function getById($id) : array {
        try {
            $stmt = $this->sql->getConnect()->prepare("CALL getProductsById(:pk)");
            if (!$stmt) {
                return ['error' => 'prepare failed'];
            }
            $stmt->bindParam(':pk', $id, \PDO::PARAM_INT);
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

    function getAll() : array{
        try{

            $stmt = $this->sql->getConnect()->prepare("SELECT * FROM products");
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        }catch(PDOException $e){
            foreach( $e as $key){
                echo $key;
            }
            return ['error' . $key];
        }
    }

    function save(IProducts $products){
        try {
            $stmt = $this->sql->getConnect()->prepare("call insertProducts(:name, :price, :mark, :validate)");
            if (!$stmt) {
                return ['error' => 'prepare failed'];
            }
            $stmt->bindValue(':name', $products->getName());
            $stmt->bindValue(':price', $products->getPrice());
            $stmt->bindValue(':mark', $products->getMark());
            $stmt->bindValue(':validate', $products->getValidate());
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

    function update(IProducts $products){
        try {
            $stmt = $this->sql->getConnect()->prepare("call updateProduct(:pk, :name, :price, :mark, :validate)");
            if (!$stmt) {
                return ['error' => 'prepare failed'];
            }
            $stmt->bindValue(':pk', $products->getPrimaryKey());
            $stmt->bindValue(':name', $products->getName());
            $stmt->bindValue(':price', $products->getPrice());
            $stmt->bindValue(':mark', $products->getMark());
            $stmt->bindValue(':validate', $products->getValidate());
            $stmt->execute();
            // if (!$success) {
            //     return ['error' => 'execute failed'];
            // }
            // $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // if (!$result) {
            //     return ['error' => 'no result'];
            // }
            // return $result[0];
        } catch(\PDOException $e) {
            return ['error' => $e->getMessage()];
        }
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
}