<?php
    require_once('session.php');
    require_once('DataRetriever.php');

    $session = new session();
    $session::isUser();

    $userId = $_SESSION['user'];
    $user = DataRetriever::getUserData($userId);
    
    if(!empty($user)){
        
        $userName = $user['name'];
        $userAvatar = "../ellipse_avatar/user_" . $userId;
        unset($user);
        unset($userId);
        
    }else{
        
        #If data couldn't be retrieved
        
    }



?>


    <html>

    <head>


        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="upload" content="Upload Tune" />
        <meta name="google" content="nositelinkssearchbox" />
        <meta name="google" content="notranslate" />
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Upload Tune</title>

        <link type="text/css" rel="stylesheet" href="../css/bootstrap.css">
        <link type="text/css" rel="stylesheet" href="../css/uploadTuneStyle.css">

        <script src="../scripts/jquery-3.1.1.min.js"></script>
        <script src="../scripts/bootstrap.js"></script>



    </head>


    <body>


        <header>


            <!-- Navbar -->
            <div class="infoBar">
                <div class="image-container">
                    <img class="img-circle" src="<?=$userAvatar?>">
                </div>


            </div>


            <div class="secondary-bar">

                <!-- Idea from flavicons.com / Implementation idea by Jonathan Suh -->
                <button id="collapseButton" class="hamburger-button collapse-style is-active" type="button">
                    <span class="hamburger-box">
                        <span class="hamburger-inner">
                            
                        </span>
                    </span>
                    <span class="hamburger-label">
                        <?=$userName?>
                    </span>
                </button>

                <legend>True Slavs |||</legend>

                <script>
                    /* Button Action JQuery Here */
                    $('#collapseButton').click(function() {

                        $('#collapseButton').toggleClass('is-active');

                    });

                </script>

            </div>

        </header>

        <main>

            <!-- The main form -->



        </main>


        <footer>



        </footer>

    </body>




    </html>
