<?php
$lat=array();$firstLat=array();
$lon=array();$firstLon=array();
$rad=array();$firstRad=array();
$name=array();
$numSatellites=0;

$filenameYear = date("Y");
$filenameMonth = date("m");
$filenameDay = date("d");

$handle = fopen($_GET['filename'], "r");
if ($handle) {
    while (($line = fgets($handle)) !== false) {
        $substring = substr($line, 0, 4);
        if($substring == "Loca"){
                array_push($name, substr($line, 12));
                $numSatellites++;
        }
        else if($substring != "\n"){
                $coordinates = explode(" ", preg_replace('!\s+!', ' ', $line));
                $tmpLatComponents = explode(":", $coordinates[1]);
                $tmpLat = $tmpLatComponents[0] + gmp_sign($tmpLatComponents[0])*(1/60)*($tmpLatComponents[1] + (1/60)*$tmpLatComponents[2]);
                $tmpLonComponents = explode(":", $coordinates[2]);
                $tmpLon = $tmpLonComponents[0] + gmp_sign($tmpLonComponents[0])*(1/60)*($tmpLonComponents[1] + (1/60)*$tmpLonComponents[2]);
                $tmpLon = -$tmpLon;
                if($coordinates[0] == "00:00"){
                        array_push($firstLat, $tmpLat);
                        array_push($firstLon, ($tmpLon-90));
                        array_push($firstRad, $coordinates[3]);
                }
                array_push($lat, $tmpLat);
                array_push($lon, ($tmpLon-90));
                array_push($rad, $coordinates[3]);
        }
}
} else {
    // error opening the file.
}
fclose($handle);

