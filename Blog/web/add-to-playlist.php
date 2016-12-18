<?php

    require_once('Playlist.php');
    require_once('session.php');
    $session = new session();
    
    if(isset($_POST['tuneID'])){
        
        $session::isUser();
        $session::isTuneAwaiting();
        
        header("Location: create-genre.php");
        
        $userId = $_SESSION['user'];
        
        #Many to many relation (INFORMAL);
        $playlist = new Playlist($tuneId,$userId);
        $result = $playlist->manage();
        
    }else{
        header("Location: create-genre.php");
    }
    