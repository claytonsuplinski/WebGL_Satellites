//Using touchscreen
if('ontouchstart' in document.documentElement){
$(function() {      
      //Enable swiping...
      $("canvas").swipe( {
        //Generic swipe handler for all directions
        swipe:function(event, phase, direction, distance, duration, fingerCount, pinchZoom, fingerData) {
                var tmpDistance = distance/80;
	    if(fingerCount == 1){
                if(direction == "left"){
                        onSwipeLeft(tmpDistance);
                }
                else if(direction == "right"){
                        onSwipeRight(tmpDistance);
                }
                else if(direction == "up"){
                        onSwipeUp(tmpDistance);
                }
                else if(direction == "down"){
                        onSwipeDown(tmpDistance);
                }
                else{
                //      alert(direction);
                }
	    }
	    else if(fingerCount == 2){
		if(direction == "down"){
			userRadius-=0.01*distance;
		}
		else if(direction == "up"){
			userRadius+=0.01*distance;
		}
		if(userRadius > 40){userRadius = 40;}
		if(userRadius < 0){userRadius = 0;}
	    }
        },
        fingers:$.fn.swipe.fingers.ALL,
        //Default is 75px, set to 0 for demo so any distance triggers swipe
         threshold:0
      });
    });
	//on tap of canvas, minimize all possible frames
}

function onSwipeLeft(distance){
        rY -= distance*axisOrientation* 1.5;
        rY %= 360;
}

function onSwipeRight(distance){
        rY += distance*axisOrientation* 1.5;
        rY %= 360;
}

function onSwipeUp(distance){
        rX -= distance*1.5;
        var tmpAbsMod = Math.abs(rX)%360;
        if(tmpAbsMod < 90 || tmpAbsMod > 270){
          axisOrientation = 1;
        }
        else{
          axisOrientation = -1;
        }
}

function onSwipeDown(distance){
        rX += distance*1.5;
        var tmpAbsMod = Math.abs(rX)%360;
        if(tmpAbsMod < 90 || tmpAbsMod > 270){
          axisOrientation = 1;
        }
        else{
          axisOrientation = -1;
        }
}
