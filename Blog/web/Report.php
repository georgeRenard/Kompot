<?php
    require_once('class.sqlite3.inc.php');
    date_default_timezone_set("Europe/Sofia"); 
        
class Report 
{
    
    private $title;
    private $body;
    
    public function __construct($userId,$title,$body)
    {
        
        $this->processInputs($title,$body);
        $this->generateReport($userId,$this->title,$this->body);
        
    }
    
    #DB Query function
    private static function dbQuery($query="")
    {
        
        $db = new SQLite3_module();
        $dbPath = "../../DB Browser for SQLite/myDB.db";
        $dbr = $db->db_oper($dbPath,$query);
        return $dbr; 
        
    }
    
    private function processInputs($title,$body)
    {

        $title = trim($title);
        $title = strip_tags($title);
        $title = htmlspecialchars($title);
        
        $body = trim($body);
        $body = strip_tags($body);
        $body = htmlspecialchars($body);
        
        $this->title = SQLite3::escapeString($title);
        $this->body = SQLite3::escapeString($body);
        
    }
    
    private function generateReport($userId,$title,$body)
    {
        
        $userId = SQLite3::escapeString($userId);
        
        #Generate TimeStamp
        $timestamp = new DateTime();
        $timestamp = date_format($timestamp,'Y-m-d T H:i:s');
        
        $query = "INSERT OR IGNORE INTO reports(id,type,message,timestamp) VALUES('$userId','$title','$body','$timestamp')";
        
        $result = $this->dbQuery($query);
        
        if(empty($result))
        {
            
            $this->saveToFile($userId,$title,$body,$timestamp);
            
        }
        
    }
    
    private function saveToFile($userId,$title,$body,$timestamp)
    {
        
        $report = 'User_id: ' . $userId . ' Title: ' . $title . ' Body: ' . $body . ' TimeStamp: ' . $timestamp . PHP_EOL;
        file_put_contents('../reports.txt', $report, FILE_APPEND);
        
    }
    
    
}




?>
