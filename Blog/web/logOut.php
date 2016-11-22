<?php
    require_once('session.php');

    $session = new session();
    if(isset($_SESSION['user'])){
        
          unset($_SESSION['user']);
          session_unset();
          session_destroy();
          header("Location: ../../index.php");
          exit;
        
    }

?>