var wPressed = false;var aPressed = false;
document.addEventListener('keydown', function(event) {
  if(document.activeElement.id != "customGroundStationName"){
    if(event.keyCode == 67) { //C
        cinematicModeToggle();
    }
    else if(event.keyCode == 69){ //E
	fireBullet();
    }
    else if(event.keyCode == 84){ //T
        tourModeToggle();
    }
    else if(event.keyCode == 87){ //W
        if(rocketMode){
        wPressed = true;
        }
    }
    else if(event.keyCode == 75) { //K
        shouldDrawGroundStations = !shouldDrawGroundStations;
    }
    else if(event.keyCode == 76) { //L
        displaySatellitePaths = !displaySatellitePaths;
    }
    else if(event.keyCode == 40){ //Down arrow 
        playInRealtime = false;$('#realtimeButton').css({color:'white'});
        updateHashLink('realtime', playInRealtime);
        var tmpSliderVal = $('#sliderSatellite').slider("option", "value");     
        tmpSliderVal--;
        if(tmpSliderVal < $('#sliderSatellite').slider("option", "min")){
                tmpSliderVal = $('#sliderSatellite').slider("option", "min");
        }
        $( "#sliderSatellite" ).slider( "value", tmpSliderVal );
    }
    else if(event.keyCode == 38){ //Up Arrow  
        playInRealtime = false;$('#realtimeButton').css({color:'white'});
        updateHashLink('realtime', playInRealtime);
       var tmpSliderVal = $('#sliderSatellite').slider("option", "value");     
        tmpSliderVal++;
        if(tmpSliderVal > $('#sliderSatellite').slider("option", "max")){
                tmpSliderVal = $('#sliderSatellite').slider("option", "max");
        }
        $( "#sliderSatellite" ).slider( "value", tmpSliderVal );
    }
    else if(event.keyCode == 37){ //Left arrow
        if(!playInReverse){reverseButton();}
        playInReverse = true;
    }
    else if(event.keyCode == 39){ //Right arrow
        if(playInReverse){reverseButton();}
        playInReverse = false;
    }
    else if(event.keyCode == 80){ //P   38){ //Up arrow
       playPauseButton();
    }
    else if(event.keyCode == 40){ //Down arrow
    }
    else if(event.keyCode == 81) { //Q
/*      moveSatellite = !moveSatellite;
        movingSatelliteIndex = 0;
        movingSatelliteCounter = 0;
        satellitePositions = startingSatellitePositions;
*/
    //    alert(rocket.x + ", " + rocket.y + ", " + rocket.z);
    }
    else if(event.keyCode== 65) { //A
        if(rocketMode){
        aPressed = true;
        }
    }
    else if(event.keyCode == 83) { //S
        drawNamesToggle();
    }
    else if(event.keyCode == 68) { //D
        if(followSatellite){
                satelliteViewType++;satelliteViewType%=4;
                updateHashLink("satelliteViewType", satelliteViewType);
        }
    }
    else if(event.keyCode == 70) { //F
        if(satellitePositions.length > 0){
                followSatellite = !followSatellite;
                //satelliteToFollow = 0;
                if(followSatellite){
                        startFollowingSatellite(satelliteToFollow);
                }
                else{
                        stopFollowingSatellites();
                }

        }
    }
    else if(event.keyCode == 78) { //N
      if(followSatellite){
        satelliteToFollow++;
        satelliteToFollow = satelliteToFollow % satellitePositions.length;

        for(var i=0; i<satellitePositions.length; i++){
                $("#satelliteFollowToggle"+i+"").css({color:'white'});
        }
        $("#satelliteFollowToggle"+satelliteToFollow+"").css({color:'skyblue'});

        if(followSatellite){
                document.getElementById("satelliteBeingFollowed").innerHTML=satellitePositions[satelliteToFollow].name;
                document.getElementById("satelliteBeingFollowedFlag").style.backgroundImage="url("+satelliteFlags[satelliteToFollow%satelliteFlags.length]+")";
        }
        else{
                document.getElementById("following").style.display="none";
        }

        $("#followingInfoLeft").hide('slide', {direction: 'left'}, 'slow');$("#followingInfoRight").hide('slide', {direction: 'right'}, 'slow');
      }
    }
    else if(event.keyCode == 66) { //B
        satelliteToFollow--;
        if(satelliteToFollow < 0){
                satelliteToFollow = satellitePositions.length - 1;
        }

        for(var i=0; i<satellitePositions.length; i++){
                $("#satelliteFollowToggle"+i+"").css({color:'white'});
        }
        $("#satelliteFollowToggle"+satelliteToFollow+"").css({color:'skyblue'});

        if(followSatellite){
                document.getElementById("satelliteBeingFollowed").innerHTML=satellitePositions[satelliteToFollow].name;
                document.getElementById("satelliteBeingFollowedFlag").style.backgroundImage="url("+satelliteFlags[satelliteToFollow%satelliteFlags.length]+")";
        }
        else{
                document.getElementById("following").style.display="none";
        }

        $("#followingInfoLeft").hide('slide', {direction: 'left'}, 'slow');$("#followingInfoRight").hide('slide', {direction: 'right'}, 'slow');
    }
  }
});

document.addEventListener('keyup', function(event) {
  if(document.activeElement.id != "customGroundStationName"){
   if(event.keyCode == 87){ //W
        wPressed = false;
    }
    else if(event.keyCode== 65) { //A
        aPressed = false;
    }
  }
});

function keyResponse(){
        if(wPressed){
                if(rocket.velocity < 0.003){
                        rocket.velocity+=0.00025;       
                }
                secondsOfBurningFuel += 0.06;
                dollarsOfUsedFuel += 40;
        }
        if(aPressed){
                if(rocket.velocity > 0){
                        rocket.velocity-=0.00025;
                        if(rocket.velocity < 0){rocket.velocity = 0;}       
                        
                        secondsOfBurningFuel += 0.06;
                        dollarsOfUsedFuel += 40;
                }
        }
}

