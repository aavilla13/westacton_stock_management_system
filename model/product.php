<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/westacton_management_system/config/database.php';

class Product extends Database{
  
    // Declare connection and database table name
    public $connection;
    private $table_name = "product";
  
    // Declare Product properties
    public $id;
    public $product_name;
    public $product_qty;
    public $product_price;
    public $added_when;
    public $added_by;
    public $updated_when;
    public $updated_by;
    public $deleted_when;
    public $deleted_by;
    public $deleted;
  
    public function __construct(){
 
        parent::__construct();
    }

    // Store Product
    function create(){
  
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    product_name=:product_name, product_qty=:product_qty, product_price=:product_price, added_when=:added_when, added_by=:added_by, deleted=:deleted";
  
        $stmt = $this->connection->prepare($query);
  
        $this->product_name = htmlspecialchars(strip_tags($this->product_name));
        $this->product_qty = htmlspecialchars(strip_tags($this->product_qty));
        $this->product_price = htmlspecialchars(strip_tags($this->product_price));
        $this->added_by = htmlspecialchars(strip_tags($this->added_by));
        $this->added_when = date('Y-m-d H:i:s');
  
        $stmt->bindParam(":product_name", $this->product_name);
        $stmt->bindParam(":product_qty", $this->product_qty);
        $stmt->bindParam(":product_price", $this->product_price);
        $stmt->bindParam(":added_by", $this->added_by);
        $stmt->bindParam(":added_when", $this->added_when);
        $stmt->bindParam(":deleted", $this->deleted);
  
        if ($stmt->execute()){
            return true;
        } else {
            return false;
        }
  
    }

    // Update Product
    function update(){
  
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    product_name = :product_name,
                    product_qty = :product_qty,
                    product_price = :product_price,
                    updated_when  = :updated_when,
                    updated_by  = :updated_by
                WHERE
                    id = :id";
      
        $stmt = $this->connection->prepare($query);
      
        $this->product_name = htmlspecialchars(strip_tags($this->product_name));
        $this->product_qty = htmlspecialchars(strip_tags($this->product_qty));
        $this->product_price = htmlspecialchars(strip_tags($this->product_price));
        $this->updated_when = htmlspecialchars(strip_tags($this->updated_when));
        $this->updated_by = htmlspecialchars(strip_tags($this->updated_by));

        $this->id = htmlspecialchars(strip_tags($this->id));
      
        $stmt->bindParam(":product_name", $this->product_name);
        $stmt->bindParam(":product_qty", $this->product_qty);
        $stmt->bindParam(":product_price", $this->product_price);
        $stmt->bindParam(":updated_by", $this->updated_by);
        $stmt->bindParam(":updated_when", $this->updated_when);
        $stmt->bindParam(":id", $this->id);
      
        if($stmt->execute()){
            return true;
        }
      
        return false;
          
    }

    // Retrieve All Product
    function readAll(){
  
        $query = "SELECT
                    id, product_name, product_qty, product_price
                FROM
                    " . $this->table_name . "
                WHERE
                    deleted = 0
                ORDER BY
                    product_name ASC";
      
        $stmt = $this->connection->prepare( $query );
        $stmt->execute();
      
        return $stmt;
    }

    // Retrieve Product
    function readOne(){
  
        $query = "SELECT
                    id, product_name, product_qty, product_price
                FROM
                    " . $this->table_name . "
                WHERE
                    id = ?
                    AND
                    deleted = 0
                LIMIT
                    0,1";
      
        $stmt = $this->connection->prepare( $query );
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
      
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
      
        $this->product_name = $row['product_name'];
        $this->product_qty = $row['product_qty'];
        $this->product_price = $row['product_price'];
    }
}
?>