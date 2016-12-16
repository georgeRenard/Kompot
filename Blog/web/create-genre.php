<?php
    require_once("session.php");
    require_once("DataRetriever.php");
    require_once("Genre.php");
    require_once("UpdateImage.php");

    $session = new session();
    $session::isUser();

    if(!DataRetriever::isAdmin($_SESSION['user'])){
        header("Location: ../../index.php");
        exit;
    }

    #ACTION to perform
    $action = 'Create';
    $imageDir = "../bubble_avatar/" . "user_" . $_SESSION['user'];
    
    if(isset($_SESSION['genre'])){
        
        $action = $_SESSION['genre']['action'];
        $wallpaper = DataRetriever::getGenreThumbnail($_SESSION['genre']['name']);
        
    }

    
    if(isset($_POST['genre-create'])) {   
        
        if(isset($_FILES)){
            #Resizing image if possible
            $result = imageResizeToThumbnail();
        }
        
        #Send to server
        if($result['isValid']){
            $wallpaper = $result['filepath'];
            #New Genre
            $genre = new Genre($_POST['name'],$wallpaper,$action);
            
            #It decides for itself wether it should perform EDIT/DELETE/CREATE action
            $manageResult = $genre->manage($action);
            if(!$manageResult){
                header("Location: home.php");
                session_destroy($_SESSION['genre']);
                exit;
            }else {
                if($action == 'Create'){
                    unlink($wallpaper);
                }
            }
        }
        
    }

    

?>


    <html>

    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="" content="#" />
        <meta name="google" content="nositelinkssearchbox" />
        <meta name="google" content="notranslate" />
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Coming Soon</title>

        <link type="text/css" rel="stylesheet" href="../css/bootstrap.css">
        <link type="text/css" rel="stylesheet" href="../css/create-genreLayout.css">

        <script src="../scripts/jquery-3.1.1.min.js"></script>
        <script src="../scripts/bootstrap.js"></script>

    </head>

    <body>

        <header>
            <div class="header">
                <div class="downpointer">

                </div>
                <div class="user-bubble">
                    <img width="64" height="64" src="<?=$imageDir?>">
                </div>
            </div>
        </header>

        <main>
            <div class="form-container">
                <form enctype="multipart/form-data" method="post" action="create-genre.php">
                    <div class="group">
                        <label class="form-label" for="genre-name">Name</label>
                        <input required type="text" placeholder="Name" id="genre-name" name="name" pattern="^([a-zA-Z\s]+){3,20}$">
                    </div>
    
                    <?php
                        if(!($action == 'delete')){
                        echo "<div class=\"group\">";
                            echo "<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"1048576\" />";
                            echo "<input type=\"file\" name=\"thumbnail\">";
                        echo "</div>";
                        }
                    ?>
                        <div class="group">
                            <button class="btn btn-default" name="cancel" type="reset">Cancel</button>
                            <button class="btn btn-primary" name="genre-create" type="submit">
                                <?php if(!isset($_SESSION['genre'])){ echo 'Create'; } else { echo $_SESSION['genre'];}?>
                            </button>
                        </div>
                </form>
            </div>
        </main>

        <footer>

        </footer>

    </body>

    </html>
