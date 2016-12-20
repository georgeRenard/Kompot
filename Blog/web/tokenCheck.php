<?php
    require_once('DataRetriever.php');
    date_default_timezone_set("Europe/Sofia");
    
    
    function verifyUser($token){
        
        $pendingUser = DataRetriever::getPendingUser($token);
        
        if(!empty($pendingUser)){
            
            if($pendingUser['token'] == $token){
                return $pendingUser;
            }
            
        }
        
        
    }
    
    #Tokens expire after a day!
    function didTokenExpire($timestamp){
        
        $delta = 86400;
        
        if($_SERVER['REQUEST_TIME'] - $timestamp > $delta){
            
            return array("isExpired" => true , "message" => "Unfortunately your token has expired. Please, try to register again");
            
        }else {
            return array("isExpired" => false , "message" => "Congratulations! You activated your account. It's time to share some music .");
        }
        
    }


