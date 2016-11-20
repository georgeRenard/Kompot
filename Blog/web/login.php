<?php
    require_once('session.php');
    require_once('User.php');
    
    $session = new session();

    $session::checkLogin();

    $error = false;

    if(isset($_POST['btn-submit']))
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        $email = trim($email);
        $email = strip_tags($email);
        $email = htmlspecialchars($email);
        
        $password = trim($password);
        $password = strip_tags($password);
        $password = htmlspecialchars($password);
        
        $user = new User ($email,$password);
        $emailCallBack = $user->isEmailValid($email);
        $passwordCallBack = $user->isPasswordValid($password);
      
        
        if(!$emailCallBack['hasError']&&!$passwordCallBack['hasError'])
        {
            $user->loginValidation($email,$password);
        }
        
        
        
        
        
        
        
        
        
        
        
    }
?>     
        
        
    


<!DOCTYPE html>
<html>


<head>

    <meta charset="utf-8" />
    <meta name="Login" content="Login Form" />
    <meta name="google" content="nositelinkssearchbox" />\
    <meta name="google" content="notranslate" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login Test</title>

    <link type="text/css" rel="stylesheet" href="../css/bootstrap.css">
    <link type="text/css" rel="stylesheet" href="../css/callbacks.css">

    <script type="text/jscript" href="../scripts/bootstrap.js"></script>
    <script type="text/jscript" href="../scripts/jquery-3.1.1.js"></script>

</head>

<body>

    <header>



    </header>

    <main>
        <div class="container body-content span=8 offset=2">
            <div class="well">
                <form class="form-horizontal" action="login.php" method="post" autocomplete="off">
                    <legend>Login</legend>
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="user_email">Email</label>
                        <div class="col-sm-4">
                            <input class="form-control" pattern="^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$" id="user_email" placeholder="Email" name="email" required type="email">
                        </div>
                    </div>
                   
                    
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="user_password">Password</label>
                        <div class="col-sm-4">
                            <input type="password" class="form-control" pattern="^[a-zA-Z0-9_-]{6,16}$" id="user_password" placeholder="Password" name="password" required>
                        </div>
                    </div>
                   
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-4">
                            <a class="btn btn-default" href="index.html">Cancel</a>
                            <button type="submit" class="btn btn-primary" name="btn-submit">Login</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <footer>



    </footer>

</body>


</html>