<?php date_default_timezone_set("Europe/Sofia");
    require_once('session.php');
    require_once('DataRetriever.php');

    $session = new session();

    $isUser = false;
    $isAdmin = false;

    if(isset($_SESSION['user'])){
        
        $isUser = true;
        $isAdmin = DataRetriever::isAdmin($_SESSION['user']);
    }

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
                    echo "<div class=\"downpointer\">";
                        
                    echo "</div>";
                    echo "<div class=\"user-bubble\">";
                        echo "<img width=\"64\" height=\"64\" src=" . $imageDir . ">";
                    echo "</div>";
                echo "</div>";
            }else {
                #<!-- Sign in / Register -->
                echo "<div class=\"\">";
                echo "</div>";
            }
            ?>
        </header>
        <main>
            <div class="genre-slider">
                <?php
                    if($isAdmin){
                        echo "<div class=\"create-genre\">";
                            echo "<div class=\"button-genre\">";
                        
                            echo "</div>";
                        echo "</div>";
                        
                        echo "<div class=\"slide-left-admin\" onclick=\"location.href='create-genre.php'\">";
                            echo "<div class=\"button-prev\">";
                        
                            echo "</div>";
                        echo "</div>";
                    }else
                    {
                        echo "<div class=\"slide-left\">";
                            echo "<div class=\"button-prev\">";
                            echo "</div>";
                        echo "</div>";
                    }
                ?>
                    <div class="actual-image-container">
                        <!-- Yet to be made -->
                        <ul>
                        <?php
                             #$wallpaper;
                        #echo <li></li>
                        ?>
                        </ul>
                    </div>
                    <div class="slide-right">
                        <div class="button-next">
                            
                        </div>
                    </div>
            </div>

            <div class="page-feed">
                <!-- Player template -->
                <div class="player-container">
                    <div class="player">
                        <div class="player-control">
                            <div class="primary-control">
                                <a id="play-button" href="#" title="Play button" class="play-button"></a>
                            </div>

                            <div class="secondary-control">

                                <div onclick="wavesurfer.pause()" class="stop-button">

                                </div>

                                <div onclick="wavesurfer.stop()" class="pause-button">

                                </div>

                            </div>
                        </div>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/wavesurfer.js/1.2.3/wavesurfer.min.js"></script>
                        <div class="main-control">
                            <div class="track-info">
                                Rae Sremmurd - No Type
                            </div>
                            <progress id="progress" class="progress" value="100" max="100"></progress>
                            <div id="waveform" class="wavesurfer">
                            </div>
                        </div>
                    </div>
                    <div class="genre-tags-container">
                        <ul class="genre">
                            <li><a class="genreTag" href="#">Hip Hop</a></li>
                            <li><a class="genreTag" href="#">Progressive House</a></li>
                        </ul>
                    </div>
                    <div class="tune-control">

                    </div>
                </div>
                <!-- Player template END -->
            </div>
        </main>

        <footer>



        </footer>
        <script>
            var wavesurfer = WaveSurfer.create({
                container: '#waveform',
                waveColor: '#E8E8E8',
                height: '100',
                progressColor: '#40D4A2',
                backend: 'MediaElement',
                barWidth: 3,

            });

            console.log(wavesurfer);

            wavesurfer.load("../Rae Sremmurd - No Type.mp3");

            wavesurfer.on('loading', function(percents) {
                document.getElementById('progress').value = percents;
            });

            $("#play-button").on("click", function() {
                wavesurfer.play();
            });

        </script>


    </body>


    </html>
