<?php

namespace Estoque\Infra\DataRepository;

use Estoque\Core\Entities\Repository\ILocationRepository;
use Estoque\Core\Entities\Location\ILocation;
use Estoque\infra\Data\Sql;
use PDO;

class LocationRepository implements ILocationRepository{

    private Ilocation $location;

    private $sql;

    public function __construct() {
        $this->sql = new Sql();
    }

    public function save(ILocation $location){
        try{
            $stmt = $this->sql->getConnect()->prepare("CALL insertLocation(:name, :fkProduct, :amount)");
            
            $stmt->bindValue(':name', $location->getLocal());
            $stmt->bindValue(':fkProduct', $location->getProductsKey());
            $stmt->bindValue(':amount', $location->getAmount());

            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        }catch(PDOException $e){
            foreach( $e as $key){
                echo $key;
            }
            return ['error' . $key];
        }
    }

    public function upload(ILocation $location){

    }

    public function getAll() : array {
        try{
            $stmt = $this->sql->getConnect()->prepare(  "SELECT * FROM location
                                                        INNER JOIN products ON location.fkProduct = products.pkProduct");
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        }catch(PDOException $e){
            foreach( $e as $key){
                echo $key;
            }
            return ['error' . $key];
        }
    }

    public function getById($id) : array {
        try{
            $stmt = $this->sql->getConnect()->prepare("CAll getLocationById (:pk)");
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

    public function getLocation(): Ilocation
    {
        return $this->location;
    }

    public function setLocation(Ilocation $location): self
    {
        $this->location = $location;

        return $this;
    }
}