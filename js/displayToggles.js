function toggleGroundStation(index){
var tmpButtonBackground = document.getElementsByClassName("groundStationsButtons")[index];
isDrawingGroundStation[index] = !isDrawingGroundStation[index];
if(isDrawingGroundStation[index]){
tmpButtonBackground.style.color="#662255";
}
else{
tmpButtonBackground.style.color="#222222";
}
loadEditGroundStation(index);
currEditGroundStationLastIndex = false;
}


function onOffAll(selectedButton){
var turnSatellitesOff=(selectedButton.innerHTML=='ON');
if(turnSatellitesOff){
for(var i=0; i<satellitePositions.length; i++){
        if(isDrawingSatellite[i]){
                turnSatelliteOnOff(i);
        }
}
selectedButton.innerHTML='OFF';
selectedButton.style.backgroundColor="#222222";
}
else{
for(var i=0; i<satellitePositions.length; i++){
        if(!isDrawingSatellite[i]){
                turnSatelliteOnOff(i);
        }
}
selectedButton.innerHTML='ON';
selectedButton.style.backgroundColor="#224422";
}
}

var turnPathsOff = true;
function pathAll(selectedButton){
turnPathsOff = !turnPathsOff;
if(turnPathsOff){
for(var i=0; i<satellitePositions.length; i++){
        if(isDrawingPath[i]){
                turnPathOnOff(i);
        }
}
selectedButton.style.backgroundColor="#222222";
}
else{
for(var i=0; i<satellitePositions.length; i++){
        if(!isDrawingPath[i]){
                turnPathOnOff(i);
        }
}
selectedButton.style.backgroundColor="#224422";
}

}

var turnSwathsOff = true;
function swathAll(selectedButton){
turnSwathsOff = !turnSwathsOff;
if(turnSwathsOff){
for(var i=0; i<satellitePositions.length; i++){
        if(isDrawingSatelliteVision[i]){
                turnSwathOnOff(i);
        }
}
selectedButton.style.backgroundColor="#222222";
}
else{
for(var i=0; i<satellitePositions.length; i++){
        if(!isDrawingSatelliteVision[i]){
                turnSwathOnOff(i);
        }
}
selectedButton.style.backgroundColor="#224422";
}

}


$(document).mouseup(function (e)
{
    var container = $("#settingsBox");
    var trigger = $("#settings");
    if (!container.is(e.target) && container.has(e.target).length === 0 && !trigger.is(e.target) && trigger.has(e.target).length === 0){
        container.hide('clip');
    }

    container = $("#satellitesList");
    trigger = $("#satellites");
    if (!container.is(e.target) && container.has(e.target).length === 0 && !trigger.is(e.target) && trigger.has(e.target).length === 0){
        container.hide('clip');
    }

    container = $("#playbackBox");
    trigger = $("#playback");
    if (!container.is(e.target) && container.has(e.target).length === 0 && !trigger.is(e.target) && trigger.has(e.target).length === 0){
        container.hide('clip');
    }

    container = $("#selectDateBox");
    trigger = $("#selectDate");
    if (!container.is(e.target) && container.has(e.target).length === 0 && !trigger.is(e.target) && trigger.has(e.target).length === 0){
        container.hide('clip');
    }

    container = $("#helpBox");
    trigger = $("#help");
    if (!container.is(e.target) && container.has(e.target).length === 0 && !trigger.is(e.target) && trigger.has(e.target).length === 0){
        container.hide('clip');
    }

    container = $("#generalBox");
    trigger = $("#general");
    if (!container.is(e.target) && container.has(e.target).length === 0 && !trigger.is(e.target) && trigger.has(e.target).length === 0){
        container.hide('clip');
    }

    container = $("#timeSelectBox");
    trigger = $("#info");
    if (!container.is(e.target) && container.has(e.target).length === 0 && !trigger.is(e.target) && trigger.has(e.target).length === 0){
        container.hide('clip');
    }

    container = $("#followingInfoLeft");
    var container2 = $("#followingInfoRight");
    trigger = $("#following");
    if (!trigger.is(e.target) && trigger.has(e.target).length === 0 && !container.is(e.target) && container.has(e.target).length === 0 && !container2.is(e.target) && container2.has(e.target).length === 0){
        $("#followingInfoLeft").hide('slide', {direction: 'left'}, 'slow');$("#followingInfoRight").hide('slide', {direction: 'right'}, 'slow');
    }

    container = $("#largeWorldMapDisplay");
    trigger = $("#worldMap");
    if (!trigger.is(e.target) && trigger.has(e.target).length === 0){
        container.hide('fade');
    }

});


