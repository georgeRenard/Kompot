
//Song

var song;
var fft;
var duration;
var spectrum;

//Background

var bg;
var blueColor;
var lineColor;

//Flakes

var snowFlakes = 300;
var flakeColor = 255;
var minFlakeSize = 1;
var maxFlakeSize = 5;
var flakeX = [];
var flakeY = [];
var flakeSize = [];
var direction = [];

var slider = {
  
  posX: 60,
  posY: 470,
  
};

//Preloading resources
function preload(){
  song = loadSound("MitiS - Endeavours.mp3");
  bg = loadImage("winter.jpg");
}

function setup(){
  
  createCanvas(662,613);
  song.play();
  duration = song.duration();
  map(slider.posX,60,580,0,duration);
  
  //Generating random flakes
  for(var i = 0 ; i < snowFlakes; i++){
    
    flakeX[i] = random(0,width);
    flakeY[i] = random(0,height);
    direction[i] = round(random(0,1));
    flakeSize[i] = round(random(minFlakeSize,maxFlakeSize));
    
  }
  
  fft = new p5.FFT(0.8,256);
  noCursor();
  
}

function draw(){
    //Load background  
    image(bg,0,0);
    
    //FFT analyze 256 BANDS
    spectrum = fft.analyze();
    
    //Spectrum Analysis
    analyzeSong(spectrum);
    
    //Colors
    blueColor =  color(81,97,127);
    lineColor = color(204,208,216);
    
    //Line
    strokeWeight(2);
    stroke(lineColor);
    line(60,470,580,470);
    
    //Slider
    noStroke();
    fill(blueColor);
    slider.posX = song.currentTime() + 60;
    ellipse(slider.posX,slider.posY,20);
    
    //Sound Duration Display
    textSize(16);
    fill(255);
    text(round(song.currentTime()),40,480);
    text(round(round(duration)/60),600,480);
    
    //Snow invoke
    invokeSnow();
}

function toggleSong(){
  if(song.isPlayed()){
    song.stop();
  }else {
    song.play();
  }
}

function invokeSnow(){
  
  for(var i = 0 ;i < snowFlakes; i++){
    //Drawing Flakes
    ellipse(flakeX[i],flakeY[i],flakeSize[i],flakeSize[i]);
    
    if(direction[i] == 0){
      flakeX[i] += map(flakeSize[i],minFlakeSize,maxFlakeSize, .1, .5);
    }else {
      flakeX[i] -= map(flakeSize[i],minFlakeSize,maxFlakeSize, .1, .5);
    }
    
    flakeY[i] += flakeSize[i] + direction[i];
    
      if(flakeX[i] > width + flakeSize[i] || flakeX[i] < -flakeSize[i] || flakeY[i] > height + flakeSize[i]) {
      
      flakeY[i] = random(0,width);
      flakeY[i] = -flakeSize[i];
      
      }
    }
    
    
    
  }
  
  
  function analyzeSong(spectrum) {
    noFill();
    stroke(50);
    ellipse(300,300,100,100);
    for(var i = 0 ; i<spectrum.length ; i++){
      
      var amplitude = spectrum[i];
      var y = map(amplitude,0,100,height,0);
      stroke(250);
      
      
    }
    
  }
  
  
  

