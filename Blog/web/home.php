<?php date_default_timezone_set("Europe/Sofia");
    require_once('session.php');
    $session = new session();


?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="" content="#" />
        <meta name="google" content="nositelinkssearchbox" />
        <meta name="google" content="notranslate" />
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Coming Soon</title>

        <link type="text/css" rel="stylesheet" href="../css/bootstrap.css">
        <link type="text/css" rel="stylesheet" href="../css/homeLayout.css">


        <script type="text/jscript" href="Blog/scripts/bootstrap.js"></script>
        <script type="text/jscript" href="Blog/scripts/jquery-3.1.1.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/wavesurfer.js/1.0.52/wavesurfer.min.js"></script>

        <title>Home</title>
    </head>

    <body>

        <header>
            <div class="header">
                <a href="logOut.php">Log Out</a>
                <a href="tuneUpload.php">Upload</a>
                <a href="userAccount.php">My Profile</a>
            </div>
        </header>
        <main>
            <div class="player">
                <div class="player-control">
                    <div class="primary-control">
                        <button class="play-button"></button>
                    </div>

                    <div class="secondary-control">
                        <div class="stop">
                            <button class="stop-button"></button>
                        </div>
                        <div class="pause">
                            <button class="pause-button"></button>
                        </div>
                    </div>
                </div>
                <div class="main-control">
                    <div clss="track-info">
                        <canvas>

                        </canvas>
                    </div>

                    <div id="waveform" class="wavesurfer">
                        
                    </div>
                </div>
            </div>
        </main>

        <footer>



        </footer>

    </body>


    </html>
