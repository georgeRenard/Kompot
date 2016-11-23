<?php

/* Utlity class which will help in retrieving data from the SQLite3 Database
   Everyone can access it and use it's retrieving utility functions */

require_once('class.sqlite3.inc.php');

class DataRetriever
{
    
    
    #DB Query function
    private static function dbQuery($query="")
    {
        
        $db = new SQLite3_module();
        $dbPath = "../../DB Browser for SQLite/myDB.db";
        $dbr = $db->db_oper($dbPath,$query);
        return $dbr; 
        
    }
    
    #Retrieving User DATA for population purposes "mainly"
    public static function getUserData($id)
    {
        $id = SQLite3::escapeString($id);
        $query = "SELECT name,password,email,register FROM users WHERE id = '$id'";
        $dbResult = DataRetriever::dbQuery($query);
        
        return $dbResult[0];
    }
    
    public static function getUserOptionalData($id){
        
        $id = SQLite3::escapeString($id);
        
        $query = "SELECT * FROM userOptionalData WHERE id = '$id'";
        $dbr = DataRetriever::dbQuery($query);
        
        return $dbr[0];
        
    }
    
    public static function getUserId($email){
     
        $email = SQLite3::escapeString($email);
        
        $query = "SELECT id FROM users WHERE email = '$email'";
        $result = DataRetriever::dbQuery($query);
        
        return $result[0]['id'];
        
    }
    
    
    


}





?>
