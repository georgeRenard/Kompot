<?php
    require_once('class.sqlite3.inc.php');

class Genre
{
    
    private $name;
    private $wallpaper;
    private $action;

    public function __construct($name,$wallpaper,$action = 'create'){
        
        $name = SQLite3::escapeString($name);
        $wallpaper = SQLite3::escapeString($wallpaper);
        $action = SQLite3::escapeString($action);
        $this->processInput($name,$wallpaper,$action);
        
        $this->decideAction($action);
        
    }
    
    private function processInput($name,$wallpaper){
        $name = trim($name);
        $name = strip_tags($name);
        $this->name = htmlspecialchars($name);
        
        $wallpaper = trim($wallpaper);
        $wallpaper = strip_tags($wallpaper);
        $this->wallpaper = htmlspecialchars($wallpaper);
        
        $action = trim($action);
        $action = strip_tags($action);
        $this->action = htmlspecialchars($action);
        
    }
    
    #DB Query function
    private function dbQuery($query="")
    {
        
        $db = new SQLite3_module();
        $dbPath = "../../DB Browser for SQLite/myDB.db";
        $dbr = $db->db_oper($dbPath,$query);
        return $dbr; 
        
    }
    
    private function manage(){
        
        switch($this->action){
                
            case 'Create':
                $this->createNew();
                break;
            case 'Delete':
                $this->deleteCurrent();
                break;
            case 'Edit':
                $this->editCurrent();
                break;
                
        }
        
    }
    
    private function exists()
    {
        
        $query = "SELECT name FROM genre WHERE name= '$this->name'";
        
        $result = $this->dbQuery($query);
        
        return !empty($result);
        
    }

    
    public function createNew()
    {
        
        $query = "INSERT OR IGNORE INTO genre(name,wallpaper) VALUES ('$name,'$wallpaper')";
        
        if(!$this->exists()){
            $result = $this->dbQuery($query);
        }
        
        
    }
    
    public function editCurrent(){
        
        
        
    }
    
    public function deleteCurrent(){
    
    }   
    
}