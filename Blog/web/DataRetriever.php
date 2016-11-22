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
        $query = "SELECT name,password,email FROM users WHERE id = '$id'";
        $dbResult = DataRetriever::dbQuery($query);
        
        return $dbResult[0];
    }
    
    
    
    
    


}





?>