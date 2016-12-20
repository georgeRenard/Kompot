<?php
    require_once('class.sqlite3.inc.php');
    require_once('Playlist.php');

class Tune
{
    
    private $artist;
    private $title;
    private $genre;
    private $path;
    private $uploader;
        
    
    
    public function __construct($artist="",$title="",$genre="",$path,$uploader)
    {
        
        $this->genre = SQLite3::escapeString($genre);
        $this->path = SQLite3::escapeString($path);
        $this->uploader = SQLite3::escapeString($uploader);
        $this->processInput($artist,$title);
        
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
        
        #Timestamp
        $timestamp = new DateTime();
        $timestamp = date_format($timestamp,'Y-m-d T H:i:s');
        
        #Upload to server
        $query = "INSERT OR IGNORE INTO music(artist,title,genre,uploaderId,path,upload) VALUES ('$this->artist','$this->title','$this->genre','$this->uploader','$this->path','$timestamp')";
        
        #Execute Query
        
        $result = $this->dbQuery($query);
        return empty($result);
        
    }
    
    public function remove($id,$isAdmin=false){
        
        $isAdmin = SQLite3::escapeString($isAdmin);
        $query = "DELETE FROM music WHERE id = '$id' AND (uploaderId = '$this->uploader' OR '$isAdmin')";      
        $result = $this->dbQuery($query);        
        
        return empty($result);
    }

    
    private function processInput($artist,$title)
    {
        
        $artist = trim($artist);
        $artist = strip_tags($artist);
        $artist = htmlspecialchars($artist);
        $artist = SQLite3::escapeString($artist);
        $this->artist = $artist;
        
        $title = trim($title);
        $title = strip_tags($title);
        $title = htmlspecialchars($title); 
        $title = SQLite3::escapeSTring($title);
        $this->title = $title;
        
        
        
    }
    
    
    
    
    
    
}