<?php

class PlaylistManager extends Tune
{
    
    private $userId;
    private $tuneId;
    private $tuneUserRelationExists
    
    public function __construct(){
     
        $this->userId = SQLite3::escapeString($userId);
        $this->tuneId = SQLite3::escapeString($tuneId);
        
    }
    
    #DB Query function
    private function dbQuery($query="")
    {
        
        $db = new SQLite3_module();
        $dbPath = "../../DB Browser for SQLite/myDB.db";
        $dbr = $db->db_oper($dbPath,$query);
        return $dbr; 
        
    }
    
    private function tuneIsLinkedToCurrentUser(){
        
        $query = "SELECT * FROM playlist WHERE userId = '$this->userId' AND musicId = '$this->tuneId'";
        
        $result = $this->dbQuery($query);
        
        return !empty($result);
        
    }
    
    
    public function manage(){
        
        if($this->tuneIsLinkedToCurrentUser()){
            $result = $this->unlinkTune();
            return $result;
        }
        
        $result = $this->addTune();
        return $result;
        
    }
    
    private function unlinkTune(){
        
        $query = "DELETE FROM playlist WHERE userId = '$this->userId' AND musicId = '$this->tuneId'";
        
        $result = $this->dbQuery($query);
        
        return empty($result);
    }
    
    private function addTune(){
        
        $query = "INSERT OR IGNORE INTO playlist(userId,musicId) VALUES ('$this->userId','$this->tuneId')"
        
        $result = $this->dbQuery($query);
        
        return empty($result);
        
    }
    
    
    
}