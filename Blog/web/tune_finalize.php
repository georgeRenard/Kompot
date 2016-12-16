<?php
    require_once('Tune.php');
    require_once('session.php');
    require_once('Logger.php');
    $session = new session();
    $session::isUser();

    

function tuneFinalize($uploader){
    
    #POST data fetch
    $artist = $_POST['artist'];
    $title = $_POST['title'];
    $genre = $_POST['genre'];
    
    $directory = "../../Music/Uploaded/";
    $tempDir = "../../Music/Temp/";
    
    if(!isset($_SESSION['tune'])){
        return true;
    }
    
    $fileNewName = $_SESSION['tune'];
    $tempFileName = $tempDir . $fileNewName;
    
    if(!file_exists($tempFileName)){
        return true;
    }
    
    #New file name
    $file = $directory . $fileNewName;
    
    #If file with the same name happens to exist
    if(file_exists($file)){
        $randomStr = openssl_random_pseudo_bytes(3);
        $file = $directory . $randomStr . $fileNewName;   
    }
    
    #Creating the new Tune
    $tune = new Tune($artist,$title,$genre,$file,$uploader);
    
    try {
        
        if(rename($tempFileName,$file)){
        
            #Unlink the file in the temp folder

            #Upload tune to the Server
            $result = $tune->uploadToServer();
            
            if($result){
                session_destroy($_SESSION['tune']);
                unlink($file);
                $result = true;
            }
            return $result;   
                
            }else{
            unlink($tempFileName);
            return true;
            }
    }catch(Exception $ex){
        $logger = new Logger();
        $logger->logAnomaly($ex);
    }
    
}
