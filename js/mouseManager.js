 function onDocumentMouseDown( event ) {
        event.preventDefault();

        document.addEventListener( 'mouseup', onDocumentMouseUp, false );
        document.addEventListener( 'mouseout', onDocumentMouseOut, false );


 }

 function onDocumentMouseUp( event ) {
          document.removeEventListener( 'mouseup', onDocumentMouseUp, false );
          document.removeEventListener( 'mouseout', onDocumentMouseOut, false );
  }

 function onDocumentMouseOut( event ) {
          document.removeEventListener( 'mouseup', onDocumentMouseUp, false );
          document.removeEventListener( 'mouseout', onDocumentMouseOut, false );
 }

document.addEventListener('mousemove', function(event) {

/*
$('*').css('cursor','auto');
mouseIdleCounter = 0;
*/

if(!followSatellite && !mouseDownHeader && !rocketMode){
if(mouseDown){
        var rotateFactor = $('#sliderRotate').slider("option", "value");
        rotateFactor = rotateFactor/100;
        rotateFactor = Math.pow(10, rotateFactor);
        rY += axisOrientation*(event.clientX - prevMouseX) * rotateFactor/20;
        rY %= 360;
        rX += (event.clientY - prevMouseY) * rotateFactor/20;
        var tmpAbsMod = Math.abs(rX)%360;
        if(tmpAbsMod < 90 || tmpAbsMod > 270){
          axisOrientation = 1;
        }
        else{
          axisOrientation = -1;
        }
}

else if(rightMouseDown){
var zoomFactor = $('#sliderZoom').slider("option", "value");
zoomFactor = zoomFactor/100;
zoomFactor = Math.pow(10, zoomFactor);
userRadius += zoomFactor * (0.5) * (20 * (2 * (event.clientY - prevMouseY) - window.innerHeight) / window.innerHeight + 20);
if(userRadius > 40){userRadius = 40;}
if(userRadius < 0){userRadius = 0;}
}
prevMouseX = event.clientX;
prevMouseY = event.clientY;
}
else if(satelliteFreeMode && !mouseDownHeader){
if(mouseDown){
var rotateFactor = $('#sliderRotate').slider("option", "value");
rotateFactor = rotateFactor/100; 
rotateFactor = Math.pow(10, rotateFactor);
satelliteFreeModeRY += axisOrientation*(event.clientX - prevMouseX) * rotateFactor/20;
satelliteFreeModeRY %= 360;
satelliteFreeModeRX += (event.clientY - prevMouseY) * rotateFactor/20;
var tmpAbsMod = Math.abs(satelliteFreeModeRX)%360;
if(tmpAbsMod < 90 || tmpAbsMod > 270){
  axisOrientation = 1;
}
else{
  axisOrientation = -1;
}
}
prevMouseX = event.clientX;
prevMouseY = event.clientY;
}
else if(rocketMode && !mouseDownHeader){
prevMouseX = event.clientX;
prevMouseY = event.clientY;
}


});

document.addEventListener('mousedown', function(event) {
if(event.which == 1){ //Left-click
        mouseDown = true;
}
if(event.which == 3){ //Right-click
        rightMouseDown = true;
}
});

document.addEventListener('mouseup', function(event) {
mouseDownHeader = false;
if(event.which == 1){ //Left-click
        mouseDown = false;
}
if(event.which == 3){ //Right-click
        rightMouseDown = false;
}
});

function MouseWheelHandler(e){
        var e = window.event || e; // old IE support
        var delta = -Math.max(-1, Math.min(1, (e.wheelDelta || -e.detail)));
        var zoomFactor = $('#sliderZoom').slider("option", "value");
        zoomFactor = zoomFactor/100;
        zoomFactor = Math.pow(10, zoomFactor);
        userRadius += zoomFactor * delta /4;
        if(userRadius > 40){userRadius = 40;}
        if(userRadius < 0){userRadius = 0;}
}

