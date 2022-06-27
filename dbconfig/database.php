<?php
class Database{
  
    // specify your own database credentials
    private $host = "localhost";
    private $username = "root";
    private $password = "firman";
    private $db_name = "foodmenu";
    public $conn;
  
    // get the database connection
    public function koneksi(){
        $this->conn = null;  
        try{            
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
  
        return $this->conn;
    }
}
?>