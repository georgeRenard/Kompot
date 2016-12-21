<?php
    require_once('session.php');
    require_once('Profiler.php');
    
    $session = new session();
    $session::isUser();
    $session::isTuneAwaiting();

    
    #TODO: CREATE A WAY TO FETCH A SIDEBAR WITH GENRES AND WHEN THE USER CHOOSES ONE OF THEM IT AUTOMATICALLY APPENDS 
    #TO THE REST IN THE TEXTBOX
    
    
    if(isset($_POST['btn-submit'])){
        
        $error = false;
        
        $profile = new Profiler($_SESSION['user'],$_POST['country'],$_POST['city'],$_POST['genres'],$_POST['gender']);
        $noError = $profile->saveProfileData();
        
        if($noError){
            header("Location: home.php");
            exit;
        }
        
    }



?>



    <!DOCTYPE html>
    <!--Kompot Website-->

    <html lang="en">


    <head>

        <meta charset="utf-8" />
        <meta name="Registeration" content="Register Form" />
        <meta name="google" content="nositelinkssearchbox" />
        <meta name="google" content="notranslate" />
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>User Data</title>

        <link type="text/css" rel="stylesheet" href="../css/bootstrap.css">
        <link type="text/css" rel="stylesheet" href="../css/callbacks.css">
        <link type="text/css" rel="stylesheet" href="../css/hide-scale-form.css">
        <link type="text/css" rel="stylesheet" href="../css/registerLayout.css">
          <link type="text/css" rel="stylesheet" href="../css/profileData.css">

        <script type="text/jscript" href="../scripts/bootstrap.js"></script>
        <script type="text/jscript" href="../scripts/jquery-3.1.1.js"></script>

    </head>

    <body background="../../backgroundWallpaper.jpg">

        <header>



        </header>

        <main>
            <div class="container body-content span=8 offset=2">
                <div class="well">
                    <legend>Additional User Data</legend>
                    <form class="form-horizontal" action="profileData.php" method="post" autocomplete="off">
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="user_country">Country</label>
                            <div class="col-sm-4">
                                <input pattern="^[A-Za-z\s]{3,22}$" autocomplete="off" class="form-control" id="user_country" placeholder="Country" name="country" required type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="user_city">City</label>
                            <div class="col-sm-4">
                                <input autocomplete="off" class="form-control" pattern="^[A-Za-z\s]{3,16}$" id="user_city" placeholder="City" name="city" required type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="user_genres">Genres</label>
                            <div class="col-sm-4">
                               <!-- Select to be implemented -->
                                <input class="form-control" autocomplete="off" id="user_genres" placeholder="Your Favourite Genres" name="genres" required type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="user_gender">Gender</label>
                            <div class="col-sm-4">
                                <select name="gender" id="user_gender" class="dropdown-select">
                                    <option value="">Select…</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-4">
                                <a class="btn btn-default" href="index.html">Cancel</a>
                                <button type="submit" class="btn btn-primary" name="btn-submit">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </main>

    
     <footer>
              
            </footer>
    
  

    </body>
    
    <script>
    
        
        $('#user_email').bind("cut copy paste",function(e) {
                e.preventDefault();
         });
        
        $('#user_emailConfirm').bind("cut copy paste",function(e) {
                e.preventDefault();
         });
        
        $('#user_password').bind("cut copy paste",function(e) {
                e.preventDefault();
         });
        
        $('#user_password_confirm').bind("cut copy paste",function(e) {
                e.preventDefault();
         });
        
        
    </script>

    </html>
