<?php

require_once('class.sqlite3.inc.php');


class SmallUpdates
{


    
    private static function dbQuery($query="")
    {
        
        $db = new SQLite3_module();
        $dbPath = "../../DB Browser for SQLite/myDB.db";
        $dbr = $db->db_oper($dbPath,$query);
        return $dbr; 
        
    }
    
    
    
    public static function updateUserAvatar($id,$url)
    {
        
        $id = SQLite3::escapeString($id);
        
        $query = "UPDATE userOptionalData SET imageUrl = '$url' WHERE id = '$id'";
        
        $result = SmallUpdates::dbQuery($query);
        
        return $result;
        
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
}







?>
