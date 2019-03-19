<?php
class Country{
 
    private $conn;
    private $table_name = "countries";
 
    public $id;
    public $country;
 
    public function __construct($db){
        $this->conn = $db;
    }
 
    function read(){
        $query = "SELECT
                    id, country
                FROM
                    " . $this->table_name . "
                ORDER BY
                    country";  
 
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
 
        return $stmt;
    }

    function readName(){
     
        $query = "SELECT country FROM " . $this->table_name . " WHERE id = ? limit 0,1";
    
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
    
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $this->name = $row['country'];
    }
 
}
?>