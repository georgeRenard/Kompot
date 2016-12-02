<?php
    require_once('SmallUpdates.php');
    require_once('UserInteraction.php');
    require_once('ImageResize.php');
    require_once('session.php');
    require_once('Logger.php');
    #TODO SET-UP A LOGGER
    
    $session = new session();

    function updateImageRequest(){
        
        $userId = $_SESSION['user'];
        $userId = SQLite3::escapeString($userId);
        $uploadDir = '../profile_pictures/';
        $fileNewName = 'user_' . $userId;
        $file = $uploadDir . $fileNewName;
        $error = false;
        
        if(file_exists($file)){
           unlink($file);   
        }
        
        if(move_uploaded_file($_FILES['profilePicture']['tmp_name'],$file)){
            

            $resizeSuccessful = smart_resize_image($file,null,160,200);
            if($resizeSuccessful){
                
                $result = SmallUpdates::updateUserAvatar($userId,$file);
                imageResizeToEllipse($file);
            
                if(empty($result)){
                    #echo Failed to update image;
                }
            }
            
        }else{
            
            UserInteraction::uploadImageError($_FILES['profilePicture']['error']);
            
        }
        
    }


    function imageResizeToEllipse($file){
        
        $uploadDir = "../ellipse_avatar/";
        $fileNewName = "user_" . $_SESSION['user'];
        $avatar = $uploadDir . $fileNewName;
        
        $copySuccess = copy($file,$avatar);
        

        if($copySuccess){
            
            $resizeSuccessful = smart_resize_image($avatar,null,150,160);
            if(!$resizeSuccessful){
                
                #Resize Error Here
                
            }
            
        }else{
            #Code to manage error HERE //EllipseImageError
        }
        
        
        
    }
    
    
        
    
    
    
?>