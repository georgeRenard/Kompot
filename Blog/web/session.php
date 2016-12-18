<?php

class session
{
    
    public function __construct(){
        self::start();
    }
    
 
	public static function start($shout = "mute"){
		if(	!isset($_SESSION)	)	{
			ini_set('session.gc.maxlifetime',2678400);
			session_start();
            if( !isset($_SESSION["id"])   ){
				session_regenerate_id(true);
				$sess_id = session_id(); 
                $_SESSION["id"] = md5($sess_id);
				//$_SESSION['crypt'] = cryptNonsense;
			}	
		}else{	if ($shout !== "mute"){echo "Session was already started!!!<br />";}	}
	}
    
    public static function checkLogin(){
        
        self::start();
        if(isset($_SESSION['user']) != ""){
       
            header("Location: ../../index.php");
            exit;
            
        }
        
    }
    
    public static function isUser(){
        
        self::start();
        if (!(isset($_SESSION['user']) != "")){

            header ("Location: login.php");
            exit;
        }
    }
    
    
    public static function isTuneAwaiting($relativePath = 1){
        
        self::start();
        if(isset($_SESSION['tune'])){
            
            $path = "../../Music/Temp/";
            
            if(!is_int($relativePath)){
                $path = $relativePath;
            }
            
            if(file_exists($path . $_SESSION['tune'])){
                unlink($path . $_SESSION['tune']);
            }
            unset($_SESSION['tune']);
            
        }
        
    }
    
    
}
