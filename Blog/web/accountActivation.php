<?php
    require_once('session.php');
    require_once('User.php');
    require_once('tokenCheck.php');
    require_once('SmallUpdates.php');

    $session = new session();
    $session::checkLogin();
    $session::isTuneAwaiting();

    if(!isset($_GET["token"])){
        
        header("Location: ../../index.php");
        
    }

    #Check if token is valid
    if (preg_match('/^[0-9A-F]{40}$/i', $_GET["token"])) {
        
        $token = $_GET["token"];
        
        $pendingUser = verifyUser($token);
        if(!empty($pendingUser))
        {
            $tokenInspect = didTokenExpire($pendingUser['timestamp']);
            
            if(!$tokenInspect['isExpired'])     
                
                $user = new User($pendingUser['email'],$pendingUser['password'],$pendingUser['name']);
                $user->registerUser();
               
        }
        
        $result = SmallUpdates::removePendingUser($token);
        
    }
    else {
        header("Location: ../../index.php");
        exit;
    }

    
?>
    <!DOCTYPE html>
    <!--Kompot Website-->

    <html>


    <head>

        <meta charset="utf-8" />
        <meta name="#" content="#" />
        <meta name="google" content="nositelinkssearchbox" />
        <meta name="google" content="notranslate" />
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Coming Soon</title>

        <link type="text/css" rel="stylesheet" href="../css/bootstrap.css">
        <link type="text/css" rel="stylesheet" href="../css/bootstrap-theme.css">
        <link type="text/css" rel="stylesheet" href="../css/accountActivationLayout.css">

        <script type="text/jscript" href="../scripts/bootstrap.js"></script>
        <script type="text/jscript" href="../scripts/jquery-3.1.1.js"></script>

    </head>

    <body>

        <header>
            
            <?php
                #<!-- Sign in / Register -->
                echo "<div class=\"header-non-user\">";
                    echo "<button class=\"button\" onclick=\"location.href='register.php'\" type=\"button\">Register</button>";
                    echo "<button class=\"button\" onclick=\"location.href='login.php'\" type=\"button\">Sign In</button>";
                echo "</div>";
            ?>
        </header>

        <main>

            <div class="message">
                <?php
                    if(isset($_GET['token'])){
                        if(!empty($tokenInspect)){
                            echo $tokenInspect['message'];
                        }
                    }
                ?>
            </div>

        </main>

        <footer>



        </footer>

    </body>


    </html>
