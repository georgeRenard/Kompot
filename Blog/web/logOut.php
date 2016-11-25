<?php
    require_once('session.php');
    require_once('Logger.php');

    $session = new session();
    if(isset($_SESSION['user'])){
        
          $logger = new Logger();
          $logger->logTraceById($_SESSION['user'],'logOut');
          unset($_SESSION['user']);
          session_unset();
          session_destroy();
          header("Location: ../../index.php");
          exit;
        
    }

?>