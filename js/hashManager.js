var startingTourInterval = 0;
var startingTourTransition = 0;

$(document).ready(function(){
        var canvas = document.getElementById('glcanvas');
        canvas.width=$(window).width();
        canvas.height = $(window).height();

        var hashString = location.hash.substring(1);
        var hashArray = hashString.split(";");
        for(var i=0; i<hashArray.length; i++){
                hashArray[i] = hashArray[i].split(":");
        }
        
        for(var i=0; i<hashArray.length; i++){
                if(hashArray[i].length > 1){
                        var tmpReturnVariable;
                        if(hashArray[i][1] == "true"){
                                tmpReturnVariable = true;
                        }
                        else if(hashArray[i][1] == "false"){
                                tmpReturnVariable = false;
                        }
                        else{
                                tmpReturnVariable = Number(hashArray[i][1]);
                        }

                        if(hashArray[i][0] == "followSatellite"){
                                followSatellite = tmpReturnVariable;
                        }
                        else if(hashArray[i][0] == "autoReload"){
                                autoReload = tmpReturnVariable;
                                if(autoReload){
                                        refreshAt(50);
                                        $('#autoReloadButton').css({color:'#662255'});
                                }
                        }
                        else if(hashArray[i][0] == "lowRes"){
                                selectLowResTexture = tmpReturnVariable;
                        }
                        else if(hashArray[i][0] == "playInReverse"){ //still need to set-up
                                playInReverse = tmpReturnVariable;
                        }
                        else if(hashArray[i][0] == "tour"){
                                tourMode = tmpReturnVariable;
                        }
                        else if(hashArray[i][0] == "realtime"){
                                playInRealtime = tmpReturnVariable;
                                if(!playInRealtime){
                                        $("#realtimeButton").css({color:'white'});      
                                }
                        }
                        else if(hashArray[i][0] == "bottomline"){
                                displayBottomline = tmpReturnVariable;
                                if(displayBottomline){
                                        $("#bottomlineButton").css({color:'#662255'});
                                }
                        }
                        else if(hashArray[i][0] == "drawNames"){
                                drawNames = tmpReturnVariable;
                                if(drawNames){$('#namesButton').css({color:'#662255'});}
                        }
                        else if(hashArray[i][0] == "satelliteViewType"){
                                if(tmpReturnVariable < 5 && tmpReturnVariable > -1){
                                        satelliteViewType = tmpReturnVariable;
                                }
                        }
                        else if(hashArray[i][0] == "day"){
                                if(tmpReturnVariable < 32 && tmpReturnVariable > -1){
                                        day=tmpReturnVariable;  
                                }
                        }
                        else if(hashArray[i][0] == "month"){
                                if(tmpReturnVariable < 13 && tmpReturnVariable > 0){
                                        month=tmpReturnVariable;  
                                }
                        }
                        else if(hashArray[i][0] == "year"){
                                if(tmpReturnVariable > 1900){
                                        year=tmpReturnVariable;
                                }
                        }
                        else if(hashArray[i][0] == "tourInterval"){
                                if(tmpReturnVariable <= 200 && tmpReturnVariable >= -200){
                                        startingTourInterval = tmpReturnVariable;
                                }
                        }
                        else if(hashArray[i][0] == "tourTransition"){
                                if(tmpReturnVariable <= 200 && tmpReturnVariable >= -200){
                                        startingTourTransition = tmpReturnVariable;
                                }
                        }
                }
        }
//      alert(hashArray[0][0]);
//      location.hash = "here"; 
});

