var dispReverse=false;
function reverseButton(){
        playInRealtime = false;
        $("#realtimeButton").css({color:'white'});
        updateHashLink('realtime', playInRealtime);

        if(!dispReverse){
        document.getElementById("reverseButton").style.transform="scaleY(1)";
        dispReverse=true;
        }
        else{
        document.getElementById("reverseButton").style.transform="scaleY(-1)";
        dispReverse=false;
        }
}

var setToPlayButton = true;
function playPauseButton(){
        if(setToPlayButton){
                moveSatellite = true;
                document.getElementById("playButton").style.backgroundImage = "url('./icons/pauseButton.png')";
                setToPlayButton = false;

        }
        else{
                document.getElementById("playButton").style.backgroundImage = "url('./icons/playButton.png')";
                moveSatellite = false;
                setToPlayButton = true;
                $("#loopingAlert").hide();              

                playInRealtime = false;
                $("#realtimeButton").css({color:'white'});
                updateHashLink('realtime', playInRealtime);
        }
}

function stopButton(){
        moveSatellite = false;
        movingSatelliteIndex = 0;
        movingSatelliteCounter = 0;
        satellitePositions = startingSatellitePositions;
        document.getElementById("playButton").style.backgroundImage = "url('./icons/playButton.png')";
        setToPlayButton = true;
        $("#loopingAlert").hide();

        cinematicMode = false;

        playInRealtime = false;
        $("#realtimeButton").css({color:'white'});
        updateHashLink('realtime', playInRealtime);
}

function realtimeButton(){
playInRealtime = !playInRealtime;
if(playInRealtime){
$("#realtimeButton").css({color:'orange'});
}
else{
$("#realtimeButton").css({color:'white'});
}

if(setToPlayButton){
playPauseButton();
}
}
realtimeButton();

        document.getElementById("currDate").innerHTML=monthNames[month-1]+" "+day+", "+year;


var autoReloadEventCall;
function refreshAt(minutes) {
    var now = new Date();
    var then = new Date();

    if(now.getMinutes() >= minutes){
        then.setHours(now.getHours() + 1);
    }

    then.setMinutes(minutes);

    var timeout = (then.getTime() - now.getTime());
    autoReloadEventCall = setTimeout(function() { window.location.reload(true); }, timeout);
}

$( "#sliderRotate" ).slider({
min: -200,
max: 200
});
$("#sliderRotate > a").removeAttr("href");
$( "#sliderZoom" ).slider({
min: -200,
max: 200
});
$("#sliderZoom > a").removeAttr("href");
$( "#sliderTourInterval" ).slider({
min: -200,
max: 200,
value: startingTourInterval
});
$("#sliderTourInterval > a").removeAttr("href");
$( "#sliderTourTransition" ).slider({
min: -200,
max: 200,
value: startingTourTransition
});
$("#sliderTourTransition > a").removeAttr("href");
$( "#sliderSatellite" ).slider({
min: -200,
max: 200
});
$("#sliderSatellite > a").removeAttr("href");
$( "#setHourSlider" ).slider({
orientation: "vertical",
min: 0,
max: 23,
value: 12,
slide: function( event, ui ) {
$( "#setHourDisplay" ).html( ui.value );
}
});
$("#setHourSlider > a").removeAttr("href");
$( "#setMinuteSlider" ).slider({
orientation: "vertical",
min: 0,
max: 59,
value: 45,
slide: function( event, ui ) {
$( "#setMinuteDisplay" ).html( ui.value );
}
});
$("#setMinuteSlider > a").removeAttr("href");
$( "#setSecondSlider" ).slider({
orientation: "vertical",
min: 0,
max: 59,
value: 55,
slide: function( event, ui ) {
$( "#setSecondDisplay" ).html( ui.value );
}
});
$("#setSecondSlider > a").removeAttr("href");

