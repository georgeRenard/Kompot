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
    <meta name="google" content="nositelinkssearchbox" />
    <meta name="google" content="notranslate" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login Test</title>

    
     <link type="text/css" rel="stylesheet" href="../css/loginpage.css">
 <link type="text/css" rel="stylesheet" href="../css/index.css">
     
    
    <script src="../scripts/bootstrap.js"></script>
    <script src="../scripts/jquery-3.1.1.min.js"></script>
   


</head>

<body>
<header></header>
    
   <main>
       <div id="snow"></div>
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
  </main> 
     <div class="dark-footer">
     <footer class="footer-wrapper bottom-footer">
                <div class="footer">
                    <div class="social-links">
                        <div class="center">
                            <div class="inner-center">
                                <button class="button-fb" onclick="location.href='https://www.facebook.com/trueslavs/'" type="button">&nbsp; FACEBOOK
                                </button>
                            </div>
                        </div>
                    </div>
                    <p class="links"><a href="Blog/web/aboutUs.html">About Us</a> | <a href="#">Music</a> | <a href="Blog/web/policy.html">Privacy Policy</a>| <a href="Blog/web/contact.html">Contact</a>| <a href="http://adidas.com">Adidas</a></p>
                    <p class="copyright">&copy; 2042 Kompot of Rhytms. All rights reserved. Made with Suka by TRUE SLAVS |||</p>
                    <p class="copyright">We do not own any of the rights regarding the music we post. It's only for entertainment purposes! True Slavs |||</p>
                </div>
            </footer>
    
    </div>
</body>


</html>