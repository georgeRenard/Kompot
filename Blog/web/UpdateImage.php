<?php
    require_once('SmallUpdates.php');
    require_once('UserInteraction.php');
    require_once('ImageResize.php');
    require_once('session.php');

    $session = new session();

    function updateImageRequest(){
        
        $userId = $_SESSION['user'];
        $userId = SQLite3::escapeString($userId);
        $uploadDir = '../profile_pictures/';
        $fileNewName = 'user_' . $userId;
        $file = $uploadDir . $fileNewName;
        $error = false;
        
        if(file_exists($file)){
           unlink('../profile_pictures/'.$fileNewName);   
        }
        
        if(move_uploaded_file($_FILES['profilePicture']['tmp_name'],$file)){
            

            $resizeSuccessful = smart_resize_image($file,null,160,200);
            if($resizeSuccessful){
                
                $result = SmallUpdates::updateUserAvatar($userId,$file);
            
                if(empty($result)){
                    #echo Failed to update image;
                }
            }
            
        }else{
            
            UserInteraction::uploadImageError($_FILES['profilePicture']['error']);
            
        }
        
    }
    
    
        
    
    
    
?>