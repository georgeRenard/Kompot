<?php date_default_timezone_set("Europe/Sofia");
    require_once('session.php');
    require_once('DataRetriever.php');

    $session = new session();
    $session::isUser();
    $session::isTuneAwaiting();

    $isUser = true;
    $isAdmin = false;
    $isAdmin = DataRetriever::isAdmin($_SESSION['user']);

?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="" content="#" />
        <meta name="google" content="nositelinkssearchbox" />
        <meta name="google" content="notranslate" />
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link type="text/css" rel="stylesheet" href="../css/bootstrap.css">
        <link type="text/css" rel="stylesheet" href="../css/tinyscrollbar.css">
        <link type="text/css" rel="stylesheet" href="../css/previewLayout.css">

        <script src="../scripts/jquery-3.1.1.min.js"></script>
        <script src="../scripts/bootstrap.js"></script>
        <script src="../beat_detection/libraries/p5.js"></script>
        <script src="../beat_detection/libraries/p5.dom.js"></script>
        <script src="../beat_detection/libraries/p5.sound.js"></script>
        <script src="../beat_detection/sketch.js"></script>
        <script src="../scripts/jquery.tinyscrollbar.js"></script>

        <title>Home</title>
    </head>

    <body>

        <header>
            <?php
                if($isUser){
                    $imageDir = "../bubble_avatar/" . "user_" . $_SESSION['user'];
                    echo "<div class=\"header\">";
                    echo "<div id=\"downpointer\" class=\"downpointer\">"; 
                    echo "</div>";
                            echo "<ul id=\"side-menu\" class=\"side-menu\">";
                            echo "<li><a href=\"home.php\">Home</a>";
                            echo "<li><a href=\"userAccount.php\">My Account</a>";
                            echo "<li><a href=\"preview.php\">My Playlist</a>";
                            echo "<li><a href=\"tuneUpload.php\">Upload Tune</a>";
                            if($isAdmin){
                            echo "<li><a href=\"genre-create\">Create Genre</a>";
                            }
                            echo "<li><a href=\"../../index.php\">Back to index</a>";
                            echo "<li><a href=\"logOut.php\">Log Out</a>";
                        echo "</ul>";
                    echo "<div class=\"user-bubble\">";
                        echo "<img width=\"64\" height=\"64\" src=" . $imageDir . ">";
                    echo "</div>";
                echo "</div>";
            }else {
                #<!-- Sign in / Register -->
                echo "<div class=\"header-non-user\">";
                    echo "<button class=\"button\" onclick=\"location.href='web/register.php'\" type=\"button\">Register</button>";
                    echo "<button class=\"button\" onclick=\"location.href='login.php'\" type=\"button\">Sign In</button>";
                echo "</div>";
            }
            ?>
        </header>
        <main>

            <div class="content">
                <div class="control">
                    <div class="playlist">
                        <div class="current-tune">
                            <div class="play-pause">
                                <a id="togglebutton"></a>
                            </div>
                            <div class="current-tune-details">

                            </div>
                        </div>
                        <div class="list">
                            <ul>
                                <li>
                                    <div class="tune-generated-id">
                                        1
                                    </div>
                                    <div class="tune-details">
                                        <div class="title">
                                            How deep is your love
                                        </div>
                                        <div class="artist">
                                            Calvin Harris
                                        </div>
                                    </div>
                                    <div class="remove-tune">
                                        <a class="xbutton"></a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="visualizer">

                </div>
            </div>

        </main>

        <script>
            $('#downpointer').on('click', function() {

                $('#side-menu').toggleClass('active');

            });
            
            $('#togglebutton').click(function(){
               
                $('#togglebutton').toggleClass('pause');
                
            });

            $(document).ready(function() {

                $('#scrollbar3').tinyscrollbar({
                    tracksize: 100
                });

            });

        </script>
    </body>


    </html>
