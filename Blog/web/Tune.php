<?php
    require_once('class.sqlite3.inc.php');

class Tune
{
    
    private $artist;
    private $title;
    private $genre
        
    
    
    public function __construct($artist,$title,$genre)
    {
        
        $this->processData($artist,$title,$genre);
        
    }
    
    #DB Query function
    private function dbQuery($query="")
    {
        
        $db = new SQLite3_module();
        $dbPath = "../../DB Browser for SQLite/myDB.db";
        $dbr = $db->db_oper($dbPath,$query);
        return $dbr; 
        
    }
    
    public function uploadToServer(){
        
        #Upload
        
    }

    
    private function processInput($artist,$title,$genre)
    {
        
        $artist = trim($artist);
        $artist = strip_tags($artist);
        $artist = htmlspecialchars($artist);
        
        $title = trim($title);
        $title = strip_tags($title);
        $title = htmlspecialchars($title);        
        
        
    }
    
    
    
    
    
    
}