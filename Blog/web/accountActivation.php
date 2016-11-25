<?php
    require_once('session.php');
    require_once('User.php');
    require_once('tokenCheck.php');
    require_once('SmallUpdates.php');

    $session = new session();

    if(!isset($_GET["token"])){
        
        header("Location: ../../index.php");
        
    }

    #Check if token is valid
    if (preg_match('/^[0-9A-F]{40}$/i', $_GET["token"])) {
        
        $token = $_GET["token"];
        
        $pendingUser = verifyUser($token);
        if(!empty($pendingUser))
        {
            if(!didTokenExpire($pendingUser['timestamp']))      
            $user = new User($pendingUser['email'],$pendingUser['password'],$pendingUser['name']);
            $user->registerUser();
            $result = SmallUpdates::removePendingUser($token);
            if(!empty($result)){
                unset($pendingUser);
                unset($token);
            }
            unset($user);
        }
        
    }
    else {
        throw new Exception("Valid token not provided.");
    }

    

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
        
        <p>You were registered successfully! You can create your <a href="profile.php">profile</a> now or log in into your <a href="login.html">account</a> :)</p>
        
    </header>
    
    <main>
        
        
        
    </main>
    
    <footer>
        
        
        
    </footer>
    
</body>


</html>