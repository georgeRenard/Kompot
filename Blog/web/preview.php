<?php date_default_timezone_set("Europe/Sofia");
    require_once('session.php');
    require_once('DataRetriever.php');

    $session = new session();
    $session::isUser();
    $session::isTuneAwaiting();


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
        <link type="text/css" rel="stylesheet" href="../css/previewLayout.css">

        <script src="../scripts/jquery-3.1.1.min.js"></script>
        <script src="../scripts/bootstrap.js"></script>

        <title>Home</title>
    </head>

    <body>

        <header>
            <?php
                if($isUser){
                    $imageDir = "../bubble_avatar/" . "user_" . $_SESSION['user'];
                    echo "<div class=\"header\">";
                    echo "<div id=\"downpointer\" class=\"downpointer\">";
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
                    echo "</div>";
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
                <canvas class="display">

                </canvas>
                <div>
                    <div class="playlist">

                    </div>
                </div>
            </div>

        </main>

        <script>
            $('#downpointer').on('click', function() {

                $('#side-menu').toggleClass('active');

            });

        </script>

    </body>


    </html>
