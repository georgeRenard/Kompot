<?php
    session_start();

    //include '../../../php/session.php';
    include 'class.sqlite3.inc.php';
    //$session = new session();
    //$session->start();
    $db = new SQLite3_module();
    $dbpath = "../../DB Browser for SQLite/myDB.db";
    if(isset($_SESSION["register"]))
    {
        
        header("Location: register.php");
        exit();
        
    }
    #Get session data
    $credentials = $_SESSION["register"];
    $username = $credentials['user[name]'];
    $email = $credentials['user[email]'];
    $password = $credentials['user[password]'];

    #Request registration entry
    $query = "INSERT INTO users (name,password,email) VALUES ('$username', '$password'
    , '$email' ";
     
    $dbr = $db->db_oper($dbpath,$query);
    unset($_SESSION['register']);
    

?>


<!DOCTYPE html>
<!--Kompot Website-->

<html>


<head>
    
    <meta charset="utf-8" />
    <meta name="#" content="#" />
    <meta name="google" content="nositelinkssearchbox" />\
    <meta name="google" content="notranslate" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Coming Soon</title>
    
    <link type="text/css" rel="stylesheet" href="../css/bootstrap.css">
    <link type="text/css" rel="stylesheet" href="../css/bootstrap-theme.css">
    
    <script type="text/jscript" href="../scripts/bootstrap.js"></script>
    <script type="text/jscript" href="../scripts/jquery-3.1.1.js"></script>
    
</head>
<body>
    
    <header>
        
        <p>You were registered successfully! You can log in into your <a href="login.html">account now</a> :)</p>
        
    </header>
    
    <main>
        
        
        
    </main>
    
    <footer>
        
        
        
    </footer>
    
</body>


</html>