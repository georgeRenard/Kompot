<?php
    ob_start();
    session_start();

    if(isset($_SESSION['user']) != ""){
       
      header("Location: index.php");
       
    }

    include_once "class.sqlite3.inc.php";

    $error = false;

    if(isset($_POST['btn-submit']))
    {
        
       #DB Prerequisits
       $db = new SQLite3_module();
       $dbPath = "../../DB Browser for SQLite/myDB.db";
        
       #Name Extraction / No HTML TAGS / No Special HTML Chars
       $name = trim($_POST['name']);
       $name = strip_tags($name);
       $name = htmlspecialchars($name);
        
       #Email Extraction / No HTML TAGS / No Special HTML Chars
       $email = trim($_POST['email']);
       $email = strip_tags($email);
       $email = htmlspecialchars($email);
        
       #Password Extraction / No HTML TAGS / No Special HTML Chars    
       $pass = trim($_POST['password']);
       $pass = strip_tags($pass);
       $pass = htmlspecialchars($pass);
        
       #Confirm Password Extraction / No HTML TAGS / No Special HTML Chars
       $confirmPassword = trim($_POST['confirmPassword']);
       $confirmPassword = strip_tags($confirmPassword);
       $confirmPassword = htmlspecialchars($confirmPassword);
       
        
       #String Validations [Name]
        
       if(empty($name)){
           
           $error = true;
           $nameError = "Please enter your full name.";
           
       }else if(strlen($name) < 4){
           
           $error = true;
           $nameError = "Name must have atleast 4 characters.";
           
       }else if(!preg_match("/^[a-zA-Z ]+$/", $name)){
           
           $error = true;
           $nameError = "Name must contain only alphabets and space.";
           
       }
       
       #String Validations [Email]
       
       if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
           
           $error = true;
           $emailError = "Please enter a valid email adress.";
           
       }else{
           
           #Check if the Email already exists in the Database
           $query = "SELECT email FROM users WHERE email='$email'";
           $result = $db->db_oper($dbPath,$query);
           
           if(!empty($result)){
               
               $error = true;
               $emailError = "The provided Email is already in use.";
           }
           
       }
        
       #String Validation [Password];
        
       if(empty($pass)){
           
           $error = true;
           $passwordError = "Please enter password.";
           
       }else if(strlen($pass) < 6){
           
           $error = true;
           $passwordError = "Password must have atleast 6 characters.";
           
       }else if($pass != $confirmPassword){
           
           $error = true;
           $passwordError = "Passwords do not match";
           
       }
        
       #Encrypting the password using SHA256
        
       $password = hash('sha256',$pass);
        
       if(!$error)
       {
           
           $query = "INSERT INTO users(name,password,email) VALUES('$name','$password','$email')";
           $dbRes = $db->db_oper($dbPath,$query); #DB result
        
           if($dbRes){
               
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

<html>


<head>

    <meta charset="utf-8" />
    <meta name="Registeration" content="Register Form" />
    <meta name="google" content="nositelinkssearchbox" />\
    <meta name="google" content="notranslate" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Register Test</title>

    <link type="text/css" rel="stylesheet" href="../css/bootstrap.css">
    <link type="text/css" rel="stylesheet" href="../css/bootstrap-theme.css">
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
                <form class="form-horizontal" action="register.php" method="post" autocomplete="off">
                    <legend>Register</legend>
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
