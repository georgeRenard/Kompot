<?php
    require_once('session.php');

    $session = new session();

    if(isset($_POST['genre'])){
        
        $_SESSION['tuneByGenre'] = $_POST['genre'];
        
        echo "Success";
        exit;
        
    }else {

        echo "Sorry, you can't sort by genre right now! Please, try again later.";
        exit;
        
    }