//ADD_SATELLITE//
$futurePositionIndex = 0;
for($i=0; $i<$numSatellites; $i++){

        if(strstr($name[$i], "GOES") != false){
                echo "satelliteModels2.push(satelliteModels[0]);satelliteFlags2.push(satelliteFlags[0]);satelliteRotations.push([0, 0, 180]);satelliteSpinners.push(false);";
        }
        else if(strstr($name[$i], "MTSAT") != false){
                echo "satelliteModels2.push(satelliteModels[1]);satelliteFlags2.push(satelliteFlags[2]);satelliteRotations.push([0, 0, 0]);satelliteSpinners.push(false);";
        }
        else if(strstr($name[$i], "COMS") != false){
                echo "satelliteModels2.push(satelliteModels[2]);satelliteFlags2.push(satelliteFlags[5]);satelliteRotations.push([0, 0, 0]);satelliteSpinners.push(false);";
        }
        else if(strstr($name[$i], "FENGYUN1") != false){
                echo "satelliteModels2.push(satelliteModels[3]);satelliteFlags2.push(satelliteFlags[1]);satelliteRotations.push([0, 0, 0]);satelliteSpinners.push(false);";
        }
        else if(strstr($name[$i], "FENGYUN2") != false){
                echo "satelliteModels2.push(satelliteModels[4]);satelliteFlags2.push(satelliteFlags[1]);satelliteRotations.push([0, 0, 90]);satelliteSpinners.push(true);";
        }
        else if(strstr($name[$i], "FENGYUN3") != false){
                echo "satelliteModels2.push(satelliteModels[5]);satelliteFlags2.push(satelliteFlags[1]);satelliteRotations.push([0, 0, 0]);satelliteSpinners.push(false);";
        }
        else if(strstr($name[$i], "INSAT") != false){
                echo "satelliteModels2.push(satelliteModels[6]);satelliteFlags2.push(satelliteFlags[4]);satelliteRotations.push([0, 0, 0]);satelliteSpinners.push(false);";
        }
        else if(strstr($name[$i], "TERRA") != false){
                echo "satelliteModels2.push(satelliteModels[7]);satelliteFlags2.push(satelliteFlags[0]);satelliteRotations.push([0, 0, 0]);satelliteSpinners.push(false);";
        }
        else if(strstr($name[$i], "AQUA") != false){
                echo "satelliteModels2.push(satelliteModels[8]);satelliteFlags2.push(satelliteFlags[0]);satelliteRotations.push([0, 0, 0]);satelliteSpinners.push(false);";
        }
        else if(strstr($name[$i], "NPP") != false){
                echo "satelliteModels2.push(satelliteModels[9]);satelliteFlags2.push(satelliteFlags[0]);satelliteRotations.push([0, 0, 0]);satelliteSpinners.push(false);";
        }
        else if(strstr($name[$i], "METOP") != false){
                echo "satelliteModels2.push(satelliteModels[10]);satelliteFlags2.push(satelliteFlags[3]);satelliteRotations.push([0, 0, 0]);satelliteSpinners.push(false);";
        }
        else if(strstr($name[$i], "METEOSAT-7") != false){
                echo "satelliteModels2.push(satelliteModels[11]);satelliteFlags2.push(satelliteFlags[3]);satelliteRotations.push([0, 0, 90]);satelliteSpinners.push(true);";
        }
        else if(strstr($name[$i], "METEOSAT") != false){
                echo "satelliteModels2.push(satelliteModels[12]);satelliteFlags2.push(satelliteFlags[3]);satelliteRotations.push([0, 0, 90]);satelliteSpinners.push(true);";
        }
        else if(strstr($name[$i], "NOAA15") != false || strstr($name[$i], "NOAA16") != false){
                echo "satelliteModels2.push(satelliteModels[13]);satelliteFlags2.push(satelliteFlags[0]);satelliteRotations.push([0, 0, 0]);satelliteSpinners.push(false);";
        }
        else if(strstr($name[$i], "NOAA") != false){
                echo "satelliteModels2.push(satelliteModels[14]);satelliteFlags2.push(satelliteFlags[0]);satelliteRotations.push([0, 0, 0]);satelliteSpinners.push(false);";
        }
        else if(strstr($name[$i], "KALPANA") != false){
                echo "satelliteModels2.push(satelliteModels[15]);satelliteFlags2.push(satelliteFlags[4]);satelliteRotations.push([0, 0, 0]);satelliteSpinners.push(false);";
        }
        else if(strstr($name[$i], "LANDSAT") != false){
                echo "satelliteModels2.push(satelliteModels[16]);satelliteFlags2.push(satelliteFlags[0]);satelliteRotations.push([-90, -90, 90]);satelliteSpinners.push(false);";
        }
        else if(strstr($name[$i], "GCOM") != false){
                echo "satelliteModels2.push(satelliteModels[17]);satelliteFlags2.push(satelliteFlags[2]);satelliteRotations.push([0, 0, 0]);satelliteSpinners.push(false);";
        }
        else{
                echo "satelliteModels2.push(satelliteModels[8]);satelliteFlags2.push(satelliteFlags[0]);satelliteRotations.push([0, 0, 0]);satelliteSpinners.push(false);";
        }


        //Populate arrays to contain info for each satellite

        echo "satellitePositions.push({name: " . json_encode($name[$i]) . ", orbitRadius: " . (1 + $firstRad[$i]/6378.1)  . ", hRot: " . ($firstLon[$i])  . ", vRot: " . $firstLat[$i]  . "});";
        echo "futureSatelliteOrbitRadius.push(new Array());";
        echo "futureSatellitehRot.push(new Array());";
        echo "futureSatellitevRot.push(new Array());";

        for($j=0; $j<288; $j++){ //There should be 288 times for each day
                echo "futureSatelliteOrbitRadius[$i].push(" . (1 + $rad[$futurePositionIndex]/6378.1)  . ");";
                echo "futureSatellitehRot[$i].push(" . ($lon[$futurePositionIndex])  . ");";
                echo "futureSatellitevRot[$i].push(" . $lat[$futurePositionIndex]  . ");";

                $futurePositionIndex++;
        }
}
?>

