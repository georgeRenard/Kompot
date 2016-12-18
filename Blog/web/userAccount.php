<?php
    require_once('session.php');
    require_once('DataRetriever.php');
    require_once('UpdateImage.php');
    require_once('Report.php');

    $session = new session();
    $session::isUser();
    $session::isTuneAwaiting();

    #In case the user tries to update his profile picture
    if(isset($_POST['btn-submit'])){
        
        updateImageRequest();
        
    }

    if(isset($_POST['btn-report'])){
        
        $report = new report($_SESSION['user'],$_POST['title'],$_POST['report_body']);
        
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

                                <li><a href="userAccount.php">My Profile</a></li>
                                <li><a href="preview.php">My Playlist</a></li>
                                <li><a href="#">My Likes</a></li>
                                <li><a href="profileData.php">Account Update</a></li>
                                <li><a href="#report">Report</a></li>

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
                    <div class="user_picture_section">
                        <div class="image-container">

                            <img src="<?=$imageUrl?>">

                        </div>

                        <!-- Upload and Browse buttons -->
                        <div id="uploadField" class="col-lg-12">
                            <form id="buttonForm" class="form-horizontal" enctype="multipart/form-data" action="userAccount.php" method="POST">
                                <div class="col-md-12">
                                    <label class="btn btn-primary">
                                        Browse&hellip;
                                        <input class="form-control" type="hidden" name="MAX_FILE_SIZE" value="1048576" />
                                        <input type="file" name="profilePicture" style="display: none;">
                                    </label>
                                    <input class="btn btn-primary" name="btn-submit" value="Upload" type="submit">
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- User data form -->
                    <div class="form-container">

                        <form id="dataForm" class="form-horizontal" action="userAccount.php" method="POST">

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="displayName">Name</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" disabled id="displayName" value="<?=$user['name']?>">
                                </div>
                                <img class="input-icon" src="../form-icons/name.svg" width="36px" height="36px">
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="displayEmail">Email</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" disabled id="displayEmail" value="<?=$user['email']?>">
                                </div>
                                <img class="input-icon" src="../form-icons/email.svg" width="36px" height="36px">
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="displayGender">Gender</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" disabled id="displayGender" value="<?=$userOptional['gender']?>">
                                </div>
                                <img class="input-icon" src="../form-icons/gender.svg" width="36px" height="36px">
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="displayCountry">Country</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" disabled id="displayCountry" value="<?=$userOptional['country']?>">
                                </div>
                                <img class="input-icon" src="../form-icons/country.svg" width="36px" height="36px">
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="displayName">Genre</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" disabled id="displayName" value="<?=$userOptional['genre']?>">
                                </div>
                                <img class="input-icon" src="../form-icons/genre.svg" width="36px" height="36px">
                            </div>


                        </form>

                    </div>

                </div>


            </div>

            <section id="middleSection" class="parallax">
                <h1>|||</h1>
                <h3>True Slavs</h3>
            </section>

            <div class="reportPage">
                <div class="report">
                    <legend class="reportLegend">Report</legend>
                    <a name="report"></a>

                    <form id="reportForm" class="form-horizontal" action="userAccount.php" method="post">

                        <div id="report_title_group" class="form-group">
                            <label class="col-md-4 control-label" for="title">Title</label>
                            <div class="col-md-4">
                                <input type="text" pattern="^[A-Za-z\s]{6,24}$"class="form-control" name="title" id="report_title" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="body">Body</label>
                            <div class="form-group-lg">
                                <textarea class="form-control" name="report_body" rows="14" id="body"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-4">
                                <button class="btn btn-default" type="reset">Reset</button>
                                <button class="btn btn-danger" name="btn-report" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

        </main>

        <footer>

        </footer>
        <script>
            //Js Validate TextArea Function -->

        </script>


    </body>


    </html>
