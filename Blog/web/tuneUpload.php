<?php
    require_once('session.php');
    require_once('DataRetriever.php');
    require_once('tune_finalize.php');

    $session = new session();
    $session::isUser();

    if(!isset($_POST['submit-track'])){
        $session::isTuneAwaiting();
    }

    $userId = $_SESSION['user'];
    $user = DataRetriever::getUserData($userId);

    $isAdmin = DataRetriever::isAdmin($userId);

    if(!empty($user)){
        
        $userName = $user['name'];
        $userAvatar = "../ellipse_avatar/user_" . $userId;
        unset($user);
        unset($userId);
        
    }else{
        
        #If data can't be retrieved
        header('HTTP 1.0/400 Bad Request');
        
    }

    $boo = isset($_POST['submit-track']);

    if(isset($_POST['submit-track'])){
        
        $error = false;
        
        if(!isset($_SESSION['tune'])) {$error = true;}
        
        if(!$error) {
            
            $error = tuneFinalize($_SESSION['user']);
        }
        
        if($error) {
            http_response_code(400);
            
        }else{
            header("Location: home.php");
            exit;
        }
        
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.7.5/css/bootstrap-select.min.css">
        <link type="text/css" rel="stylesheet" href="../css/uploadTuneStyle.css">

        <scirpt src="../scripts/progress.js"></scirpt>
        <script src="../scripts/jquery-3.1.1.min.js"></script>
        <script src="../scripts/bootstrap.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.7.5/js/bootstrap-select.min.js"></script>



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
                <button id="collapseButton" class="hamburger-button collapse-style" type="button">
                    <span class="hamburger-box">
                        <span class="hamburger-inner">
                            
                        </span>
                    </span>
                    <span class="hamburger-label">
                        <?=$userName?>
                    </span>
                </button>

                <ul id="side-menu" class="side-menu">
                    <li><a href="home.php">Home</a></li>
                    <li><a href="userAccount.php">My Profile</a></li>
                    <li><a href="preview.php">My Playlist</a></li>
                    <?php
                        if($isAdmin){
                            echo "<li><a href=\"create-genre.php\">Create Genre</a></li>";
                        }
                    ?>
                    <li><a href="../../index.php">Back to index</a></li>
                    <li><a href="userAccount.php">Report</a></li>
                    <li><a href="logOut.php">Logout</a></li>
                </ul>

                <legend>True Slavs |||</legend>

                <script>
                    /* Button Action JQuery Here */
                    $('#collapseButton').click(function() {

                        $('#collapseButton').toggleClass('is-active');
                        $('#side-menu').toggleClass('active');

                    });

                </script>

            </div>

        </header>

        <main>

            <!-- The main form -->
            <div class="container">

                <div class="upload-info">

                    <div class="upload-progress">
                        <div id="upload-line" class="upload-line">

                        </div>
                    </div>

                    <div class="upload-feedback">

                        <b id="progress-label">0% uploaded..</b>
                        <!-- The Name of the file here -->

                    </div>

                </div>

                <div class="upload-main">
                    <div class="file-choose-section">

                        <div class="user-message">
                            MP3 or other <strong>compressed</strong> file types
                        </div>

                        <div class="button-holder">
                            <div class="upload-button-style btn btn-primary">
                                <form id="upload-form" class="upload-form" method="post" enctype="multipart/form-data">
                                    <span class="upload-hidden-label">Select a file</span>
                                    <input class="form-control" type="hidden" name="MAX_FILE_SIZE" value="11000000" />
                                    <input class="upload-hidden" id="file" type="file">

                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Not fucking working :() Damn...                     -->
                    <script>
                        $(document).ready(function() {

                            $('#file').change(function() {
                                $.getScript('../scripts/progress.js').done(function() {
                                    uploadFile();
                                });
                            });

                        });

                    </script>
                    <div class="form-container">

                        <form id="data-form" class="form-horizontal" action="tuneUpload.php" method="post">

                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="artist">Artist</label>
                                <div class="col-sm-6">
                                    <input autocomplete="off" class="form-control" required type="text" placeholder="Artist" id="artist" name="artist" pattern="^[a-zA-Z\s]{3,32}$">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="artist">Title</label>
                                <div class="col-sm-6">
                                    <input autocomplete="off" class="form-control" required type="text" placeholder="Title" id="title" name="title" pattern="^[a-zA-Z\s]{4,22}$">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="genre">Genre</label>
                                <div class="col-sm-6">
                                    <select class="selectpicker" required name="genres[]" data-style="btn-primary" title="Choose one of the following" multiple data-max-options="4">
                                        <?php
                                            
                                            $genres = DataRetriever::getGenreNames();
                         
                                            if(empty($genres)){
                                                http_response_code(400);
                                                exit;
                                            }
                         
                                            foreach($genres as $genre)
                                            {
                                                echo "<option value=\"". $genre['name'] . "\">" . $genre['name'] . "</option>";
                                            }
                                            
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-4">
                                    <button type="reset" class="btn btn-default">Cancel</button>
                                    <button name="submit-track" id="submit-button" type="submit" class="btn btn-primary">Upload</button>
                                </div>

                            </div>

                        </form>

                    </div>

                </div>
            </div>

        </main>

       <footer>
            <div class="footer">
                <div class="social-links">
                    <div class="center">
                        <div class="inner-center">
                            <button class="button-fb" onclick="location.href='https://www.facebook.com/trueslavs/'" type="button">&nbsp; FACEBOOK
                            </button>
                        </div>
                    </div>
                </div>
                <p class="links"><a href="aboutUs.html">About Us</a> | <a href="home.php">Music</a> | <a href="policy.html">Privacy Policy</a>| <a href="contact.html">Contact</a>| <a href="http://adidas.com">Adidas</a></p>
                <p class="copyright">&copy; 2042 Kompot of Rhytms. All rights reserved. Made with Suka by TRUE SLAVS |||</p>
                <p class="copyright">We do not own any of the rights regarding the music we post. It's only for entertainment purposes! True Slavs |||</p>
            </div>
        </footer>


    </body>




    </html>
