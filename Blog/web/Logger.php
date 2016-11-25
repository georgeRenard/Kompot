<?php

require_once('class.sqlite3.inc.php');
require_once('DataRetriever.php');
require_once('client_ip_retrieve.php');

class Logger
{
    
    #DB Query function
    private function dbQuery($query="")
    {
        
        $db = new SQLite3_module();
        $dbPath = "../../DB Browser for SQLite/myDB.db";
        $dbr = $db->db_oper($dbPath,$query);
        return $dbr; 
        
    }
    
    
    public function logTrace($email,$action)
    {
        
        #Registered on Timestamp:    
        $timestamp = new DateTime();
        $timestamp = date_format($timestamp,'Y-m-d T H:i:s');
        $ip = $_SERVER['REMOTE_ADDR'];#get_client_ip_server();
        $clientData = $_SERVER['HTTP_USER_AGENT'];
        
        #$clientData = SQLite3::escapeString($clientData);
        
        $email = SQLite3::escapeString($email);
        $query = "INSERT OR IGNORE INTO logs(email,action,date,ip,client) VALUES('$email','$action','$timestamp','$ip','$clientData')";
        
        $result = $this->dbQuery($query);
        
        if(empty($result)){
            
            $this->emergencyLogTrace($email,$action,$timestamp,$ip,$clientData);
            
        }
        
        
    }
    
    public function logTraceById($id,$action)
    {
        
        $user = DataRetriever::getUserData($id);
        
        $this->logTrace($user['email'],$action);     
        
    }
    
    
    private function emergencyLogTrace($email,$action,$timestamp,$ip,$clientData)
    {
        
        $logTrace = "User:". $email . "\t" . "Action:" . $action . "\t" . "Date:" . $timestamp . "\t" . "IP:" . $ip 
        . "\t" . "Client:" . "$clientData" . PHP_EOL;
        
        file_put_contents('../emergencyLogTrace.txt', $logTrace, FILE_APPEND);
                    
    }
    
    
}






?>
