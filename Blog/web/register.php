<?php
    require_once('session.php');
    require_once('User.php');
    require_once('CredentialValidator.php');
    require_once('PendingUser.php');
    
    $session = new session();
    $session::checkLogin();


    if(isset($_POST['btn-submit']))
    {
        
       #DB Prerequisits
       $name = $_POST['name'];
       $password = $_POST['password'];
       $confirmPassword = $_POST['confirmPassword'];
       $email = $_POST['email'];
       $confirmEmail = $_POST['confirmEmail'];
        
       $user = new User($email,$password,$name,$confirmEmail,$confirmPassword);   
       
       $credentials = new CredentialValidator($user);    
       #TODO: Complete CredentialValidatior Class
       $nameCallBack = $credentials->isNameValid();
       $passwordCallBack = $credentials->isPasswordValid();
       $emailCallBack = $credentials->isEmailValid();
        

       if(!$emailCallBack['hasError'] && !$passwordCallBack['hasError'] && !$nameCallBack['hasError']){
               
            $pendingUser = new PendingUser($user);
            $pendingUser->initiateRegisterRequest();
        
            $errType = "success";
            $errorMessage = "Successfully registered, you may log-in";
            
            #Collecting the Garbage
            unset($name);
            unset($email);
            unset($password);
            unset($user);
               
            //header("Location: ../../index.php");
            //exit;
               
        }else {
               
            $errType = "danger";
            $errMessage = "Something went wrong, try again later ...";
               
        }
           
       }
       
    

?>


    <!DOCTYPE html>
    <!--Kompot Website-->

    <html lang="en">


    <head>

        <meta charset="utf-8" />
        <meta name="Registeration" content="Register Form" />
        <meta name="google" content="nositelinkssearchbox" />
        <meta name="google" content="notranslate" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <title>Register Test</title>

        <link type="text/css" rel="stylesheet" href="../css/bootstrap.css">
        <link type="text/css" rel="stylesheet" href="../css/callbacks.css">
        <link type="text/css" rel="stylesheet" href="../css/hide-scale-form.css">
        <link type="text/css" rel="stylesheet" href="../css/registerLayout.css">

        <script type="text/jscript" href="../scripts/bootstrap.js"></script>
        <script type="text/jscript" href="../scripts/jquery-3.1.1.js"></script>

    </head>

    <body background="../../backgroundWallpaper.jpg">

        <header>



        </header>

        <main>
            <div class="container body-content span=8 offset=2">
                <div class="well">
                    <legend>Register</legend>
                    <form class="form-horizontal" action="register.php" method="post" autocomplete="off">
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="user_name">Name</label>
                            <div class="col-sm-4">
                                <input class="form-control" id="user_name" placeholder="Name" name="name" required type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="user_email">Email</label>
                            <div class="col-sm-4">
                                <input class="form-control" pattern="^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$" id="user_email" placeholder="Email" name="email" required type="email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="user_emailConfirm">Confirm Email</label>
                            <div class="col-sm-4">
                                <input class="form-control" pattern="^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$" id="user_emailConfirm" placeholder="Confirm Email" name="confirmEmail" required type="email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="user_password">Password</label>
                            <div class="col-sm-4">
                                <input type="password" class="form-control" pattern="^[a-zA-Z0-9_-]{6,16}$" id="user_password" placeholder="Password" name="password" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="user_password_confirm">Confirm Password</label>
                            <div class="col-sm-4">
                                <input type="password" class="form-control" pattern="^[a-zA-Z0-9_-]{6,16}$" name="confirmPassword" id="user_password_confirm" placeholder="Confirm Password" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-4">
                                <a class="btn btn-default" href="index.html">Cancel</a>
                                <button type="submit" class="btn btn-primary" name="btn-submit">Register</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </main>

        <footer>



        </footer>

    </body>
    
    <script>
    
        
        $('#user_email').bind("cut copy paste",function(e) {
                e.preventDefault();
         });
        
        $('#user_emailConfirm').bind("cut copy paste",function(e) {
                e.preventDefault();
         });
        
        $('#user_password').bind("cut copy paste",function(e) {
                e.preventDefault();
         });
        
        $('#user_password_confirm').bind("cut copy paste",function(e) {
                e.preventDefault();
         });
        
        
    </script>

    </html>
