<?php
    require_once('class.sqlite3.inc.php');




class Genre
{
    
    private $name;
    
    

    public function __construct($name){
        
        $this->name = SQLite3::escapeString($name);
        
    }
    
    #DB Query function
    private function dbQuery($query="")
    {
        
        $db = new SQLite3_module();
        $dbPath = "../../DB Browser for SQLite/myDB.db";
        $dbr = $db->db_oper($dbPath,$query);
        return $dbr; 
        
    }
    
    private function exists()
    {
        
        $query = "SELECT name FROM genre WHERE name= '$this->name'";
        
        
    }
    
    public function createNew()
    {
        
           
        
    }
    
    
    
}