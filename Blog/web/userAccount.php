<?php
    require_once('session.php');
    require_once('DataRetriever.php');
    require_once('UpdateImage.php');


    $session = new session();


    #In case the user tries to update his profile picture
    if(isset($_POST['btn-submit'])){
        
        updateImageRequest();
        
    }
       

    $userId = $_SESSION['user'];
    $imageUrl = "../../Default-Profile-Picture.jpg";

    $user = DataRetriever::getUserData($userId);
    $userOptional = DataRetriever::getUserOptionalData($userId); 

    if($userOptional['imageUrl'] != $imageUrl){
        
        $imageUrl = $userOptional['imageUrl'];
        
    }

?>


    <!DOCTYPE html>
    <!--Kompot Website-->

    <html lang="en">


    <head>

        <meta charset="utf-8" />
        <meta name="User Profile" content="User Profile Page" />
        <meta name="google" content="nositelinkssearchbox" />
        <meta name="google" content="notranslate" />
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>My Account</title>

        <link type="text/css" rel="stylesheet" href="../css/bootstrap.css">
        <link type="text/css" rel="stylesheet" href="../css/navbar.css">
        <link type="text/css" rel="stylesheet" href="../css/myProfileLayout.css">

        <script src="../scripts/jquery-3.1.1.min.js"></script>
        <script src="../scripts/bootstrap.js"></script>

    </head>

    <body>

        <header>



        </header>

        <main>
            <div class="container-fluid">
                <div class="navColumn">
                    <nav id="sidebar" class="visible navbar-inverse sidebar navigation" role="navigation">
                        <div class="navbar-header">
                            <legend>
                                <?=$user['name']?>
                            </legend>
                        </div>
                        <div class="navbar-body">
                            <ul class="nav navbar-nav">

                                <li><a href="#">My Profile</a></li>
                                <li><a href="#">My Playlist</a></li>
                                <li><a href="#">My Likes</a></li>
                                <li><a href="#">Security Update</a></li>
                                <li><a href="#">Report</a></li>

                            </ul>
                        </div>
                        <div id="sidebar-btn" class="navbar-btn">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </nav>
                </div>
                <!-- Click Event: SideBar Toggle:Visible/Hidden -->
                <script>
                    /* Vanko tva shto ne raboti :( :( */
                    /*$(document).ready(function() {

                        $('#sidebar-btn').click(function() {
                            console.log("Hello");//$('#sidebar').toggleClass('visible');
                        });

                    });
                    */
                    $('#sidebar-btn').click(function() {

                        $('#sidebar').toggleClass('visible');

                    });

                </script>
                <!-- User profile card -->
                <div class="userDataColumn">

                    <div class="image-container">

                        <img src="<?=$imageUrl?>">

                    </div>
                    <!-- User data form -->
                    <div class="form-container">

                        <form id="dataForm" class="form-horizontal" action="userAccount.php" method="POST">

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="displayName">Name</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" disabled id="displayName" value="<?=$user['name']?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="displayEmail">Email</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" disabled id="displayEmail" value="<?=$user['email']?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="displayGender">Gender</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" disabled id="displayGender" value="<?=$userOptional['gender']?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="displayCountry">Country</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" disabled id="displayCountry" value="<?=$userOptional['country']?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="displayName">Genre</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" disabled id="displayName" value="<?=$userOptional['genre']?>">
                                </div>
                            </div>


                        </form>

                    </div>
                    <!-- Upload and Browse buttons -->
                    <form class="form-horizontal" enctype="multipart/form-data" action="userAccount.php" method="POST">
                        <div class="form-group">
                            <div class="col-lg-6 col-sm-6 col-12">
                                <label class="btn btn-primary">
                                    Browse&hellip;
                                    <input class="form-control" type="hidden" name="MAX_FILE_SIZE" value="1048576" />
                                    <input type="file" name="profilePicture" style="display: none;">
                                </label>
                                <input class="btn btn-primary" name="btn-submit" value="Upload" type="submit">
                            </div>
                        </div>
                    </form>

                </div>
            </div>

        </main>

        <footer>



        </footer>


    </body>


    </html>
