<?php
    require_once('session.php');
    require_once('User.php');
    
    $session = new session();

    $session::checkLogin();

    $error = false;

    if(isset($_POST['btn-submit']))
    {
        
       #DB Prerequisits
       $name = $_POST['name'];
       $password = $_POST['password'];
       $email = $_POST['email'];
       $gender = $_POST['gender'];
       $country = $_POST['country'];
        
       $user = new User($email,$password,$name);  
       $nameCallBack = $user->isNameValid($name);
       $passwordCallBack = $user->isPasswordValid($password);
       $emailCallBack = $user->isEmailValid($email);
        
        
       if(!$error)
       {
           
           $user->registerUser();
           if(!$emailCallBack['error'] && !$passwordCallBack['error'] && !$nameCallBack['error']){
               
               $errType = "success";
               $errorMessage = "Successfully registered, you may log-in";
               
               #Collecting the Garbage
               unset($name);
               unset($email);
               unset($pass);
               
               header("Location: ../../index.php");
               exit();
               
           }else {
               
               $errType = "danger";
               $errMessage = "Something went wrong, try again later ...";
               
           }
           
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
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Register Test</title>

        <link type="text/css" rel="stylesheet" href="../css/bootstrap.css">
        <link type="text/css" rel="stylesheet" href="../css/callbacks.css">
        <link type="text/css" rel="stylesheet" href="../css/hide-scale-form.css">
        <link type="text/css" rel="stylesheet" href="../css/page.css">

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
                                <label class="col-sm-4 control-label" for="user_email">Email</label>
                                <div class="col-sm-4">
                                    <input class="form-control" pattern="^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$" id="user_email" placeholder="Email" name="email" required type="email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="user_name">Name</label>
                                <div class="col-sm-4">
                                    <input class="form-control" id="user_name" placeholder="Name" name="name" required type="text">
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
                                <label class="col-sm-4 control-label" for="user_country">Gender</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="gender" id="user_gender">
                                        <option value="null"></option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="user_country">Country</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" pattern="^[^\d]+$" name="country" id="user_country" placeholder="Country">
                                </div>
                            </div>
                            <div class="form-group">
                            
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


    </html>
