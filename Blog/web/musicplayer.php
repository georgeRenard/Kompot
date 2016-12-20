<?php
    require_once('session.php');
    require_once('DataRetriever.php');
    $session = new session();
    
    
    function renderPlayer($tune){
        
        if(empty($tune)){
            exit;
        }
        
        $isUser = isset($_SESSION['user']);
        
        if(!$isUser){
            $isAdmin = false;
        }else {
            $isAdmin = DataRetriever::isAdmin($_SESSION['user']);
        }
    
        if($isUser){
            $isOwner = DataRetriever::isOwnerOfTune($tune['id'],$_SESSION['user']);
        }else {
            $isOwner = false;
        }
        
        $genres = explode(', ', $tune['genre']);
        
        echo "<div class=\"player-container\" id=\"player-container-".$tune['id']."\">";
            echo "<div class=\"player\">";
                echo "<div class=\"player-control\">";
                    echo "<div class=\"primary-control\">";
                        echo "<a id=\"play-button-" . $tune['id'] . "\" title=\"Play button\" class=\"play-button\"></a>";
                    echo "</div>";

                        echo  "<div class=\"secondary-control\">;

                               <div onclick=\"wavesurfer.pause()\" class=\"stop-button\">

                                </div>

                                <div onclick=\"wavesurfer.stop()\" class=\"pause-button\">

                                </div>

                            </div>
                        </div>
                        <script src=\"https://cdnjs.cloudflare.com/ajax/libs/wavesurfer.js/1.2.3/wavesurfer.min.js\"></script>
                        <div class=\"main-control\">
                            <div class=\"track-info\">" 
                                . $tune['artist'] . " - " . $tune['title'] .
                            "</div>
                            <progress id=\"progress\" class=\"progress\" value=\"100\" max=\"100\"></progress>
                            <div id=\"waveform-" . $tune['id'] . "\" class=\"wavesurfer\">
                            </div>
                        </div>
                    </div>
                    <div class=\"player-bottom\">
                        <div class=\"genre-tags-container\">
                            <ul class=\"genre\">";

                            foreach($genres as $genre){
                             echo "<li><a class=\"genreTag\" href=\"#\">" . $genre . "</a></li>";
                            }
                    echo "</ul>";
                        if($isUser){
                    echo "</div>
                        <div class=\"tune-control\">";
                            if($isOwner || $isAdmin){
                            echo "<a id=\"delete-tune-".$tune['id']."\" class=\"button-delete-tune\"><span></span></a>";
                            }
                            echo "<a id=\"add-to-playlist\" class=\"button-add-to-playlist\"><span id=\"add-to-playlist-span\" class=\"" . $tune['id'] ."\"></span></a>
                            <a id=\"listen\" class=\"button-listen\"><span></span></a>
                        </div>";
                        }
                echo "</div>
                </div>"; 
                
                    
            echo "<script>
                    var wavesurfer" . $tune['id'] . " = WaveSurfer.create({
                        container: " . "'#waveform-" . $tune['id'] . "'" . ",
                        waveColor: '#E8E8E8',
                        height: '100',
                        progressColor: '#40D4A2',
                        backend: 'MediaElement',
                        barWidth: 3,

                    });

                    wavesurfer" . $tune['id'] . ".load(\"" . $tune['path'] . "\");

                    wavesurfer" . $tune['id'] . ".on('loading', function(percents) {
                        document.getElementById('progress').value = percents;
                    });

                    $(\"#play-button-" . $tune['id'] . "\"" . ").on(\"click\", function() {
                    
                        $(\"#play-button-".$tune['id']."\").toggleClass('stop');
                    
                        if(wavesurfer" . $tune['id'] . ".isPlaying()){
                            wavesurfer" . $tune['id'] . ".pause();
                        }else{
                            wavesurfer" . $tune['id'] . ".play();
                        }
                    });";
                    if($isUser){
                        
              echo "$(document).ready(function(){
                    $('." . $tune['id'] . "').click(function(event){
                    
                        event.preventDefault();
                        
                        var id = \"".$tune['id']."\";
                        var decision = confirm(\"Are you sure you want to add/remove this track from your playlist?\");
                        
                        if(decision){
                    
                        $.ajax({
                        
                        type: \"POST\",
                        url: \"add-to-playlist.php\",
                        data: {id: id},
                        success: function(callback) {
                            
                            if(callback != \"Service not available right now! Please, try again later.\"){
                                $('.". $tune['id'] ."').toggleClass('added');
                            }
                        },
                        error: function() {
                        window.alert('Our service is not available at the moment. Please, try a few minutes later');
                        }
            
                        });
                        }
                        });
                    });";
                    
                    if($isAdmin || $isOwner){
                  echo "$(document).ready(function(){
                    
                        $(\"#delete-tune-".$tune['id']."\").click(function(event){
                        
                            event.preventDefault();
                            
                            var decision = confirm(\"Do you really want to delete this track?\");
                            
                            if(decision){
                            
                                var id = \"".$tune['id']."\";
                                
                                $.ajax({
                                
                                    type: \"POST\",
                                    url: \"delete-tune.php\",
                                    data: {id: id},
                                    asynch: true,
                                    cache: false,
                                    
                                    success: function(callback){
                                    
                                        $('#player-container-".$tune['id']."').css('display','none');
                                    
                                    },
                                    
                                    error: function(){
                                        window.alert(\"Service unavailable right now! Please, try again later.\");
                                    }
                                
                                });
                            
                            }
                        
                        });
                    
                    });";
                      
                    }
            }
                echo "</script>";
    }
