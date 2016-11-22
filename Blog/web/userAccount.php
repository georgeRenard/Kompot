<?php
    require_once('session.php');
    require_once('DataRetriever.php');
    $session = new session();

    $userId = $_SESSION['user'];

    $user = DataRetriever::getUserData($userId);

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
        <link type="text/css" rel="stylesheet" href="../css/callbacks.css">
        <link type="text/css" rel="stylesheet" href="../css/page.css">
        <link type="text/css" rel="stylesheet" href="../css/navbar.css">

        <script type="text/jscript" href="../scripts/bootstrap.js"></script>
        <script type="text/jscript" href="../scripts/jquery-3.1.1.js"></script>

    </head>

    <body>

        <header>



        </header>

        <main>
           <div class="wraper">
            <nav id="sidebar" class="navbar navbar-inverse sidebar navigation" role="navigation">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <legend><?=$user['name']?></legend>
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
                    <div id="sidebar.btn" class="navbar-btn">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    
                    <!-- Click Event: SideBar Toggle:Visible/Hidden -->
                    <script>
                        
                        $(document).ready(function(){
                            
                            $('#sidebar.btn').click(function(){
                                $('#sidebar').toggleClass('visible'); 
                            })
                                              
                        })
                        
                    </script>
                </div>
            </nav>
            </div>
            
            <div class="profileWraper">
                
                <div>
                    
                    <fieldset>
                        
                        
                        
                    </fieldset>
                    
                </div>
                
            </div>

        </main>

        <footer>



        </footer>

    </body>


    </html>
