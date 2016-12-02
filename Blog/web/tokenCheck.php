<?php
    require_once('DataRetriever');
    date_default_timezone_set("Europe/Sofia");
    
    
    function verifyUser($token){
        
        $pendingUser = DataRetriever::getPendingUser();
        
        if(!empty($user)){
            
            if($user['token'] == $token){
                return $pendingUser;
            }
            
        }else{
            
            throw new Exception('The provided token is invalid!');
            
        }
        
        
    }
    
    #Tokens expire after a day!
    function didTokenExpire($timestamp){
        
        $delta = 86400;
        
        if($_SERVER['REQUEST_TIME'] - $timestamp > $delta){
            
            throw new Exception('Unfortunately your token has expired. Please, try to register again');
            
        }
        
    }


