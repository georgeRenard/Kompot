<?php date_default_timezone_set("Europe/Sofia");
    require_once('session.php');
    require_once('DataRetriever.php');

    $session = new session();
    $session::isTuneAwaiting();

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

        <link type="text/css" rel="stylesheet" href="../css/bootstrap.css">
        <link type="text/css" rel="stylesheet" href="../css/homeLayout.css">

        <script src="../scripts/jquery-3.1.1.min.js"></script>
        <script src="../scripts/bootstrap.js"></script>
        <script src="../scripts/thumbnail-slider.js"></script>

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
                            echo "<li><a href=\"create-genre.php\">Create Genre</a>";
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
            <div class="genre-slider">

                <div id="thumbnail-slider">
                    <?php
                    if($isAdmin){
                        echo "<div class=\"create-genre\">";
                            echo "<img class=\"button-genre\" src=\"../images/upload-arrow.png\" onclick=\"location.href='create-genre.php'\" >";
                        echo "</div>";
                        
                        echo "<div id=\"left\" class=\"slide-left-admin\">";
                            //echo "<div class=\"\">";
                        
                            //echo "</div>";
                        echo "</div>";
                    }else
                    {
                        echo "<div id=\"left\" class=\"slide-left\">";
                            //echo "<div class=\"button-prev\">";
                            //echo "</div>";
                        echo "</div>";
                    }
                    ?>
                        <div class="inner">
                            <!-- Yet to be made -->
                            <ul>
                                <?php
                            $genres = DataRetriever::getGenres();
                            if(!empty($genres)){
                            
                            foreach($genres as $genre)
                            {
                                $wallpaper = $genre['wallpaper'];
                                $query = "SELECT name FROM genre WHERE wallpaper = '$wallpaper'";
                                $genresName = DataRetriever::getGenreNames($query);
                                
                                if(!empty($genresName)){
                                
                                echo "<li class=\"\" >";
                                    echo "<div id=\"".$genresName[0]['name']."\" class=\"genreName\">";
                                        echo "<img class=\"thumb\" src=\"" . $genre['wallpaper'] ."\" style=\"height:auto;\" />";
                                        echo "<script>
                                            $(document).ready(function(){
                                            $(\"#".$genresName[0]['name']."\").click(function(){
                                            
                                            var genreName = \"".$genresName[0]['name']."\"

                                            $.ajax({

                                            type: \"POST\",
                                            url: \"sortByGenre.php\",
                                            data: {
                                                genre: genreName
                                            },
                                            asynch: false,

                                            success: function(event) {
                                                if (event != \"Success\") {
                                                    window.alert(event);
                                                }else{
                                                    location.reload();
                                                }
                                            },

                                            error: function() {
                                            window.alert(\"Service unavailable right now. Please, try again later\");
                                            }
                                            });
                                        });
                                        
                                        });</script>";
                                    echo "<div class=\"nail\">";
                                    
                                if($isAdmin){
                                    echo "<div class=\"genre-edit\" onclick=\"genreManage()\"></div>";
                                    echo "<div class=\"genre-delete\" onclick=\"genreManage()\"></div>";
                                
                                    
                                echo "/div";
                                    
                                }
                            }
                        }
                    }
                        ?>
                            </ul>
                        </div>
                        <div id="right" class="slide-right">
                            <div id="buttn" class="">

                            </div>
                        </div>
                </div>
            </div>


            <div class="page-feed">
                <!-- Player template -->
                <?php
                    require_once('musicplayer.php');
                
                    $query = "none";    
                    if(isset($_SESSION['tuneByGenre'])){
                        
                        $genre = trim($_SESSION['tuneByGenre']);
                        $genre = strip_tags($genre);
                        $genre = htmlspecialchars($genre);
                        $genre = SQLite3::escapeString($genre);
                        
                        $query = "SELECT * FROM music WHERE genre LIKE '%$genre%'";
                        unset($_SESSION['tuneByGenre']);
                    }
                    
                    $tunes = DataRetriever::getTunes($query);
                
                    if(!empty($tunes)){
                        
                        foreach($tunes as $tune){
                            
                            renderPlayer($tune);
                            
                        }
                        
                    }
                    ?>
                    <!-- Player template END -->
            </div>
        </main>

        <script>
            $('#downpointer').on('click', function() {

                $('#side-menu').toggleClass('active');

            });

        </script>

    </body>


    </html>
