<?php
    require_once("session.php");
    require_once("Playlist.php");
    require_once("DataRetriever.php");
    require_once("Tune.php");

    $session = new session();
    $session::isUser();
    $session::isTuneAwaiting();

    if(isset($_POST['id'])){
        
        #Remove tune from playlists
        
        $playlist = new Playlist($_POST['id'],$_SESSION['user']);
        $noError = $playlist->tuneStripFromPlaylists();
        
        if(!$noError){
            echo "Service unavailable! Please, try again later.";
            exit;
        }
        
        #Remove tune
        $id = $_POST['id'];
        $userId = $_SESSION['user'];
        $path = DataRetriever::getTuneById($id);
        $path = $path['path'];
        $tune = new Tune($path,$userId);
        $isAdmin = DataRetriever::isAdmin($userId);
        $noError = $tune->remove($id,$userId,$isAdmin);

        
        if(!$noError){
            echo "Deletion wasn't completed! Please, try again later.";
            exit;
        }
        
        unlink($path);
        echo "Success";
        exit;
        
        
    }