function followSatelliteToggle(index){
if(followSatellite && satelliteToFollow==index){
        stopFollowingSatellites();
}
else{
        startFollowingSatellite(index);
}
updateHashLink('followSatellite', followSatellite);
}

function turnSatelliteOnOff(index){
var tmpSatelliteOnOffButton = document.getElementById("onOff"+index);
var tmpSatelliteState = tmpSatelliteOnOffButton.innerHTML; 
if(tmpSatelliteState == "ON"){
tmpSatelliteOnOffButton.style.backgroundColor="#222222";
tmpSatelliteOnOffButton.innerHTML="OFF";
isDrawingSatellite[index] = false;
}
else{
tmpSatelliteOnOffButton.style.backgroundColor="#224422";
tmpSatelliteOnOffButton.innerHTML="ON";
isDrawingSatellite[index] = true;
}
}

function turnPathOnOff(index){
var tmpSatellitePathButton = document.getElementById("path"+index);
var tmpSatelliteState = tmpSatellitePathButton.innerHTML; 
if(isDrawingPath[index]){
tmpSatellitePathButton.style.backgroundColor="#222222";
isDrawingPath[index] = false;
}
else{
tmpSatellitePathButton.style.backgroundColor="#224422";
isDrawingPath[index] = true;
}
}

function turnSwathOnOff(index){
if(satellitePositions[index].orbitRadius <= 2){
var tmpSatellitePathButton = document.getElementById("swath"+index);
var tmpSatelliteState = tmpSatellitePathButton.innerHTML; 
if(isDrawingSatelliteVision[index]){
tmpSatellitePathButton.style.backgroundColor="#222222";
isDrawingSatelliteVision[index] = false;
}
else{
tmpSatellitePathButton.style.backgroundColor="#224422";
isDrawingSatelliteVision[index] = true;
}
}
}

function drawNamesToggle(){
        drawNames = !drawNames;
        if(drawNames){$('#namesButton').css({color:'#663322'});}else{$('#namesButton').css({color:'#333333'});}
        updateHashLink("drawNames", drawNames);
}

function cinematicModeToggle(){
                cinematicMode = !cinematicMode;

                if(cinematicMode){startFollowingSatellite(satelliteToFollow);}

                satelliteViewType =1;
                tourMode = false;
                
                updateHashLink("tour", tourMode);

                if(cinematicMode){
                        $("#tourOrCinematicDisplay").html("Cinematic");
                        $("#tourOrCinematicDisplay").show(0, function(){$("#tourOrCinematicDisplay").hide('fade', 1000);});

                        $("#cinematicButton").css({color:'#662233'});
                        endTourMode(false);
                        endSatelliteFreeMode();
                }
                else{
                        endCinematicMode(true);
                }
}

function endCinematicMode(postAlert){
cinematicMode = false;

if(postAlert){
$("#tourOrCinematicDisplay").html("End Cinematic");
$("#tourOrCinematicDisplay").show(0, function(){$("#tourOrCinematicDisplay").hide('fade', 1000);});
}

$("#cinematicButton").css({color:'#222222'});
}

function tourModeToggle(){
        tourCounter = 0;
                tourMode = !tourMode;

                if(tourMode){startFollowingSatellite(satelliteToFollow);}               

                satelliteViewType = 2;
                cinematicMode = false;


                if(tourMode){
                        updateHashLink("tour", tourMode);
                        $("#tourOrCinematicDisplay").html("Tour");
                        $("#tourOrCinematicDisplay").show(0, function(){$("#tourOrCinematicDisplay").hide('fade', 1000);});
                        
                        $("#tourButton").css({color:'#662233'});
                        endCinematicMode(false);
                        endSatelliteFreeMode();
                }
                else{
                        endTourMode(true);
                }
}

function endTourMode(postAlert){
tourMode = false;

if(postAlert){
$("#tourOrCinematicDisplay").html("End Tour");
$("#tourOrCinematicDisplay").show(0, function(){$("#tourOrCinematicDisplay").hide('fade', 1000);});
}

updateHashLink("tour", tourMode);
$("#tourButton").css({color:'#222222'});
}

function satelliteFreeModeToggle(){
                satelliteFreeMode = !satelliteFreeMode;

                if(satelliteFreeMode){startFollowingSatellite(satelliteToFollow);}

                if(satelliteFreeMode){
                        $("#satelliteFreeButton").css({color:'#662233'});
                        endCinematicMode(false);
                        endTourMode(false);
                }
                else{
                        endSatelliteFreeMode();
                }
}

function endSatelliteFreeMode(){
satelliteFreeMode = false;

$("#satelliteFreeButton").css({color:'#222222'});
}

