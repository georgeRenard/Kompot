<?php
    require_once('Playlist.php');
    require_once('session.php');
    $session = new session();
    $session::isUser();

    if(isset($_POST['id'])){
    
        $session::isTuneAwaiting();
        
        $userId = $_SESSION['user'];
        
        #Many to many relation (INFORMAL);
        $playlist = new Playlist($_POST['id'],$userId);
        $callback = $playlist->manage();
        
        if($callback[0]){
            echo $callback[1];
            exit;
        }else {
            echo "Service not available right now! Please, try again later.";
            exit;
        }
        
        
    }else{
        echo "Error Code: 400 / Bad Request";
        exit;
    }
    