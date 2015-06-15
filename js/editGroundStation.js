var currEditGroundStationIndex = 0;
var currEditGroundStationLastIndex = false;
function updateEditGroundStation(){
        if(!currEditGroundStationLastIndex){
                groundStationPositions[currEditGroundStationIndex].hRot = document.getElementById("customGroundStationLat").value - 90;
                groundStationPositions[currEditGroundStationIndex].vRot = document.getElementById("customGroundStationLon").value;
                document.getElementsByClassName("groundStationsButtons")[currEditGroundStationIndex].innerHTML = document.getElementById("customGroundStationName").value;
        }
        else{
                groundStationPositions.push({hRot: document.getElementById("customGroundStationLat").value-90, vRot: document.getElementById("customGroundStationLon").value});
                document.getElementById("groundStationButtons").innerHTML += "<div class='groundStationsButtons' onclick='toggleGroundStation("+(groundStationPositions.length-1)+");' >" + document.getElementById("customGroundStationName").value + "</div>";
                isDrawingGroundStation.push(false);
                newEditGroundStation();
        }
}

function loadEditGroundStation(tmpIndex){
document.getElementById("customGroundStationLat").value = groundStationPositions[tmpIndex].hRot+90;
document.getElementById("customGroundStationLon").value = groundStationPositions[tmpIndex].vRot;
document.getElementById("customGroundStationName").value = document.getElementsByClassName("groundStationsButtons")[tmpIndex].innerHTML;
currEditGroundStationIndex = tmpIndex;
currEditGroundStationLastIndex = false;
}

function newEditGroundStation(){
document.getElementById("customGroundStationLat").value = 0;
document.getElementById("customGroundStationLon").value = 0;
document.getElementById("customGroundStationName").value = "";
currEditGroundStationIndex = document.getElementsByClassName("groundStationsButtons").length-2;
currEditGroundStationLastIndex = true;
}

function removeEditGroundStation(){
        document.getElementsByClassName("groundStationsButtons")[currEditGroundStationIndex].style.display="none";
        isDrawingGroundStation[currEditGroundStationIndex] = false;     
        newEditGroundStation();
}

