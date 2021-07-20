<?php
class Database{
   
    // Database Credentials
    private $host = "localhost";
    private $database = "trial_project";
    private $username = "sa";
    private $password = "vmsi123!";

    public $connection;

    public function __construct(){
 
        if (!isset($this->connection)) {
 
            $this->connection = new PDO("sqlsrv:Server=" . $this->host . ";Database=" . $this->database, $this->username, $this->password);
 
            if (!$this->connection) {
                echo 'Cannot connect to database server';
                exit;
            }            
        }    
 
        return $this->connection;
    }
}
?>