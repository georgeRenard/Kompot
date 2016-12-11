<?php
    require_once("session.php");
    $session = new session();
    $session::isUser();

    #Check if file is ready-for-upload
    if(isset($_FILES)){
        
        $file = $_FILES['name'];
        
        #Whitelist
        $whitelist = array('audio/mp3', 'audio/ogg', 'audio/aaç', 'audio/wma');
        
        $pattern = "^[\w-]+\.[A-Za-z]{3,4}$";
        
        if(!preg_match($pattern,$file)){
            
        }
        
        #Check if file is the correct format
        if(in_array($_FILES['file_to_temporary_dir']['type'],$whitelist)){
            
            header('')
            
        }else {
            http_response_code(400);
        }
        
    }else {
        http_response_code(400);
    }
