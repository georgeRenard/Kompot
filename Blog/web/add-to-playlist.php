<?php
    require_once('Playlist.php');
    require_once('session.php');
    $session = new session();

    if(isset($_POST['tuneID'])){
        
        $session::isUser();
        $session::isTuneAwaiting();
        
        $userId = $_SESSION['user'];
        
        #Many to many relation (INFORMAL);
        $playlist = new Playlist();
        $result = $playlist->addTune($tuneId,$userId);
        
    }else{
        exit;
    }
    