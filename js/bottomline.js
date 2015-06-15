var startOfBottomline = 0;
var bottomlineInfoCounter = 0;

var bottomlineInfoTabs = new Array();

var bottomlineTabNames = new Array();

$.get("./dataDir/satinfo/",function(data,status){
                        bottomlineTabNames = new Array();
                        var tmpBottomlineArray = strip(data).split("Parent Directory")[1].split('\n');
                        for(var i=0; i<tmpBottomlineArray.length; i++){
                                if(tmpBottomlineArray[i].indexOf("/") > -1 && tmpBottomlineArray[i].indexOf("Apache") < 0){
                                        var bottomlineTabName = tmpBottomlineArray[i].split('/')[0];
                                        if(UrlExists("./dataDir/satinfo/"+bottomlineTabName+"/bottomline.txt")){
                                                bottomlineTabNames.push(bottomlineTabName);
                                        }
                                }
                        }

                        bottomlineInfoTabs = new Array();
                        for(var i=0; i<bottomlineTabNames.length; i++){
                                (function(tmpI){
                                $.get("./dataDir/satinfo/"+bottomlineTabNames[tmpI]+"/bottomline.txt",function(data,status){
                                var output = data.split('\n');
                                var tmpBottomlineTab = new Array();             

                                for(var i=0; i<output.length; i++){
                                        if(output[tmpI].length > 1){
                                                tmpBottomlineTab.push(output[tmpI]);
                                        }
                                }
                                bottomlineInfoTabs.push(tmpBottomlineTab);
                                });
                                })(i);
                        }

                });

function bottomlineUpdate(){
if(displayBottomline){
var innerBottomline = "<table style=\"width:100%;height:100%;background-image:url('./bottomlineBackground.png');background-size:100% 100%;\"><tr>";
if(bottomlineInfoCounter == 0){

        if(startOfBottomline == 0){
                $.get("./dataDir/satinfo/",function(data,status){
                        bottomlineTabNames = new Array();
                        var tmpBottomlineArray = strip(data).split("Parent Directory")[1].split('\n');
                        for(var i=0; i<tmpBottomlineArray.length; i++){
                                if(tmpBottomlineArray[i].indexOf("/") > -1 && tmpBottomlineArray[i].indexOf("Apache") < 0){
                                        var bottomlineTabName = tmpBottomlineArray[i].split('/')[0];
                                        if(UrlExists("./dataDir/satinfo/"+bottomlineTabName+"/bottomline.txt")){
                                        bottomlineTabNames.push(bottomlineTabName);
                                        }
                                }
                        }

                        bottomlineInfoTabs = new Array();
                        for(var i=0; i<bottomlineTabNames.length; i++){
                                $.get("./dataDir/satinfo/"+bottomlineTabNames[i]+"/bottomline.txt",function(data,status){
                                var output = data.split('\n');
                                var tmpBottomlineTab = new Array();             
                        
                                for(var i=0; i<output.length; i++){
                                        if(output[i].length > 1){
                                                tmpBottomlineTab.push(output[i]);
                                        }
                                }
                                bottomlineInfoTabs.push(tmpBottomlineTab);
                                });
                        }

                });
        }

innerBottomline+="<th style=\"height:100%;font-size:1vw;vertical-align:top;width:10%;opacity:0.35;background:#23415a;color:white;\">"+bottomlineTabNames[startOfBottomline%bottomlineTabNames.length]+"</th>";
for(var i=startOfBottomline+1; i<9+startOfBottomline; i++){
        innerBottomline+="<th style=\"height:100%;font-size:1vw;vertical-align:top;width:10%;opacity:0.35;background:#222222;color:skyblue;\">"+bottomlineTabNames[i%bottomlineTabNames.length]+"</th>";  
}
innerBottomline+="<th style=\"height:100%;font-size:1vw;vertical-align:top;width:10%;opacity:0.35;background:#222222;color:skyblue;\">"+bottomlineTabNames[(9+startOfBottomline)%bottomlineTabNames.length]+"</th>";
}
else{

innerBottomline+="<th style=\"vertical-align:top;width:0.5%;background:transparent;padding:0px;font-size:1vw;\"><table style=\"width:100%;height:100%;padding:0px;background:transparent;\">";
for(var i=0; i<5; i++){
        innerBottomline+="<tr><th style=\"background:"+(i<bottomlineInfoTabs[startOfBottomline].length - bottomlineInfoCounter + 1 ? "skyblue" : "transparent")+";padding-top:0.1em;padding-bottom:0.1em;width:100%;height:"+(50/bottomlineInfoTabs[startOfBottomline].length)+"%\"></th></tr>";
}
innerBottomline+="</table></th>";

        innerBottomline+="<th style=\"vertical-align:top;width:10%;opacity:0.35;background:#23415a;color:white;font-size:1vw;\">"+bottomlineTabNames[startOfBottomline]+"</th><th style=\"opacity:0.65;background:#222222;color:skyblue;vertical-align:top;font-size:1vw;width:89.5%;\">"+bottomlineInfoTabs[startOfBottomline][bottomlineInfoCounter-1]+"</th>";
}

innerBottomline+="</tr></table>";
$("#bottomline").html(innerBottomline);
bottomlineInfoCounter++;
bottomlineInfoCounter%=bottomlineInfoTabs[startOfBottomline].length+1;

if(bottomlineInfoCounter == 0){
startOfBottomline++;
startOfBottomline%=bottomlineTabNames.length;
}

if(bottomlineInfoCounter != 1){
$("#bottomline").hide(0, function(){$("#bottomline").show('slide', {direction: 'down'});});
}
else{
$("#bottomline").hide(0, function(){$("#bottomline").show('highlight', {color:'lightblue'});});
}
}
else{
$("#bottomline").hide();
}
}

