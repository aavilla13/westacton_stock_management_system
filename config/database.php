<?php
class Database{
   
    // Database Credentials
    private $host = "localhost";
    private $database = "westacton_stock_management_system";
    private $username = "root";
    private $password = "vmsi123!";

    public $connection;

    public function __construct(){
 
        if (!isset($this->connection)) {
 
            $this->connection = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database, $this->username, $this->password);
 
            if (!$this->connection) {
                echo 'Cannot connect to database server';
                exit;
            }            
        }    
 
        return $this->connection;
    }
}
?>