<?php

    require_once("session.php");
    $session = new session();
    $session::isUser();

    #Check if file is ready-for-upload
    if(is_uploaded_file($_FILES['file']["tmp_name"])){
        
        if($_FILES['file']['error'] == 1){
            echo "File size limit exceeded! Please, choose another file";
            exit;
        }
        
        $file = $_FILES['file']['name'];
        $fileExtension = explode('/',$_FILES['file']['type']);
        $fileExtension = "." . $fileExtension[1];
        
        #Whitelist
        $whitelist = array('audio/mpeg', 'audio/ogg', 'audio/aaç', 'audio/wma');
        
        $pattern = "/^[\w\s\-]+(\.[\w]{3,4})?$/";
        
        if(!preg_match($pattern,$file)){
            echo "Invalid file name! Please, change it and try again";
            exit;
        }
        
        #Check if file is the correct format
        if(in_array($_FILES['file']['type'],$whitelist)){
            
            #$directory = "../../../Music"; 
            $id = uniqid("tuneid") . $fileExtension;
            $_SESSION['tune'] = $id;
            $tempDir = "../../Music/Temp/" . $id;
            
            if(move_uploaded_file($_FILES['file']['tmp_name'],$tempDir)){
            
                echo "Tune ready for upload";
                exit;
                
            }else {
                echo "Upload Failed!";
                exit;
            }
        }else {
            echo "File format not supported!";
            exit;
        }
        
    }else {
        echo "Please, choose a file";
        exit;
    }
