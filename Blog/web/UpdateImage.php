<?php
    require_once('SmallUpdates.php');
    require_once('UserInteraction.php');
    require_once('ImageResize.php');
    require_once('session.php');
    require_once('Logger.php');
    #TODO SET-UP A LOGGER
    
    $session = new session();
    $session::isUser();

    function updateImageRequest(){
        
        $userId = $_SESSION['user'];
        $userId = SQLite3::escapeString($userId);
        $uploadDir = '../profile_pictures/';
        $fileNewName = 'user_' . $userId;
        $file = $uploadDir . $fileNewName;
        $extension = $_FILES['profilePicture']['type'];
        
        $whitelist = array( 'jpeg' => 'image/jpeg' , 'jpg' => 'ímage/jpg' 
                           , 'gpg' => 'image/gpg' , 'png' => 'image/png' 
                           , 'svg' => 'image/svg');
        
        $error = false;
        
        if(!in_array($extension,$whitelist)) {
            http_response_code(400);
            exit;
        }
        
        if(file_exists($file)){
           unlink($file);   
        }
        
        if(move_uploaded_file($_FILES['profilePicture']['tmp_name'],$file)){
            

            $resizeSuccessful = smart_resize_image($file,null,160,200);
            if($resizeSuccessful){
                
                $result = SmallUpdates::updateUserAvatar($userId,$file);
                imageResizeToEllipse($file);
                imageResizeToBubble($file);
            
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
        $error = false;

        if($copySuccess){
            
            $resizeSuccessful = smart_resize_image($avatar,null,150,160);
            if(!$resizeSuccessful){
                
                $error = true;
                
            }
            
        }else{
            $error = true;
        }
        
        if($error){
         
            $cpresult = copy('../../Default-Profile-Picture-Ellipse.jpg',$fileNewName);
            
        }
        
        
    }

    function imageResizeToBubble($file){
        
        $uploadDir = "../bubble_avatar/";
        $fileNewName = "user_" . $_SESSION['user'];
        $avatar = $uploadDir . $fileNewName;
        
        $copySuccess = copy($file,$avatar);
        $error = false;

        if($copySuccess){
            
            $resizeSuccessful = smart_resize_image($avatar,null,64,64);
            if(!$resizeSuccessful){
                
                $error = true;
                
            }
            
        }else{
            $error = true;
        }
        
        if($error){
         
            $cpresult = copy('../../Default-Profile-Picture-Bubble.jpg',$fileNewName . ".jpg");
            
        }
        
    }


    function imageResizeToThumbnail(){
        
        #Managing POST file request
        if(!isset($_FILES)){
            exit;
        }
        
        #Managing FILE data
        $fileName = $_FILES['thumbnail']['name'];
        
        #Defense Layer
        $whitelist = array( 'jpeg' => 'image/jpeg' , 'jpg' => 'ímage/jpg' 
                           , 'gpg' => 'image/gpg' , 'png' => 'image/png' 
                           , 'svg' => 'image/svg');
        
        $extension = $_FILES['thumbnail']['type'];
        
        if(!in_array($extension,$whitelist)){
            return array('isValid' => false , 'errorMsg' => "File format not supported");
        }
        
        $pattern = "/^[\w\s\-]+(\.[\w]{3,4})?$/";
        
        if(!preg_match($pattern,$fileName)){
            return array('isValid' => false , 'errorMsg' => "File name is not valid, try again!");
        } 

        $directory = "../genre_thumbs/";
        $newExt = explode('/',$extension)[1];
        $newName = uniqid($fileName) . $newExt;
        
        $thumbnail = $directory . $newName;
        
        if(!move_uploaded_file($_FILES['thumbnail']['temp_name'], $thumbnail)){
            return array('isValid' => false , 'errorMsg' => "Bad Request! Please , try one more time");
        }
        
        $resizeSuccessful = smart_resize_image($thumbnail,null,200,200);
        
        if(!$resizeSuccessful){
            return array('isValid' => false , 'errorMsg' => "Bad Request! Please , try one more time");
        }
        
        return array('isValid' => true , 'filepath' => $thumbnail);
        
        
    }

    
    
        
    
    
    
?>
