<?php
    require_once('session.php');
    require_once('User.php');
    require_once('Logger.php');
    require_once('CredentialValidator.php');
    
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
        $credentials = new CredentialValidator($user);
        
        $passwordCallBack = $credentials->isPasswordValid();  
        
        if(filter_var($email,FILTER_VALIDATE_EMAIL) &&!$passwordCallBack['hasError'])
        {
            
            $result = $user->loginValidation($email,$password);
            if(is_int($result)){
                
                $logger = new Logger();
                $logger->logTrace($email,'logIn');
                
                $_SESSION['user'] = $result;
                header("Location: home.php");
                exit;
            }
            
            echo "Incorrect name or password. Please, try again.";
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

    
     <link type="text/css" rel="stylesheet" href="../css/loginpage.css">
 <link type="text/css" rel="stylesheet" href="../css/bootstrap.css">
     
    
    <script src="../scripts/bootstrap.js"></script>
    <script src="../scripts/jquery-3.1.1.min.js"></script>
   


</head>

<body>

    
    
    <div class="wrapper">
	<div class="container">
		<h1>Welcome</h1>
		
		<form class="form" method="post" action="login.php">
			 <input  pattern="^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$" id="user_email" placeholder="Email" name="email" required type="email">
			<input type="password"  pattern="^[a-zA-Z0-9_-]{6,16}$" id="user_password" placeholder="Password" name="password" required>
			<button type="submit" id="login-button" name="btn-submit">Login</button>
		</form>
	</div>
	
	<ul class="bg-bubbles">
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
	</ul>
</div>
  

</body>


</html>