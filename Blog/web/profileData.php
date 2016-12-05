<?php
    require_once('session.php');
    
    $session = new session();





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

        <title>Register Test</title>

        <link type="text/css" rel="stylesheet" href="../css/bootstrap.css">
        <link type="text/css" rel="stylesheet" href="../css/callbacks.css">
        <link type="text/css" rel="stylesheet" href="../css/hide-scale-form.css">
        <link type="text/css" rel="stylesheet" href="../css/registerLayout.css">

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
                    <form class="form-horizontal" action="register.php" method="post" autocomplete="off">
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="user_name">Country</label>
                            <div class="col-sm-4">
                                <input class="form-control" id="user_name" placeholder="Country" name="name" required type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="user_email">City</label>
                            <div class="col-sm-4">
                                <input class="form-control" pattern="^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$" id="user_email" placeholder="City" name="email" required type="email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="user_emailConfirm">Genres</label>
                            <div class="col-sm-4">
                                <input class="form-control" pattern="^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$" id="user_emailConfirm" placeholder="Your Favourite Genres" name="confirmEmail" required type="email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="user_emailConfirm">Gender</label>
                            <div class="col-sm-4">
                                <select class="dropdown-select">
                                    <option value="">Select…</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-4">
                                <a class="btn btn-default" href="index.html">Cancel</a>
                                <button type="submit" class="btn btn-primary" name="btn-submit">Submit</button>
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
