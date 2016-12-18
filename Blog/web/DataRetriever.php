<?php

/* Utlity class which will help in retrieving data from the SQLite3 Database
   Everyone can access it and use it's retrieving utility functions */

require_once('class.sqlite3.inc.php');

class DataRetriever
{
    
    
    private static function escape($str){
        return SQLite3::escapeString($str);
    }
    
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
        $query = "SELECT name,email,register FROM users WHERE id = '$id'";
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
     
        $email = DataRetriever::escape($email);
        
        $query = "SELECT id FROM users WHERE email = '$email'";
        $result = DataRetriever::dbQuery($query);
        
        return $result[0]['id'];
        
    }
    
    
    public static function getPendingUser($token){
        
        $token = DataRetriever::escape($token);
        
        $query = "SELECT * FROM pending_user WHERE token = '$token'";
        
        $result = DataRetriever::dbQuery($query);
        
        return $result[0];
        
        
    }
    
    public static function getGenreNames(){
        
        $query = "SELECT name FROM genre";
        $result = DataRetriever::dbQuery($query);
        
        return $result;
        
    }
    
    
    public static function getGenres(){
        
        $query = "SELECT wallpaper FROM genre";
        $result = DataRetriever::dbQuery($query);
        
        return $result;
        
    }
    
    public static function isAdmin($userId) {
        
        $userId = DataRetriever::escape($userId);
        $query = "SELECT role FROM users WHERE id = '$userId'";
        
        $result = DataRetriever::dbQuery($query);
        
        return $result[0]['role'] == 2;
        
    }
    
    public static function getGenreThumbnail($name){
        
        $name = SQLite3::escapeString($name);
        $query = "SELECT wallpaper FROM genre WHERE name = '$name'";
        
        $result = DataRetriever::dbQuery($query);
        
        return $result[0]['wallpaper'];
        
    }
    
    public static function getTunes($query){
        
        $queryToExecute = "";
        
        if($query = "none"){
            $queryToExecute = "SELECT * FROM music";
        }else {
            $queryToExecute = $query;
        }
        
        $result = DataRetriever::dbQuery($queryToExecute);
        return $result;
        
    }
    


}

