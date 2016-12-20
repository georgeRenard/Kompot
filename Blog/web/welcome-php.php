<?php
    require_once('class.sqlite3.inc.php');


    #DB Query function
    function dbQuery($query="")
    {
        
        $db = new SQLite3_module();
        $dbPath = "DB Browser for SQLite/myDB.db";
        $dbr = $db->db_oper($dbPath,$query);
        return $dbr; 
        
    }

    function getUserById($id){

        $id = SQLite3::escapeString($id);
        $query = "SELECT name,email,register FROM users WHERE id = '$id'";
        $dbResult = dbQuery($query);
        
        return $dbResult[0];
    
    }