<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/westacton_management_system/config/database.php';

class Sales extends Database{
  
    // Declare connection and database table name
    public $connection;
    private $table_name = "sales";
  
    // Declare Product properties
    public $id;
    public $product_id;
    public $sales_qty;
    public $sales_total;
    public $added_when;

  
    public function __construct(){
 
        parent::__construct();
    }

    // Store Sales
    function create(){

        $product_query = "SELECT
                    id, product_name, product_qty, product_price
                FROM
                    product
                WHERE
                    id = ?
                    AND
                    deleted = 0
                LIMIT
                    0,1";
      
        $product_stmt = $this->connection->prepare( $product_query );
        $product_stmt->bindParam(1, $this->product_id);
        $product_stmt->execute();
      
        $row = $product_stmt->fetch(PDO::FETCH_ASSOC);
        $product_qty = $row['product_qty'] - $this->sales_qty;
        
        $update_prod_query = "UPDATE
                    product
                SET
                    product_qty = :product_qty,
                    updated_when  = :updated_when,
                    updated_by  = :updated_by
                WHERE
                    id = :id";
      
        $update_pro_stmt = $this->connection->prepare($update_prod_query);
      
        $update_product_qty = $product_qty;
        $update_product_updated_when = date('Y-m-d H:i:s');
        $update_product_updated_by = 'default';
      
        $update_pro_stmt->bindParam(":product_qty", $update_product_qty);
        $update_pro_stmt->bindParam(":updated_by", $update_product_updated_by);
        $update_pro_stmt->bindParam(":updated_when", $update_product_updated_when);
        $update_pro_stmt->bindParam(":id", $this->product_id);
      
        if($update_pro_stmt->execute()){
            $query = "INSERT INTO
                        " . $this->table_name . "
                    SET
                        product_id=:product_id, sales_qty=:sales_qty, sales_total=:sales_total, added_when=:added_when";

            $stmt = $this->connection->prepare($query);

            $this->product_id = htmlspecialchars(strip_tags($this->product_id));
            $this->sales_qty = htmlspecialchars(strip_tags($this->sales_qty));
            $this->sales_total = htmlspecialchars(strip_tags($this->sales_total));
            $this->added_when = date('Y-m-d H:i:s');

            $stmt->bindParam(":product_id", $this->product_id);
            $stmt->bindParam(":sales_qty", $this->sales_qty);
            $stmt->bindParam(":sales_total", $this->sales_total);
            $stmt->bindParam(":added_when", $this->added_when);

            if ($stmt->execute()){
                return true;
            } else {
                return false;
            }
        }

        return false;
  
    }


    // Retrieve All Product
    function readAll(){
  
        $query = "SELECT
                    prod.id, prod.product_name, sales.sales_qty, sales.sales_total, sales.added_when
                FROM
                    " . $this->table_name . " sales
                INNER JOIN product prod ON prod.id = sales.product_id
                WHERE
                    prod.deleted = 0
                ORDER BY
                    prod.product_name ASC";
      
        $stmt = $this->connection->prepare( $query );
        $stmt->execute();
      
        return $stmt;
    }

}
?>