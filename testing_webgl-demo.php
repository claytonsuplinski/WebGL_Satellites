/*Author: Clayton Suplinski*/

//When adding new models/objects/variables, make sure to check and or modify ./javascriptStuff/webglVariables.js

/*
Parse the satellite.obj file and store the verts, norms, texture coords, and faces in arrays.
*/
<?php
$line = "";
$satelliteCounter = 0;
//ADD_SATELLITE// --Add new models to the end of the array (order matters)
$filenames = array("./satelliteModels/goes1x.obj", "./satelliteModels/mtsat.obj", "./satelliteModels/coms.obj", "./satelliteModels/fy1.obj", "./satelliteModels/fy2.obj", "./satelliteModels/fy3.obj", "./satelliteModels/insat3d.obj", "./satelliteModels/terra.obj", "./satelliteModels/aqua.obj", "./satelliteModels/npp.obj", "./satelliteModels/metop.obj", "./satelliteModels/meteosat.obj", "./satelliteModels/meteosat.obj", "./satelliteModels/noaa15_16.obj", "./satelliteModels/noaa18_19.obj", "./satelliteModels/kalpana.obj", "./satelliteModels/landsat8.obj", "GOES_R_Tris.obj");
foreach($filenames as $filename){
$handle = fopen($filename, 'r') or die("Can't open prev file");
$verts = array();
$norms = array();
$textures = array();
$faces = array();
	if($handle){
		while(!feof($handle)){
			$line = trim(fgets($handle, 4096));

if($line[0] == 'v'){
	if($line[1] == 'n'){ //normals
		$line = explode(" ", $line);
		array_push($norms, $line[2]);
		array_push($norms, $line[3]);
		array_push($norms, $line[4]);
	}
	else if($line[1] == 't'){ //textures
		$line = explode(" ", $line);
		array_push($textures, $line[1]);
                array_push($textures, $line[2]);
	}
	else if($line[1] == ' '){ //vertices
		$line = explode(" ", $line);
		array_push($verts, $line[2]);
                array_push($verts, $line[3]);
                array_push($verts, $line[4]);
	}
}
else if($line[0] == 'f'){ //faces (or indices)
	$line = explode(" ", $line);
	array_push($faces, $line[1]);
        array_push($faces, $line[2]);
        array_push($faces, $line[3]);
}
		
		}
	}

echo "satelliteModels.push(new Object());
satelliteModels[$satelliteCounter].VerticesBuffer=\"empty\";
satelliteModels[$satelliteCounter].VerticesNormalBuffer=\"empty\";
satelliteModels[$satelliteCounter].VerticesTextureCoordBuffer=\"empty\";
satelliteModels[$satelliteCounter].VerticesIndexBuffer=\"empty\";
satelliteModels[$satelliteCounter].Image=\"empty\";
satelliteModels[$satelliteCounter].Texture=\"empty\";
satelliteModels[$satelliteCounter].vertices = [];
satelliteModels[$satelliteCounter].vertexNormals=[];
satelliteModels[$satelliteCounter].textureCoordinates=[];
satelliteModels[$satelliteCounter].VertexIndices=[];
";
for($i=0; $i<count($faces); $i++){ //need to be in the format of: v/t/n v/t/n v/t/n
	echo "satelliteModels[$satelliteCounter].VertexIndices.push(" . $i . ");";	
	
	$face = explode("/", $faces[$i]);
	echo "satelliteModels[$satelliteCounter].vertices.push(" . floatval(-$verts[3*$face[0]-3]/800) . ");";
	echo "satelliteModels[$satelliteCounter].vertices.push(" . floatval($verts[3*$face[0]-2]/800) . ");";
	echo "satelliteModels[$satelliteCounter].vertices.push(" . floatval(-$verts[3*$face[0]-1]/800) . ");";

	echo "satelliteModels[$satelliteCounter].textureCoordinates.push(" . floatval($textures[2*$face[1]-2]) . ");";
	echo "satelliteModels[$satelliteCounter].textureCoordinates.push(" . floatval(1-$textures[2*$face[1]-1]) . ");";

	echo "satelliteModels[$satelliteCounter].vertexNormals.push(" . floatval($norms[3*$face[2]-3]) . ");";
	echo "satelliteModels[$satelliteCounter].vertexNormals.push(" . floatval($norms[3*$face[2]-2]) . ");";
	echo "satelliteModels[$satelliteCounter].vertexNormals.push(" . floatval($norms[3*$face[2]-1]) . ");";
}

//echo "satelliteModels.push(satellite);";

$satelliteCounter++;
fclose($filename);

}

$handle = fopen("./satelliteModels/cone.obj", 'r') or die("Can't open prev file");
$verts = array();
$norms = array();
$textures = array();
$faces = array();
        if($handle){
                while(!feof($handle)){
                        $line = trim(fgets($handle, 4096));

if($line[0] == 'v'){
        if($line[1] == 'n'){ //normals
                $line = explode(" ", $line);
                array_push($norms, $line[2]);
                array_push($norms, $line[3]);
                array_push($norms, $line[4]);
        }
        else if($line[1] == 't'){ //textures
                $line = explode(" ", $line);
                array_push($textures, $line[1]);
                array_push($textures, $line[2]);
        }
        else if($line[1] == ' '){ //vertices
                $line = explode(" ", $line);
                array_push($verts, $line[2]);
                array_push($verts, $line[3]);
                array_push($verts, $line[4]);
        }
}
else if($line[0] == 'f'){ //faces (or indices)
        $line = explode(" ", $line);
        array_push($faces, $line[1]);
        array_push($faces, $line[2]);
        array_push($faces, $line[3]);
}

                }
        }

for($i=0; $i<count($faces); $i++){ //need to be in the format of: v/t/n v/t/n v/t/n
        echo "cone.VertexIndices.push(" . $i . ");";

        $face = explode("/", $faces[$i]);
        echo "cone.vertices.push(" . floatval(-$verts[3*$face[0]-3]) . ");";
        echo "cone.vertices.push(" . floatval($verts[3*$face[0]-2]) . ");";
        echo "cone.vertices.push(" . floatval(-$verts[3*$face[0]-1]) . ");";

        echo "cone.textureCoordinates.push(" . floatval($textures[2*$face[1]-2]) . ");";
        echo "cone.textureCoordinates.push(" . floatval(1-$textures[2*$face[1]-1]) . ");";

        echo "cone.vertexNormals.push(" . floatval($norms[3*$face[2]-3]) . ");";
        echo "cone.vertexNormals.push(" . floatval($norms[3*$face[2]-2]) . ");";
        echo "cone.vertexNormals.push(" . floatval($norms[3*$face[2]-1]) . ");";
}

fclose($filename);

$handle = fopen("./satelliteModels/explosion.obj", 'r') or die("Can't open prev file");
$verts = array();
$norms = array();
$textures = array();
$faces = array();
        if($handle){
                while(!feof($handle)){
                        $line = trim(fgets($handle, 4096));

if($line[0] == 'v'){
        if($line[1] == 'n'){ //normals
                $line = explode(" ", $line);
                array_push($norms, $line[2]);
                array_push($norms, $line[3]);
                array_push($norms, $line[4]);
        }
        else if($line[1] == 't'){ //textures
                $line = explode(" ", $line);
                array_push($textures, $line[1]);
                array_push($textures, $line[2]);
        }
        else if($line[1] == ' '){ //vertices
                $line = explode(" ", $line);
                array_push($verts, $line[2]);
                array_push($verts, $line[3]);
                array_push($verts, $line[4]);
        }
}
else if($line[0] == 'f'){ //faces (or indices)
        $line = explode(" ", $line);
        array_push($faces, $line[1]);
        array_push($faces, $line[2]);
        array_push($faces, $line[3]);
}

                }
        }

for($i=0; $i<count($faces); $i++){ //need to be in the format of: v/t/n v/t/n v/t/n
        echo "explosion.VertexIndices.push(" . $i . ");";

        $face = explode("/", $faces[$i]);
        echo "explosion.vertices.push(" . floatval(-$verts[3*$face[0]-3]) . ");";
        echo "explosion.vertices.push(" . floatval($verts[3*$face[0]-2]) . ");";
        echo "explosion.vertices.push(" . floatval(-$verts[3*$face[0]-1]) . ");";

        echo "explosion.textureCoordinates.push(" . floatval($textures[2*$face[1]-2]) . ");";
        echo "explosion.textureCoordinates.push(" . floatval(1-$textures[2*$face[1]-1]) . ");";

        echo "explosion.vertexNormals.push(" . floatval($norms[3*$face[2]-3]) . ");";
        echo "explosion.vertexNormals.push(" . floatval($norms[3*$face[2]-2]) . ");";
        echo "explosion.vertexNormals.push(" . floatval($norms[3*$face[2]-1]) . ");";
}

fclose($filename);

$handle = fopen("./satelliteModels/pyramid.obj", 'r') or die("Can't open prev file");
$verts = array();
$norms = array();
$textures = array();
$faces = array();
        if($handle){
                while(!feof($handle)){
                        $line = trim(fgets($handle, 4096));

if($line[0] == 'v'){
        if($line[1] == 'n'){ //normals
                $line = explode(" ", $line);
                array_push($norms, $line[2]);
                array_push($norms, $line[3]);
                array_push($norms, $line[4]);
        }
        else if($line[1] == 't'){ //textures
                $line = explode(" ", $line);
                array_push($textures, $line[1]);
                array_push($textures, $line[2]);
        }
        else if($line[1] == ' '){ //vertices
                $line = explode(" ", $line);
                array_push($verts, $line[2]);
                array_push($verts, $line[3]);
                array_push($verts, $line[4]);
        }
}
else if($line[0] == 'f'){ //faces (or indices)
        $line = explode(" ", $line);
        array_push($faces, $line[1]);
        array_push($faces, $line[2]);
        array_push($faces, $line[3]);
}

                }
        }

for($i=0; $i<count($faces); $i++){ //need to be in the format of: v/t/n v/t/n v/t/n
        echo "satelliteVision.VertexIndices.push(" . $i . ");";

        $face = explode("/", $faces[$i]);
        echo "satelliteVision.vertices.push(" . floatval(-$verts[3*$face[0]-3]) . ");";
        echo "satelliteVision.vertices.push(" . floatval($verts[3*$face[0]-2]) . ");";
        echo "satelliteVision.vertices.push(" . floatval(-$verts[3*$face[0]-1]) . ");";

        echo "satelliteVision.textureCoordinates.push(" . floatval($textures[2*$face[1]-2]) . ");";
        echo "satelliteVision.textureCoordinates.push(" . floatval(1-$textures[2*$face[1]-1]) . ");";

        echo "satelliteVision.vertexNormals.push(" . floatval($norms[3*$face[2]-3]) . ");";
        echo "satelliteVision.vertexNormals.push(" . floatval($norms[3*$face[2]-2]) . ");";
        echo "satelliteVision.vertexNormals.push(" . floatval($norms[3*$face[2]-1]) . ");";
}

fclose($filename);


$handle = fopen("./satelliteModels/rocket.obj", 'r') or die("Can't open prev file");
$verts = array();
$norms = array();
$textures = array();
$faces = array();
        if($handle){
                while(!feof($handle)){
                        $line = trim(fgets($handle, 4096));

if($line[0] == 'v'){
        if($line[1] == 'n'){ //normals
                $line = explode(" ", $line);
                array_push($norms, $line[2]);
                array_push($norms, $line[3]);
                array_push($norms, $line[4]);
        }
        else if($line[1] == 't'){ //textures
                $line = explode(" ", $line);
                array_push($textures, $line[1]);
                array_push($textures, $line[2]);
        }
        else if($line[1] == ' '){ //vertices
                $line = explode(" ", $line);
                array_push($verts, $line[2]);
                array_push($verts, $line[3]);
                array_push($verts, $line[4]);
        }
}
else if($line[0] == 'f'){ //faces (or indices)
        $line = explode(" ", $line);
        array_push($faces, $line[1]);
        array_push($faces, $line[2]);
        array_push($faces, $line[3]);
}

                }
        }
for($i=0; $i<count($faces); $i++){ //need to be in the format of: v/t/n v/t/n v/t/n
        echo "rocket.VertexIndices.push(" . $i . ");";

        $face = explode("/", $faces[$i]);
        echo "rocket.vertices.push(" . floatval(-$verts[3*$face[0]-3]/800) . ");";
        echo "rocket.vertices.push(" . floatval($verts[3*$face[0]-2]/800) . ");";
        echo "rocket.vertices.push(" . floatval(-$verts[3*$face[0]-1]/800) . ");";

        echo "rocket.textureCoordinates.push(" . floatval($textures[2*$face[1]-2]) . ");";
        echo "rocket.textureCoordinates.push(" . floatval(1-$textures[2*$face[1]-1]) . ");";

        echo "rocket.vertexNormals.push(" . floatval($norms[3*$face[2]-3]) . ");";
        echo "rocket.vertexNormals.push(" . floatval($norms[3*$face[2]-2]) . ");";
        echo "rocket.vertexNormals.push(" . floatval($norms[3*$face[2]-1]) . ");";
}

fclose($filename);

$handle = fopen("./satelliteModels/rocketFlames.obj", 'r') or die("Can't open prev file");
$verts = array();
$norms = array();
$textures = array();
$faces = array();
        if($handle){
                while(!feof($handle)){
                        $line = trim(fgets($handle, 4096));

if($line[0] == 'v'){
        if($line[1] == 'n'){ //normals
                $line = explode(" ", $line);
                array_push($norms, $line[2]);
                array_push($norms, $line[3]);
                array_push($norms, $line[4]);
        }
        else if($line[1] == 't'){ //textures
                $line = explode(" ", $line);
                array_push($textures, $line[1]);
                array_push($textures, $line[2]);
        }
        else if($line[1] == ' '){ //vertices
                $line = explode(" ", $line);
                array_push($verts, $line[2]);
                array_push($verts, $line[3]);
                array_push($verts, $line[4]);
        }
}
else if($line[0] == 'f'){ //faces (or indices)
        $line = explode(" ", $line);
        array_push($faces, $line[1]);
        array_push($faces, $line[2]);
        array_push($faces, $line[3]);
}

                }
        }
for($i=0; $i<count($faces); $i++){ //need to be in the format of: v/t/n v/t/n v/t/n
        echo "rocketFlames.VertexIndices.push(" . $i . ");";

        $face = explode("/", $faces[$i]);
        echo "rocketFlames.vertices.push(" . floatval(-$verts[3*$face[0]-3]/800) . ");";
        echo "rocketFlames.vertices.push(" . floatval($verts[3*$face[0]-2]/800) . ");";
        echo "rocketFlames.vertices.push(" . floatval(-$verts[3*$face[0]-1]/800) . ");";

        echo "rocketFlames.textureCoordinates.push(" . floatval($textures[2*$face[1]-2]) . ");";
        echo "rocketFlames.textureCoordinates.push(" . floatval(1-$textures[2*$face[1]-1]) . ");";

        echo "rocketFlames.vertexNormals.push(" . floatval($norms[3*$face[2]-3]) . ");";
        echo "rocketFlames.vertexNormals.push(" . floatval($norms[3*$face[2]-2]) . ");";
        echo "rocketFlames.vertexNormals.push(" . floatval($norms[3*$face[2]-1]) . ");";
}

fclose($filename);

?>

function genRandomMeteors(){
	meteors = [];
	for(var i=1; i<4; i++){
                $("#met"+i+"Lat").html("-");
                $("#met"+i+"Lon").html("-");
        }
	for(var i=0; i<numActiveMeteors; i++){
		var tmpX = ((Math.random() > 0.5) ? 1 : -1)*(Math.random() * 5+3.5);
		var tmpY = ((Math.random() > 0.5) ? 1 : -1)*(Math.random() * 5+3.5);
		var tmpZ = ((Math.random() > 0.5) ? 1 : -1)*(Math.random() * 5+3.5);
		var tmpRad = Math.sqrt(tmpX*tmpX + tmpY*tmpY + tmpZ*tmpZ);
		var tmpLat = 90-Math.acos(tmpY/tmpRad)/angleFactor;
		while(tmpLat > 90){tmpLat = 180-tmpLat;}
		while(tmpLat < -90){tmpLat = -180-tmpLat;}
		var tmpLatDirection = "&deg; N";
		if(tmpLat < 0){tmpLatDirection = "&deg; S";};
		var tmpLon = -Math.atan2(tmpX,tmpZ)/angleFactor;
		while(tmpLon > 180){tmpLon -= 360;}
		while(tmpLon < -180){tmpLon += 360;}
		var tmpLonDirection = "&deg; E";
		if(tmpLon > 0){tmpLonDirection = "&deg; W";};
		meteors.push({x: tmpX, y: tmpY, z: tmpZ, velocity: 0.0005, exploding: false, explodingCounter: 0, lat: Number(Math.abs(tmpLat).toFixed(1)),latDir: tmpLatDirection,lon: Number(Math.abs(tmpLon).toFixed(1)),lonDir:tmpLonDirection});
                $("#met"+(i+1)+"Lat").html(meteors[i].lat + meteors[i].latDir);
                $("#met"+(i+1)+"Lon").html(meteors[i].lon + meteors[i].lonDir);
	}
}

function genRandomMeteor(tmpIndex){
                var tmpX = ((Math.random() > 0.5) ? 1 : -1)*(Math.random() * 5+3.5);
                var tmpY = ((Math.random() > 0.5) ? 1 : -1)*(Math.random() * 5+3.5);
                var tmpZ = ((Math.random() > 0.5) ? 1 : -1)*(Math.random() * 5+3.5);
                var tmpRad = Math.sqrt(tmpX*tmpX + tmpY*tmpY + tmpZ*tmpZ);
                var tmpLat = 90-Math.acos(tmpY/tmpRad)/angleFactor;
                while(tmpLat > 90){tmpLat = 180-tmpLat;}
                while(tmpLat < -90){tmpLat = -180-tmpLat;}
                var tmpLatDirection = "&deg; N";
                if(tmpLat < 0){tmpLatDirection = "&deg; S";};
                var tmpLon = -Math.atan2(tmpX,tmpZ)/angleFactor;
                while(tmpLon > 180){tmpLon -= 360;}
                while(tmpLon < -180){tmpLon += 360;}
                var tmpLonDirection = "&deg; E";
                if(tmpLon > 0){tmpLonDirection = "&deg; W";};
                meteors[tmpIndex] = {x: tmpX, y: tmpY, z: tmpZ, velocity: 0.0005, exploding: false, explodingCounter: 0, lat: Number(Math.abs(tmpLat).toFixed(1)),latDir: tmpLatDirection,lon: Number(Math.abs(tmpLon).toFixed(1)),lonDir:tmpLonDirection};
		$("#met"+(tmpIndex+1)+"Lat").html(meteors[tmpIndex].lat + meteors[tmpIndex].latDir);
		$("#met"+(tmpIndex+1)+"Lon").html(meteors[tmpIndex].lon + meteors[tmpIndex].lonDir);
}

function genSphereVertices(shape){
for (var latNumber = 0; latNumber <= shape.latitudeBands; latNumber++) {
   var theta = latNumber * Math.PI / shape.latitudeBands;
   var sinTheta = Math.sin(theta);
   var cosTheta = Math.cos(theta);
   for (var longNumber = 0; longNumber <= shape.longitudeBands; longNumber++) {
     var phi = longNumber * 2 * Math.PI / shape.longitudeBands;
     var sinPhi = Math.sin(phi);
     var cosPhi = Math.cos(phi);
     var x = cosPhi * sinTheta;
     var y = cosTheta;
     var z = sinPhi * sinTheta;
     var u = 1- (longNumber / shape.longitudeBands);
     var v = latNumber / shape.latitudeBands;
     shape.vertexNormals.push(x);
     shape.vertexNormals.push(y);
     shape.vertexNormals.push(z);
     shape.textureCoordinates.push(u);
     shape.textureCoordinates.push(v);
     shape.vertices.push(shape.radius * x);
     shape.vertices.push(shape.radius * y);
     shape.vertices.push(shape.radius * z);
   }
}

for (var latNumber = 0; latNumber < shape.latitudeBands; latNumber++) {
   for (var longNumber = 0; longNumber < shape.longitudeBands; longNumber++) {
     var first = (latNumber * (shape.longitudeBands + 1)) + longNumber;
     var second = first + shape.longitudeBands + 1;
     shape.VertexIndices.push(first);
     shape.VertexIndices.push(second);
     shape.VertexIndices.push(first + 1);
     shape.VertexIndices.push(second);
     shape.VertexIndices.push(second + 1);
     shape.VertexIndices.push(first + 1);
   }
}
} //end genSphereVertices

function genPathVertices(shape, index){
satellitePaths[index] = new Object();
satellitePaths[index].VerticesBuffer="empty";
satellitePaths[index].VerticesNormalBuffer="empty";
satellitePaths[index].VerticesTextureCoordBuffer="empty";
satellitePaths[index].VerticesIndexBuffer="empty";
satellitePaths[index].Image="empty";
satellitePaths[index].Texture="empty";
satellitePaths[index].vertices = [];
satellitePaths[index].vertexNormals=[];
satellitePaths[index].textureCoordinates=[];
satellitePaths[index].VertexIndices=[];

var numPathIntervals = 10;

for(var i=0; i<futureSatelliteOrbitRadius[index].length; i++){

	if(i<futureSatelliteOrbitRadius[index].length-1){

		for(var j=0; j<numPathIntervals; j++){
			var tmpBFactor = (j/numPathIntervals);
			var tmpAFactor = 1-tmpBFactor;
		
			var tmpAvgRadius = tmpAFactor*futureSatelliteOrbitRadius[index][i]+tmpBFactor*futureSatelliteOrbitRadius[index][i+1];
	
			var tmpVRot1 = (90-futureSatellitevRot[index][i])*angleFactor;
                        var tmpHRot1 = futureSatellitehRot[index][i]*angleFactor;
			var tmpVRot2 = (90-futureSatellitevRot[index][i+1])*angleFactor;
                        var tmpHRot2 = futureSatellitehRot[index][i+1]*angleFactor;
                        var sin1 = futureSatelliteOrbitRadius[index][i] * Math.sin(tmpVRot1);
			var sin2 = futureSatelliteOrbitRadius[index][i+1] * Math.sin(tmpVRot2);
                        var tmpZ = sin1 * Math.cos(tmpHRot1);
                        var tmpX = sin1 * Math.sin(tmpHRot1);
                        var tmpY = futureSatelliteOrbitRadius[index][i] * Math.cos(tmpVRot1);
			var tmpZ2 = sin2 * Math.cos(tmpHRot2);
                        var tmpX2 = sin2 * Math.sin(tmpHRot2);
                        var tmpY2 = futureSatelliteOrbitRadius[index][i+1] * Math.cos(tmpVRot2);

			var tmpX3 = tmpAFactor*tmpX + tmpBFactor*tmpX2;
                        var tmpY3 = tmpAFactor*tmpY + tmpBFactor*tmpY2;
                        var tmpZ3 = tmpAFactor*tmpZ + tmpBFactor*tmpZ2;

			var finalRadius = Math.sqrt(tmpX3*tmpX3 + tmpY3*tmpY3 + tmpZ3*tmpZ3);
                        var finalLat = 90-Math.acos(tmpY3/finalRadius)/angleFactor;
                        var finalLon = Math.atan2(tmpX3,tmpZ3)/angleFactor;

			tmpVRot1 = (90-finalLat)*angleFactor;
                        tmpHRot1 = finalLon*angleFactor;
                        sin1 = tmpAvgRadius * Math.sin(tmpVRot1);
                        tmpZ = sin1 * Math.cos(tmpHRot1);
                        tmpX = sin1 * Math.sin(tmpHRot1);
                        tmpY = tmpAvgRadius * Math.cos(tmpVRot1);


	        satellitePaths[index].vertices.push(tmpX);
        	satellitePaths[index].vertices.push(tmpY);
	        satellitePaths[index].vertices.push(tmpZ);

        	satellitePaths[index].vertexNormals.push(1);satellitePaths[index].vertexNormals.push(0);satellitePaths[index].vertexNormals.push(0);
	        satellitePaths[index].textureCoordinates.push((i+tmpBFactor)/futureSatelliteOrbitRadius[index].length);satellitePaths[index].textureCoordinates.push(0);

		satellitePaths[index].VertexIndices.push(numPathIntervals*i+j);satellitePaths[index].VertexIndices.push(numPathIntervals*i+j+1);
	
		}

//	satellitePaths[index].VertexIndices.push(i);satellitePaths[index].VertexIndices.push(i+1);
	}
	else{

	var tmpVRot1 = (90-futureSatellitevRot[index][i])*angleFactor;
                        var tmpHRot1 = futureSatellitehRot[index][i]*angleFactor;
                        var sin1 = futureSatelliteOrbitRadius[index][i] * Math.sin(tmpVRot1);
                        var tmpZ = sin1 * Math.cos(tmpHRot1);
                        var tmpX = sin1 * Math.sin(tmpHRot1);
                        var tmpY = futureSatelliteOrbitRadius[index][i] * Math.cos(tmpVRot1);

        satellitePaths[index].vertices.push(tmpX);
        satellitePaths[index].vertices.push(tmpY);
        satellitePaths[index].vertices.push(tmpZ);

        satellitePaths[index].vertexNormals.push(1);satellitePaths[index].vertexNormals.push(0);satellitePaths[index].vertexNormals.push(0);
        satellitePaths[index].textureCoordinates.push(i/futureSatelliteOrbitRadius[index].length);satellitePaths[index].textureCoordinates.push(0);
	satellitePaths[index].VertexIndices.push(i);satellitePaths[index].VertexIndices.push(i-1);
	}
}

}

/*
Initialize all the canvas and webgl stuff
*/
function start() {
   
   isTouchScreen = 'ontouchstart' in document.documentElement;

   $.ajaxSetup({ cache: false, async: false });

  satelliteModelsReset = satelliteModels;
  satelliteFlagsReset = satelliteFlags;

  canvas = document.getElementById("glcanvas");

  initWebGL(canvas);      // Initialize the GL context
  
  // Only continue if WebGL is available and working
  
  if (gl) {
    maxTextureSize = gl.getParameter(gl.MAX_TEXTURE_SIZE);
    if(maxTextureSize < 8192 || selectLowResTexture){
	imageFilenamePrefix = "lr_";
	$("#lowResButton").css({color:'#662255'});
    }

    gl.clearColor(0.0, 0.0, 0.0, 1.0);  // Clear to black, fully opaque
    gl.clearDepth(1.0);                 // Clear everything
    gl.enable(gl.DEPTH_TEST);           // Enable depth testing
    gl.depthFunc(gl.LEQUAL);            // Near things obscure far things
    
    initShaders();

    //Initialize all the objects to be displayed

    initBuffers(sunGlow);
    initTextures(sunGlow, "sunGlow2.png", false);

    initBuffers(xyzAxis);
    initTextures(xyzAxis, "rainbowGradient.png", false);

    initBuffers(rainbowGlare);
    initTextures(rainbowGlare, "rainbowGlare.png", false);

    genSphereVertices(celestialSphere);
    initBuffers(celestialSphere);
    initTextures(celestialSphere, "./celestialSphere.png", false);

    genSphereVertices(earth);
    initBuffers(earth);
    //initTextures(earth, "./earthTextures/earthTexture.jpg", false);

    genSphereVertices(earthSunCentered);
    initBuffers(earthSunCentered);
    initTextures(earthSunCentered, "./earthTextures/earthBlueMarble.png", false);

    genSphereVertices(meteor);
    initBuffers(meteor);
    initTextures(meteor, "./meteor.jpg", false);

    genSphereVertices(bullet);
    initBuffers(bullet);
    initTextures(bullet, "./greenDot.jpg", false);

    genSphereVertices(moon);
    initBuffers(moon);
    initTextures(moon, "./moon.png", false);

    genSphereVertices(sun);
    initBuffers(sun);
    initTextures(sun, "./sun.png", false);

    genSphereVertices(satellitePath);
    initBuffers(satellitePath);
    initTextures(satellitePath, "./cloudsOnly/lr_clouds-14309-0700.png", false);
//    initTextures(satellitePath, "./terminator.png");
//    initTextures(satellitePath, "./satellitePaths/NPP_MSN.png");


    var dateOfYear = new Date(year, (month-1), day);
    var startOfYear = new Date(year, 0, 0);
    var diff = dateOfYear - startOfYear;
    var dayOfYear = Math.round(diff / 86400000);

    var terminatorFilename="./daynight/day-night-";
    if(dayOfYear < 10){
	terminatorFilename += "00"+dayOfYear;
    }
    else if(dayOfYear < 100){
	terminatorFilename += "0"+dayOfYear;
    }
    else{
	terminatorFilename += dayOfYear;
    }
    terminatorFilename += ".png";

    genSphereVertices(terminator);
    initBuffers(terminator);
    initTextures(terminator, terminatorFilename, false);

    genSphereVertices(earthMantle);
    initBuffers(earthMantle);
    initTextures(earthMantle, "earthMantle.png", false);

    genSphereVertices(earthCore);
    initBuffers(earthCore);
    initTextures(earthCore, "earthCore.png", false);

    initBuffers(explosion);
    initTextures(explosion, "./satelliteModels/explosion.png", false);

    initBuffers(cone);
    initTextures(cone, "./satelliteModels/cone.png", false);

    initBuffers(satelliteVision);
    initTextures(satelliteVision, "./satelliteModels/pyramid2.png", false);

    initBuffers(rocket);
    initTextures(rocket, "./satelliteModels/rocket.png", false);

    initBuffers(rocketFlames);
    initTextures(rocketFlames, "./satelliteModels/rocketFlames.png", false);

    for(var i=0; i<satelliteTextures.length; i++){
    initBuffers(satelliteModels[i]);
    initTextures(satelliteModels[i], satelliteTextures[i], false);
    }

    //Setup the event listeners for functions used later on

    document.addEventListener( 'mousedown', onDocumentMouseDown, false );
    
    if(document.addEventListener){
    document.addEventListener('mousewheel', MouseWheelHandler, false);
    document.addEventListener('DOMMouseScroll', MouseWheelHandler, false);
    }
    else{
    document.addEventListener('onmousewheel', MouseWheelHandler, false);
    }

    //Have certain functions called on a periodic loop
 
    setInterval(drawScene, 15);
    setInterval(updateEarthTexture, 100);
    setInterval(lerpSatellitePositions, 15);
    setInterval(getSunAndMoonCoordinates, 60);
    setInterval(updateInfo, 30);
    setInterval(bottomlineUpdate, 6000);
    setInterval(keyResponse, 60);

/*
Read through the coordinate files and assign each set of coordinates to the satellites
*/

  ajaxSetup();
  initInfoTabs();

  loadEditGroundStation(0);

  }
}


function ajaxSetup(){

satelliteRotations = new Array();satelliteSpinners = new Array();
satellitePositions = new Array();
futureSatelliteOrbitRadius = new Array();
futureSatellitehRot = new Array();
futureSatellitevRot = new Array();

satelliteModels = satelliteModelsReset;satelliteFlags = satelliteFlagsReset;

var satelliteModels2 = new Array();var satelliteFlags2 = new Array();
var satellitePositionsFilename = "";

$.get("./dataDir/satellitePositions/",function(data,status){
                var output = strip(data).split('\n');
                var displayOutput = "";
                var satellitePositionsFilenames = new Array();
                for(var i=0; i<output.length; i++){
                        if(output[i][0] == '2'){
                        satellitePositionsFilenames.push(output[i].split(".txt")[0]);
                        }
                }

		var foundAFilename = false;
		for(var i=0; i<satellitePositionsFilenames.length; i++){
			var filenameTimeValues = satellitePositionsFilenames[i].split("_");
			if(filenameTimeValues.length > 2){
				if(day == Number(filenameTimeValues[2]) && month == Number(filenameTimeValues[1]) && year == Number(filenameTimeValues[0])){
					foundAFilename = true;
					satellitePositionsFilename = "./dataDir/satellitePositions/"+satellitePositionsFilenames[i]+".txt";
					i+=satellitePositionsFilenames.length+5;
				}
			}
		}		

		if(!foundAFilename){
                satellitePositionsFilename = "./dataDir/satellitePositions/"+satellitePositionsFilenames[satellitePositionsFilenames.length-1]+".txt";
		}

                $.get('./getSatellitePositions.php?filename='+satellitePositionsFilename, function(data) {
                        eval(data);
                        
        satelliteModels = satelliteModels2;
        satelliteFlags = satelliteFlags2;

        startingSatellitePositions = satellitePositions;


        /*
        Create the Satellites menu from the list of satellite names
        */
        var innerGeostationary = "";var innerPolar = "";
        var innerGeostationary2 = "<table style='width:100%;height:100%;font-size:14px;'><tr><th colspan='9'>Geostationary</th></tr>";var innerPolar2 = "<table style='width:100%;height:100%;font-size:14px;'><tr><th colspan='9'>Polar</th></tr>";

	closestSatelliteToEarthDistance = 99;

        for(var i=0; i<satellitePositions.length; i++){
                
        var nameBox = new Object();
nameBox.VerticesBuffer="empty";
nameBox.VerticesNormalBuffer="empty";
nameBox.VerticesTextureCoordBuffer="empty";
nameBox.VerticesIndexBuffer="empty";
nameBox.Half = 0.25;
nameBox.Image="empty";
nameBox.Texture="empty";
nameBox.vertices = [
     -nameBox.Half, -nameBox.Half/2,  0,
     nameBox.Half, -nameBox.Half/2,  0,
     nameBox.Half,  nameBox.Half/2,  0,
    -nameBox.Half,  nameBox.Half/2,  0
];
nameBox.vertexNormals = [
     0.0,  0.0,  1.0,
     0.0,  0.0,  1.0,
     0.0,  0.0,  1.0,
     0.0,  0.0,  1.0
];
nameBox.textureCoordinates = [
    0.0,  0.0,
    1.0,  0.0,
    1.0,  1.0,
    0.0,  1.0
];
nameBox.VertexIndices = [
    0,  1,  2,      0,  2,  3
];

                initBuffers(nameBox);
                initTextures(nameBox, "./satelliteNames/"+satellitePositions[i].name+".png", false);   

                satelliteNames.push(nameBox);

		if(satellitePositions[i].orbitRadius-1 < closestSatelliteToEarthDistance){
			closestSatelliteToEarthDistance = 0.4;//satellitePositions[i].orbitRadius-1;
		}

                if(satellitePositions[i].orbitRadius > 2){
                        innerGeostationary2 = innerGeostationary2 + "<tr><td class=\"satellitesListOnOff\" id='onOff"+i+"' onmousedown='turnSatelliteOnOff("+i+");'>ON</td><td class=\"satellitesListPath\" onmousedown='turnPathOnOff("+i+");' id='path"+i+"'>PATH</td><td class=\"satellitesListSatellite\" id='satelliteFollowToggle"+i+"' onmousedown=\"followSatelliteToggle("+i+");\"><span style='float:left' class='satelliteMenuLat' id='satelliteMenuLat"+i+"'>Lat</span>"+satellitePositions[i].name+"<span style='float:right;' class='satelliteMenuLon' id='satelliteMenuLon"+i+"'>Lon</span></td></tr>";

			satelliteVisionScales.push([0,0,0]);
                }
                else{
                        innerPolar2 = innerPolar2 + "<tr><td class=\"satellitesListSatellite\" id='satelliteFollowToggle"+i+"' onmousedown=\"followSatelliteToggle("+i+");\"><span style='float:left' class='satelliteMenuLat' id='satelliteMenuLat"+i+"'>Lat</span>"+satellitePositions[i].name+"<span style='float:right;' class='satelliteMenuLon' id='satelliteMenuLon"+i+"'>Lon</span></td>"+
				"<td class=\"satellitesListSwath\" id='swath"+i+"' onmousedown='turnSwathOnOff("+i+");'>SWATH</td>"+
				"<td class=\"satellitesListPath\" id='path"+i+"' onmousedown='turnPathOnOff("+i+");'>PATH</td>"+
				"<td class=\"satellitesListOnOff\" onmousedown='turnSatelliteOnOff("+i+");' id='onOff"+i+"'>ON</td>"+
				"</tr>";

			if(satellitePositions[i].name.indexOf("LANDSAT") > -1){
			var tmpVisionRadius = satellitePositions[i].orbitRadius-0.5;
	                satelliteVisionScales.push([tmpVisionRadius*Math.tan(7.7*angleFactor),tmpVisionRadius,0.01]);
			}
			else{
			var tmpVisionRadius = satellitePositions[i].orbitRadius-0.5;
                        satelliteVisionScales.push([tmpVisionRadius*Math.tan(55*angleFactor),tmpVisionRadius,0.01]);
			}
                 }

		isDrawingSatellite.push(true);
		isDrawingPath.push(false);
		isDrawingSatelliteVision.push(false);

		satelliteInShadow[i] = 0;

        }

	coneXZScale = closestSatelliteToEarthDistance*Math.cos(5*angleFactor);//closestSatelliteToEarthDistance/Math.tan(5*angleFactor);
	closestSatelliteToEarthDistance = Math.sqrt(closestSatelliteToEarthDistance*closestSatelliteToEarthDistance - coneXZScale*coneXZScale);

        innerGeostationary2 = innerGeostationary2 + "</table>";
        innerPolar2 = innerPolar2 + "</table>";

	document.getElementById("geostationarySatellitesList").innerHTML=innerGeostationary2;
        document.getElementById("polarSatellitesList").innerHTML=innerPolar2;

        initSatellitePositions();

        if(followSatellite){
                startFollowingSatellite(0);
        }

        tourTransitionInterval = 240 + 1.2*Number($('#sliderTourTransition').slider('option', 'value'));
        tourInterval = 280 + 1.4*Number($('#sliderTourInterval').slider('option', 'value')) + tourTransitionInterval;


	for(var i=0; i<satellitePositions.length; i++){
    genPathVertices(satellitePaths[i], i);
    initBuffers(satellitePaths[i]);
    initTextures(satellitePaths[i], "./rainbowGradient.png", false);
        
    }

                        
                });
        });
}

////////Resume commenting here/////////


function updateHashLink(variableName, variableValue){
	//location.hash works as is

	//check to see if the hash string already contains the variableName
	//if(contains){then change the existing value and put it back in location.hash}
	//else{add variableName:variableValue; to the beginning of the hash string}

	var hashString = location.hash.substring(1);
        var hashArray = hashString.split(";");
        for(var i=0; i<hashArray.length; i++){
                hashArray[i] = hashArray[i].split(":");
        }

	var containsVariableName = false;
	for(var i=0; i<hashArray.length; i++){
		if(hashArray[i].length > 1){
			if(hashArray[i][0] == variableName){
				hashArray[i][1] = variableValue;
				containsVariableName = true;
				i+=hashArray.length+5;
			}
		}
	}

	if(!containsVariableName){
		hashArray.push([variableName, variableValue]);
	}

	var outputHashString = "";
	for(var i=0; i<hashArray.length; i++){
		if(hashArray[i].length > 1){
			outputHashString += hashArray[i][0] + ":" + hashArray[i][1] + ";";
		}
	}
	location.hash = outputHashString;
}

function startFollowingSatellite(index){
	followSatellite = true;
        satelliteToFollow = index;
        document.getElementById("following").style.display="inline";
        document.getElementById("satelliteBeingFollowed").innerHTML=satellitePositions[satelliteToFollow].name;
	document.getElementById("satelliteBeingFollowedFlag").style.backgroundImage="url("+satelliteFlags[satelliteToFollow%satelliteFlags.length]+")";

	for(var i=0; i<satellitePositions.length; i++){
	$("#satelliteFollowToggle"+i+"").css({color:'white'});
	}
	$("#satelliteFollowToggle"+index+"").css({color:'skyblue'});

	$("#followingInfoLeft").hide('slide', {direction: 'left'}, 'slow');$("#followingInfoRight").hide('slide', {direction: 'right'}, 'slow');
	updateHashLink("followSatellite", true);

	stopRocketMode();
}

 function onDocumentTouchStart( event ) {
          if ( event.touches.length == 1 ) {
               event.preventDefault();
          }
 }

 function onDocumentTouchMove( event ) {
          if ( event.touches.length == 1 ) {
                event.preventDefault();
          }
 }

function initInfoTabs(){
	var tmpLeftTab = new Array();
	$.get("./dataDir/satinfo/GOES13/left_info.txt",function(data,status){
                var output = data.split('\n');//strip(data).split('\n');
		for(var i=0; i<output.length; i++){
			tmpLeftTab.push(output[i]);
		}
		leftInfoTabs.push(tmpLeftTab);
		
		var leftInfoTabContent = "";
		for(var i=0; i<leftInfoTabs[0].length; i++){
			leftInfoTabContent += leftInfoTabs[0][i];
		}
		$('#followingInfoLeft').html(leftInfoTabContent);
	});

	var tmpRightTab = new Array();
	$.get("./dataDir/satinfo/GOES13/right_info.txt",function(data,status){
                var output = data.split('\n');
                for(var i=0; i<output.length; i++){
                        tmpRightTab.push(output[i]);
                }
		rightInfoTabs.push(tmpRightTab);

		var rightInfoTabContent = "";
                for(var i=0; i<rightInfoTabs[0].length; i++){
                        rightInfoTabContent += rightInfoTabs[0][i];
                }
                $('#followingInfoRight').html(rightInfoTabContent);

        });

}

//
// initWebGL
//
// Initialize WebGL, returning the GL context or null if
// WebGL isn't available or could not be initialized.
//
function initWebGL() {
  gl = null;
  
  try {
    gl = canvas.getContext("experimental-webgl");
  }
  catch(e) {
  }
  
  // If we don't have a GL context, give up now
  
  if (!gl) {
    alert("Unable to initialize WebGL. Your browser may not support it.");
  }
}

//
// initBuffers
//
// Initialize the buffers we'll need. For this demo, we just have
// one object -- a simple two-dimensional cube.
//
function initBuffers(shape) {
  
  // Create a buffer for the cube's vertices.
  
  shape.VerticesBuffer = gl.createBuffer();
  
  // Select the cubeVerticesBuffer as the one to apply vertex
  // operations to from here out.
  
  gl.bindBuffer(gl.ARRAY_BUFFER, shape.VerticesBuffer);
  
  // Now create an array of vertices for the cube.
  
  // Now pass the list of vertices into WebGL to build the shape. We
  // do this by creating a Float32Array from the JavaScript array,
  // then use it to fill the current vertex buffer.
  
  gl.bufferData(gl.ARRAY_BUFFER, new Float32Array(shape.vertices), gl.STATIC_DRAW);

  // Set up the normals for the vertices, so that we can compute lighting.
  
  shape.VerticesNormalBuffer = gl.createBuffer();
  gl.bindBuffer(gl.ARRAY_BUFFER, shape.VerticesNormalBuffer);
  
  gl.bufferData(gl.ARRAY_BUFFER, new Float32Array(shape.vertexNormals),
                gl.STATIC_DRAW);
  
  // Map the texture onto the shape's faces.
  
  shape.VerticesTextureCoordBuffer = gl.createBuffer();
  gl.bindBuffer(gl.ARRAY_BUFFER, shape.VerticesTextureCoordBuffer);
  
  gl.bufferData(gl.ARRAY_BUFFER, new Float32Array(shape.textureCoordinates),
                gl.STATIC_DRAW);

  // Build the element array buffer; this specifies the indices
  // into the vertex array for each face's vertices.
  
  shape.VerticesIndexBuffer = gl.createBuffer();
  gl.bindBuffer(gl.ELEMENT_ARRAY_BUFFER, shape.VerticesIndexBuffer);
  
  // This array defines each face as two triangles, using the
  // indices into the vertex array to specify each triangle's
  // position.
  
  // Now send the element array to GL
  
  gl.bufferData(gl.ELEMENT_ARRAY_BUFFER,
      new Uint16Array(shape.VertexIndices), gl.STATIC_DRAW);
}

//
// initTextures
//
// Initialize the textures we'll be using, then initiate a load of
// the texture images. The handleTextureLoaded() callback will finish
// the job; it gets called each time a texture finishes loading.
//
function initTextures(shape, image, hideLoadingScreen) {
  shape.Texture = gl.createTexture();
  shape.Image = new Image();
  shape.Image.onload = function() { handleTextureLoaded(shape.Image, shape.Texture);if(hideLoadingScreen){$('#loadingScreen').hide('fade');}}
  shape.Image.src = image;
}

function handleTextureLoaded(image, texture) {
  gl.bindTexture(gl.TEXTURE_2D, texture);
  gl.texImage2D(gl.TEXTURE_2D, 0, gl.RGBA, gl.RGBA, gl.UNSIGNED_BYTE, image);
  gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_MAG_FILTER, gl.LINEAR);
  gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_MIN_FILTER, gl.LINEAR_MIPMAP_NEAREST);
  gl.generateMipmap(gl.TEXTURE_2D);
  gl.bindTexture(gl.TEXTURE_2D, null);
}

function drawSphere(sphere, transX, transY, transZ, rotY, scaleX, scaleY, scaleZ){

  mvPushMatrix();
  mvRotate(rotY, [0,1,0]);
  mvTranslate([transX, transY, transZ]);

  gl.bindBuffer(gl.ARRAY_BUFFER, sphere.VerticesBuffer);
  gl.vertexAttribPointer(vertexPositionAttribute, 3, gl.FLOAT, false, 0, 0);

  gl.bindBuffer(gl.ARRAY_BUFFER, sphere.VerticesTextureCoordBuffer);
  gl.vertexAttribPointer(textureCoordAttribute, 2, gl.FLOAT, false, 0, 0);

  gl.bindBuffer(gl.ARRAY_BUFFER, sphere.VerticesNormalBuffer);
  if(vertexNormalAttribute != -1){
  gl.vertexAttribPointer(vertexNormalAttribute, 3, gl.FLOAT, false, 0, 0);
  }

  gl.activeTexture(gl.TEXTURE0);
  gl.bindTexture(gl.TEXTURE_2D, sphere.Texture);
  gl.uniform1i(gl.getUniformLocation(shaderProgram, "uSampler"), 0);

  gl.uniform3fv(scaleLocation, [scaleX, scaleY, scaleZ]);
  gl.uniform3fv(moreVariablesLocation, [0,0,0]);

  gl.bindBuffer(gl.ELEMENT_ARRAY_BUFFER, sphere.VerticesIndexBuffer);
  setMatrixUniforms();
  gl.drawElements(gl.TRIANGLES, sphere.VertexIndices.length, gl.UNSIGNED_SHORT, 0);

  // Restore the original matrix

  mvPopMatrix();
}

function drawSatellite(sphere, transX, transY, transZ, rotY, scaleX, scaleY, scaleZ, index){

  mvPushMatrix();
  mvRotate(rotY, [0,1,0]);
  mvTranslate([transX, transY, transZ]);

  gl.bindBuffer(gl.ARRAY_BUFFER, sphere.VerticesBuffer);
  gl.vertexAttribPointer(vertexPositionAttribute, 3, gl.FLOAT, false, 0, 0);

  gl.bindBuffer(gl.ARRAY_BUFFER, sphere.VerticesTextureCoordBuffer);
  gl.vertexAttribPointer(textureCoordAttribute, 2, gl.FLOAT, false, 0, 0);

  gl.bindBuffer(gl.ARRAY_BUFFER, sphere.VerticesNormalBuffer);
  if(vertexNormalAttribute != -1){
  gl.vertexAttribPointer(vertexNormalAttribute, 3, gl.FLOAT, false, 0, 0);
  }

  gl.activeTexture(gl.TEXTURE0);
  gl.bindTexture(gl.TEXTURE_2D, sphere.Texture);
  gl.uniform1i(gl.getUniformLocation(shaderProgram, "uSampler"), 0);

  gl.uniform3fv(scaleLocation, [scaleX, scaleY, scaleZ]);
  gl.uniform3fv(moreVariablesLocation, [satelliteInShadow[index],0,0]);

  gl.bindBuffer(gl.ELEMENT_ARRAY_BUFFER, sphere.VerticesIndexBuffer);
  setMatrixUniforms();
  gl.drawElements(gl.TRIANGLES, sphere.VertexIndices.length, gl.UNSIGNED_SHORT, 0);

  // Restore the original matrix

  mvPopMatrix();
}

function drawLines(sphere, transX, transY, transZ, rotY, scaleX, scaleY, scaleZ){

  mvPushMatrix();
  mvRotate(rotY, [0,1,0]);
  mvTranslate([transX, transY, transZ]);

  gl.bindBuffer(gl.ARRAY_BUFFER, sphere.VerticesBuffer);
  gl.vertexAttribPointer(vertexPositionAttribute, 3, gl.FLOAT, false, 0, 0);

  gl.bindBuffer(gl.ARRAY_BUFFER, sphere.VerticesTextureCoordBuffer);
  gl.vertexAttribPointer(textureCoordAttribute, 2, gl.FLOAT, false, 0, 0);

  gl.bindBuffer(gl.ARRAY_BUFFER, sphere.VerticesNormalBuffer);
  if(vertexNormalAttribute != -1){
  gl.vertexAttribPointer(vertexNormalAttribute, 3, gl.FLOAT, false, 0, 0);
  }

  gl.activeTexture(gl.TEXTURE0);
  gl.bindTexture(gl.TEXTURE_2D, sphere.Texture);
  gl.uniform1i(gl.getUniformLocation(shaderProgram, "uSampler"), 0);

  gl.uniform3fv(scaleLocation, [scaleX, scaleY, scaleZ]);
  gl.uniform3fv(moreVariablesLocation, [0,0,0]);

  gl.bindBuffer(gl.ELEMENT_ARRAY_BUFFER, sphere.VerticesIndexBuffer);
  setMatrixUniforms();
  gl.drawElements(gl.LINES, sphere.VertexIndices.length, gl.UNSIGNED_SHORT, 0);

  // Restore the original matrix

  mvPopMatrix();
}

function stopFollowingSatellites(){
	followSatellite = false;
	endTourMode(tourMode);
	endCinematicMode(cinematicMode);
	endSatelliteFreeMode();

        if(satelliteViewType > 3){
                 satelliteViewType = 2;
        }

        for(var i=0; i<satellitePositions.length; i++){
                  $("#satelliteFollowToggle"+i+"").css({color:'white'});
        }

        document.getElementById("following").style.display="none";
        $("#followingInfoLeft").hide('slide', {direction: 'left'}, 'slow');$("#followingInfoRight").hide('slide', {direction: 'right'}, 'slow');

        updateHashLink("followSatellite", false);
}


function getSunAndMoonCoordinates(){

sun.hRot = 90+360*currTime/86400;

			var tmpVRot1 = (90-sun.vRot)*angleFactor;
                        var tmpHRot1 = (centerAroundSun ? -earthRotation-90  : -sun.hRot)*angleFactor;
                        var sin1 = sun.orbitRadius * Math.sin(tmpVRot1);
                        sun.z = sin1 * Math.cos(tmpHRot1);
                        sun.x = sin1 * Math.sin(tmpHRot1);
			sun.y = sun.orbitRadius * Math.cos(tmpVRot1);

var tmpMoonCoords = SunCalc.getMoonPosition(new Date(year, (month-1), (day-1), 0, 0, currTime), 90, 0);
moon.vRot = tmpMoonCoords.altitude/angleFactor;
moon.hRot = -tmpMoonCoords.azimuth/angleFactor -(centerAroundSun ? 0 : 360)*currTime/86400;

}

function updateInfo(){

/*
mouseIdleCounter++;
if(mouseIdleCounter > 10){
$('*').css('cursor','none');
}
*/

var totalSec = Number(currTime.toFixed(0));
var hours = parseInt( totalSec / 3600 ) % 24;
var minutes = parseInt( totalSec / 60 ) % 60;
var seconds = totalSec % 60;

var timeOutput = (hours < 10 ? "0" + hours : hours) + ":" + (minutes < 10 ? "0" + minutes : minutes) + ":" + (seconds  < 10 ? "0" + seconds : seconds);

document.getElementById("currTime").innerHTML=timeOutput;

var tmpLat = rX;
var rocketRadius = 1;
if(rocketMode){
rocketRadius = Math.sqrt(rocket.x*rocket.x + rocket.y*rocket.y + rocket.z*rocket.z);
tmpLat = 90-Math.acos(rocket.y/rocketRadius)/angleFactor;
}

while(tmpLat > 180){tmpLat-=360;}
while(tmpLat < -180){tmpLat+=360;}
if(tmpLat > 90){tmpLat = 180-tmpLat;}
else if(tmpLat < -90){tmpLat = -180-tmpLat;}
var latDirection = "&deg; N";
if(tmpLat < 0){latDirection = "&deg; S";};

//Calculations for margin-bottom of greenDot 
var latDispMarginBottom = 0.333333*(tmpLat+90);
document.getElementById("greenDot").style.marginBottom=(latDispMarginBottom -1)*0.067+"vw";
document.getElementById("largeGreenDot").style.bottom=20 + latDispMarginBottom +"%";

tmpLat = Math.abs(tmpLat);
document.getElementById("currLat").innerHTML=Number((tmpLat).toFixed(1))+latDirection; 
var tmpLon = rY;
if(rocketMode){
tmpLon = -Math.atan2(rocket.x,rocket.z)/angleFactor;
}
if(centerAroundSun){
tmpLon += earthRotation+90;}
if(axisOrientation == -1){tmpLon += 180;}
while(tmpLon > 180){tmpLon -= 360;}
while(tmpLon < -180){tmpLon += 360;}
var lonDirection = "&deg; E";
if(tmpLon > 0){lonDirection = "&deg; W";};

//Calculations for margin-right of greenDot
document.getElementById("greenDot").style.marginRight=(121-0.333333*(180-tmpLon))*0.067+"vw";
var largeGreenDotRight = 92-0.222222*(180-tmpLon);
if(largeGreenDotRight > 90){largeGreenDotRight -= 80;}
document.getElementById("largeGreenDot").style.right=largeGreenDotRight +"%";

tmpLon = Math.abs(tmpLon);

document.getElementById("currLon").innerHTML=Number((tmpLon).toFixed(1))+lonDirection; 
document.getElementById("currHeight").innerHTML=Number((6378.1*((rocketMode ? rocketRadius-1 : userRadius-1))).toFixed(1)) + "km";

var innerSatelliteDots = "";

for(var i=0; i<satellitePositions.length; i++){
	if(isDrawingSatellite[i]){
	var satelliteDotBottom = (20 + 0.333333*(satellitePositions[i].vRot+90));
	var satelliteDotRight = (92-0.222222*((270+satellitePositions[i].hRot)%360));
	if(satelliteDotRight > 90){satelliteDotRight -= 80;}
	innerSatelliteDots+="<div class=\"largeDot\" style=\"bottom:"+satelliteDotBottom+"%;right:"+satelliteDotRight+"%;\">"+satellitePositions[i].name+"</div>";
	}

	$("#satelliteMenuLat"+i).html(getLatitudeFromVRot(satellitePositions[i].vRot));
	$("#satelliteMenuLon"+i).html(getLongitudeFromHRot(-(satellitePositions[i].hRot+90)));
}
$('#satelliteDots').html(innerSatelliteDots);

if(rocketMode){

document.getElementById("estimatedFuelCostValue").innerHTML="$"+Number(dollarsOfUsedFuel).toFixed(0).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	
}

}

function UrlExists(url)
{
    var http = new XMLHttpRequest();
    http.open('HEAD', url, false);
    http.send();
    return http.status!=404;
}

function getLatitudeFromVRot(tmpVRot){
var tmpLat = tmpVRot;

while(tmpLat > 180){tmpLat-=360;}
while(tmpLat < -180){tmpLat+=360;}
if(tmpLat > 90){tmpLat = 180-tmpLat;}
else if(tmpLat < -90){tmpLat = -180-tmpLat;}
var latDirection = "&deg; N";
if(tmpLat < 0){latDirection = "&deg; S";};

tmpLat = Math.abs(tmpLat);

return Number((tmpLat).toFixed(1))+latDirection; 
}

function getLongitudeFromHRot(tmpHRot){
var tmpLon = tmpHRot;
if(centerAroundSun){tmpLon += earthRotation+90;}
if(axisOrientation == -1){tmpLon += 180;}
while(tmpLon > 180){tmpLon -= 360;}
while(tmpLon < -180){tmpLon += 360;}
var lonDirection = "&deg; E";
if(tmpLon > 0){lonDirection = "&deg; W";};

tmpLon = Math.abs(tmpLon);

return Number((tmpLon).toFixed(1))+lonDirection;
}

var textureToggle=0;
function updateEarthTexture(){ //Incorporate selected date with the earth textures here
if(selectedDate != currDate){ //If a new day has been selected

	selectedDate = currDate;

	var totalSec = Number(currTime.toFixed(0));
	var hours = parseInt( totalSec / 3600 ) % 24;

	//Get a new inclination value for the sun
	if(year < 1000){year += 2000;}
	var dateOfYear = new Date(year, (month-1), day);
	var startOfYear = new Date(year, 0, 0);
	var diff = dateOfYear - startOfYear;
	var dayOfYear = Math.round(diff / 86400000);

	sunInclination = -23.45*Math.sin(0.98630137*(dayOfYear-81)*angleFactor);
	sun.vRot = sunInclination;

	var tmpYear = year - 2000;
	while(tmpYear > 100){
		tmpYear-= 100;
	}
	if(tmpYear == 0){
		tmpYear = "00";
	}
	else if(tmpYear < 10){
		tmpYear = "0"+tmpYear;
	}

	//Change the texture
	if(hours < 10){hours = "0" + hours;}

	getEarthTexture(tmpYear, dayOfYear, hours);
	getCloudTexture(tmpYear, dayOfYear, hours);
	getTerminatorTexture(dayOfYear);

	ajaxSetup();

	if(maxTextureSize < 4096){
		initTextures(earth, "./earthTextures/earth.png", true);
		alert("Could not load earth texture, exceeds maximum texture size");
	}

}
}

function strip(html)
{
   var tmp = document.createElement("DIV");
   tmp.innerHTML = html;
   return tmp.textContent || tmp.innerText || "";
}

function setTime(){
        currTime = 3600 * Number($("#setHourDisplay").html()) + 60 * Number($("#setMinuteDisplay").html()) + Number($("#setSecondDisplay").html());
	movingSatelliteCounter=3.33333*currTime;
	initSatellitePositions();

	//Update the Earth Texture//
	var totalSec = Number(currTime.toFixed(0));
        var hours = parseInt( totalSec / 3600 ) % 24;

	var dateOfYear = new Date(year, (month-1), day);
        var startOfYear = new Date(year, 0, 0);
        var diff = dateOfYear - startOfYear;
        var dayOfYear = Math.round(diff / 86400000);

        var tmpYear = year - 2000;
        while(tmpYear > 100){
                tmpYear-= 100;
        }
        if(tmpYear == 0){
                tmpYear = "00";
        }
        else if(tmpYear < 10){
                tmpYear = "0"+tmpYear;
        }

        //Change the texture
        if(hours < 10){hours = "0" + hours;}
	getEarthTexture(tmpYear, dayOfYear, hours);
	getCloudTexture(tmpYear, dayOfYear, hours);

}

function getTimeFromImageFilename(tmpImageFilename){
var timeOfImageFilenameOffset = 0;
if(maxTextureSize < 8192 || selectLowResTexture){timeOfImageFilenameOffset=3; }

var tmpEarthTextureDate = new Date(Number("20"+tmpImageFilename.substring(14+timeOfImageFilenameOffset, 16+timeOfImageFilenameOffset)), 0, tmpImageFilename.substring(16+timeOfImageFilenameOffset,19+timeOfImageFilenameOffset));
$("#timeOfEarthImage").html(monthNames[tmpEarthTextureDate.getUTCMonth()]+" "+tmpEarthTextureDate.getUTCDate()+", "+tmpEarthTextureDate.getUTCFullYear()+" - "+tmpImageFilename.substring(20+timeOfImageFilenameOffset,22+timeOfImageFilenameOffset)+":"+tmpImageFilename.substring(22+timeOfImageFilenameOffset)+" UTC");
}

function initSatellitePositions(){
		var maxCounter = lerpTime*futureSatelliteOrbitRadius[0].length;
                var index = Math.floor(movingSatelliteCounter / lerpTime);
                var nextIndex = (index+1)%futureSatelliteOrbitRadius[0].length;
                var lerpCounter = movingSatelliteCounter%lerpTime;
                var bFactor = lerpCounter/lerpTime;
		var aFactor = 1 - bFactor;

		earthRotation = 0.0042*currTime;

//		currTime = aFactor*futureSatelliteTime[index] + bFactor*futureSatelliteTime[nextIndex];
                for(var i=0; i<satellitePositions.length; i++){
                        var bFactor = lerpCounter/lerpTime;
			var aFactor = 1 - bFactor;
        
                        var tmpVRot1 = (90-futureSatellitevRot[i][index])*angleFactor;
                        var tmpHRot1 = futureSatellitehRot[i][index]*angleFactor;
                        var tmpVRot2 = (90-futureSatellitevRot[i][nextIndex])*angleFactor;
                        var tmpHRot2 = futureSatellitehRot[i][nextIndex]*angleFactor;
                        var sin1 = futureSatelliteOrbitRadius[i][index] * Math.sin(tmpVRot1);
                        var sin2 = futureSatelliteOrbitRadius[i][nextIndex] * Math.sin(tmpVRot2);
                        var tmpZ = sin1 * Math.cos(tmpHRot1);
                        var tmpX = sin1 * Math.sin(tmpHRot1);
                        var tmpY = futureSatelliteOrbitRadius[i][index] * Math.cos(tmpVRot1);
                        var tmpZ2 = sin2 * Math.cos(tmpHRot2);
                        var tmpX2 = sin2 * Math.sin(tmpHRot2);
                        var tmpY2 = futureSatelliteOrbitRadius[i][nextIndex] * Math.cos(tmpVRot2);
                        
                        var tmpX3 = aFactor*tmpX + bFactor*tmpX2;
                        var tmpY3 = aFactor*tmpY + bFactor*tmpY2;
                        var tmpZ3 = aFactor*tmpZ + bFactor*tmpZ2;

			satellitePositions[i].x = tmpX3;
                        satellitePositions[i].y = tmpY3;
                        satellitePositions[i].z = tmpZ3;
                        
                        var finalRadius = Math.sqrt(tmpX3*tmpX3 + tmpY3*tmpY3 + tmpZ3*tmpZ3);
                        var finalLat = 90-Math.acos(tmpY3/finalRadius)/angleFactor;
                        var finalLon = Math.atan2(tmpX3,tmpZ3)/angleFactor; 

                        satellitePositions[i].orbitRadius = finalRadius;
                        satellitePositions[i].hRot = finalLon;
                        satellitePositions[i].vRot = finalLat;
			satellitePositions[i].orbitRadius = aFactor*futureSatelliteOrbitRadius[i][index] + bFactor*futureSatelliteOrbitRadius[i][nextIndex];
                }
}

var rocketQuaternion = new Array();
rocketQuaternion[0] = 0;
rocketQuaternion[1] = 0;
rocketQuaternion[2] = 0;
rocketQuaternion[3] = 1;

function normalizeQuaternion(quat){
	var mag2 = quat[0] * quat[0] + quat[1] * quat[1] + quat[2] * quat[2] + quat[3] * quat[3];

	var tmpQuat = quat;
		var mag = sqrt(mag2);
		tmpQuat[0] /= mag;
		tmpQuat[1] /= mag;
		tmpQuat[2] /= mag;
		tmpQuat[3] /= mag;

	return tmpQuat;
}

function rotateQuaternion(quat, normAxis, angle){

	var sinAngle = Math.sin(angle*angleFactor/2);
 
	var tmpQuat = quat;

	tmpQuat[0] = (normAxis[0] * sinAngle);
	tmpQuat[1] = (normAxis[1] * sinAngle);
	tmpQuat[2] = (normAxis[2] * sinAngle);
	tmpQuat[3] = Math.cos(angle*angleFactor/2);

	return tmpQuat;
}

//function getQuaternionAxisAngle()

function rotateQuaternionEuler(quat, pitch, yaw, roll){
 
	var p = pitch*angleFactor/2;
	var y = yaw*angleFactor/2;
	var r = roll*angleFactor/2;

	var sinp = Math.sin(p);
	var siny = Math.sin(y);
	var sinr = Math.sin(r);
	var cosp = Math.cos(p);
	var cosy = Math.cos(y);
	var cosr = Math.cos(r);
 
	var tmpQuat = quat;
	tmpQuat[0] = sinr * cosp * cosy - cosr * sinp * siny;
	tmpQuat[1] = cosr * sinp * cosy + sinr * cosp * siny;
	tmpQuat[2] = cosr * cosp * siny - sinr * sinp * cosy;
	tmpQuat[3] = cosr * cosp * cosy + sinr * sinp * siny;

	tmpQuat = normalizeQuaternion(tmpQuat);

	return tmpQuat;
}


function fireBullet(){
	if(bullets.length < 50){
		bullets.push({x:rocket.x, y:rocket.y, z:rocket.z, lifetime:100, age:0, delX: 0.1*rocketDelX,delY: 0.1*rocketDelY,delZ: 0.1*rocketDelZ});
	}
}

var rocketForwardDirection = [0,0,1];

var rocketDelX;
var rocketDelY;
var rocketDelZ;
function moveRocket(){
	if(rocketMode){
var rotateFactor = rocket.velocity/0.003;

var delRotX = rotateFactor*(2*prevMouseY/window.innerHeight - 1);
var delRotY = rotateFactor*5*(2*prevMouseX/window.innerWidth - 1);
var delRotZ = 0;

if(wPressed){


///////////////////////////////////////////////

if(!rocketExploding){
rocket.rotX -= delRotX;
while(rocket.rotX < 0){rocket.rotX += 360;}
while(rocket.rotX > 360){rocket.rotX -= 360;}

var rocketInvertAxis = 1;
if(rocket.rotX > 90 && rocket.rotX < 270){
rocketInvertAxis = -1;
}
rocket.rotY -= rocketInvertAxis*delRotY;
while(rocket.rotY < 0){rocket.rotY += 360;}
while(rocket.rotY > 360){rocket.rotY -= 360;}
}
}

	if(!rocketExploding){

/*
	var tmpAngX = -rocket.rotX * angleFactor;
	var tmpAngY = rocket.rotY * angleFactor;
	var tmpAngZ = 0 * angleFactor;

	var z = rocketForwardDirection;
	var sX = Math.sin(tmpAngX);
	var cX = Math.cos(tmpAngX);
	var sY = Math.sin(tmpAngY);
	var cY = Math.cos(tmpAngY);
	var sZ = Math.sin(tmpAngZ);
	var cZ = Math.cos(tmpAngZ);

	var cYz0 = cY*z[0];
	var sYz2 = sY*z[2];
	var sYz0 = sY*z[0];
	var cYz2 = cY*z[2];
	var cZz1 = cZ*z[1];
	var cYz2 = cY*z[2];
	var sZz1 = sZ*z[1];

	var rotatedZ = [cZ*(cYz0 + sYz2) - sZz1, cX*(sZ*(cYz0+sYz2)+cZz1) + sX*(sYz0-cYz2), sX*(sZ*(cYz0+sYz2)+cZz1) + cX*(-sYz0 + cYz2)];
*/
//	rocketForwardDirection = rotatedZ;
/*
	var q = new THREE.Quaternion(); 
	q.setFromAxisAngle( new THREE.Vector3( 1, 0, 0 ), rocket.rotX * angleFactor);
	q.setFromAxisAngle( new THREE.Vector3( 0, 1, 0 ), rocket.rotY * angleFactor); 

	var vector = [0,0,0];
	vector[0] = Math.atan2(2*(q.w*q.x + q.y*q.z), 1-2*(q.x*q.x + q.y*q.y));
	vector[1] = Math.asin(2*(q.w*q.y - q.z*q.x));
	vector[2] = Math.atan2(2*(q.w*q.z + q.x*q.y), 1-2*(q.y*q.y + q.z*q.z));

	alert(vector[0] + ", " + vector[1] + ", " + vector[2]);
*/

	var tmpRotX = rocket.rotX * angleFactor;
	var tmpRotY = rocket.rotY * angleFactor;
	var tmpCosX = Math.cos(tmpRotX);

	rocketDelX = Math.sin(tmpRotY)*tmpCosX;
	rocketDelY = Math.sin(tmpRotX);
	rocketDelZ = Math.cos(tmpRotY)*tmpCosX;

	var delX = rocket.velocity*rocketDelX;
	var delY = rocket.velocity*rocketDelY;
	var delZ = rocket.velocity*rocketDelZ;

	rocket.x += delX;//rocket.velocity*rotatedZ[0];//delX;	
	rocket.z += delZ;//rocket.velocity*rotatedZ[2];//delZ;
	rocket.y += delY;//rocket.velocity*rotatedZ[1];//delY;
	}

	//Calculations for adding shadows to satellites when light is blocked by Earth
                        var r_p_2 = sun.x*sun.x + sun.y*sun.y + sun.z*sun.z;
                        var r_q_2 = rocket.x*rocket.x + rocket.y*rocket.y + rocket.z*rocket.z;
                        var pDotQ = (centerAroundSun ? sun.orbitRadius*rocket.x  : sun.x*(-rocket.z) + sun.y*rocket.y + sun.z*rocket.x);
                        var tmpCoefA = r_p_2 + r_q_2 - 2*pDotQ;
                        var tmpCoefB = pDotQ - r_p_2;
                        var tmpCoefC = Math.sqrt((tmpCoefB*tmpCoefB) - tmpCoefA*(r_p_2 - 1))/tmpCoefA;
                        var tmpCoefD = -(tmpCoefB/tmpCoefA);
                        var tmpValT1 = tmpCoefD + tmpCoefC;
                        var tmpValT2 = tmpCoefD - tmpCoefC;

                        if((tmpValT1 < 1 && tmpValT1 > 0) || (tmpValT2 < 1 && tmpValT2 > 0)){
                                if(satelliteInShadow[999999] < 0.7){
                                satelliteInShadow[999999] +=0.1;
                                        if(satelliteInShadow[999999] > 0.7){satelliteInShadow[999999] = 0.7;}
                                }
                        }
                        else{
                                if(satelliteInShadow[999999] > 0){
                                satelliteInShadow[999999] -=0.1;
                                        if(satelliteInShadow[999999] < 0){satelliteInShadow[999999] = 0;}
                                }
                                else{
                                        satelliteInShadow[999999] = 0;
                                }
                        }

	var tmpRocketRadius = Math.sqrt(r_q_2);
	if(tmpRocketRadius < 1){
		rocketExploding = true;
		rocketExplodingCounter++;
		rocket.velocity = 0;
		if(rocketExplodingCounter > 100){
			rocket.x = -1;
			rocket.y = 0;
			rocket.z = -1;
			dollarsOfUsedFuel += 450000000;
			rocketExploding = false;
			rocketExplodingCounter = 0;
		}
	}
	else if(!realSize){
		if(rocketExploding){
                	rocketExplodingCounter++;
	                if(rocketExplodingCounter > 100){
        	                rocket.x = -1;
                	        rocket.y = 0;
                        	rocket.z = -1;
	                        dollarsOfUsedFuel += 850000000;
        	                rocketExploding = false; 
                	        rocketExplodingCounter = 0;
	                }
		}
		else{
		var rocketSatelliteCollisionBound = 0.012;
		for(var i=0; i<satellitePositions.length; i++){
			if(Math.abs(rocket.x-satellitePositions[i].z) < rocketSatelliteCollisionBound
			&& Math.abs(rocket.y-satellitePositions[i].y) < rocketSatelliteCollisionBound
			&& Math.abs(rocket.z+satellitePositions[i].x) < rocketSatelliteCollisionBound){
				rocketExploding = true;
                		rocketExplodingCounter++;
				rocket.velocity = 0;
			}
		}	

		}
	}

	if(!rocketExploding){
		var rocketMeteorCollisionBound = 0.1;
		for(var i=0; i<meteors.length; i++){

                        if(Math.abs(rocket.x-meteors[i].x) < rocketMeteorCollisionBound
                        && Math.abs(rocket.y-meteors[i].y) < rocketMeteorCollisionBound
                        && Math.abs(rocket.z-meteors[i].z) < rocketMeteorCollisionBound){
                                rocketExploding = true;
                                rocketExplodingCounter++;
                                rocket.velocity = 0;
				if(!meteors[i].exploding){
					meteors[i].exploding=true;
					numMeteorsDestroyed++;
					$("#meteorsDestroyed").html(numMeteorsDestroyed);
				}
                        }
			
			for(var j=0; j<bullets.length; j++){
				if(Math.abs(bullets[j].x-meteors[i].x) < rocketMeteorCollisionBound
        	                && Math.abs(bullets[j].y-meteors[i].y) < rocketMeteorCollisionBound
	                        && Math.abs(bullets[j].z-meteors[i].z) < rocketMeteorCollisionBound){
					if(!meteors[i].exploding){
	        	                        meteors[i].exploding=true;
						numMeteorsDestroyed++;
						$("#meteorsDestroyed").html(numMeteorsDestroyed);
					}
					bullets.splice(j,1);
					j+=bullets.length+5;
	                        }
			}

                }
	}

	//Gravity calculations

        if(tmpRocketRadius > 1){
        var gravityVel = 0.015*Math.sqrt(800000/(6378.1*(tmpRocketRadius-1)))/6378.1;
	var delGravX = gravityVel * Math.sin(Math.atan2(rocket.x, 1));
	var delGravY = gravityVel * Math.sin(Math.atan2(rocket.y, 1));
	var delGravZ = gravityVel * Math.sin(Math.atan2(rocket.z, 1));
        rocket.y -= delGravY;
        rocket.x -= delGravX;
        rocket.z -= delGravZ;

//	var tmpMagX = delX - delGravX;
//	var tmpMagY = delY - delGravY;
//	var tmpMagZ = delZ - delGravZ;

//	rocket.velocity = Math.sqrt(tmpMagX*tmpMagX + tmpMagY*tmpMagY + tmpMagZ*tmpMagZ);
//	rocket.rotX = Math.atan2(tmpMagX, 1);
//	rocket.rotY = Math.atan2(tmpMagZ, 1)/angleFactor;
	
        }

        }
        else{
        rocket.velocity = 0;
        }
	//End gravity calculations//

}

var prevIndex=-1;
function lerpSatellitePositions(){
	if(playInRealtime){
		tmpDate = new Date();
		currTime=Number((tmpDate.getUTCHours()*3600+ tmpDate.getUTCMinutes()*60 + tmpDate.getUTCSeconds() + (tmpDate.getUTCMilliseconds()/1000)));
	        movingSatelliteCounter=3.33333*currTime;
		earthRotation = 0.0042*(tmpDate.getUTCSeconds() + 60*tmpDate.getUTCMinutes() + 3600*tmpDate.getUTCHours());
	}

	var satelliteSpeedFactor = $('#sliderSatellite').slider("option", "value");
	satelliteSpeedFactor = satelliteSpeedFactor / 100;
	satelliteSpeedFactor = Math.pow(10, satelliteSpeedFactor);
	if(moveSatellite){

		var maxCounter = lerpTime*futureSatelliteOrbitRadius[0].length;
		var index = Math.floor(movingSatelliteCounter / lerpTime);
		var nextIndex = (index+1)%futureSatelliteOrbitRadius[0].length;
		var lerpCounter = movingSatelliteCounter%lerpTime;
                var bFactor = lerpCounter/lerpTime;
		var aFactor = 1 - bFactor;

		if(nextIndex == 0 && index == futureSatelliteOrbitRadius[0].length-1){
			if(playInReverse){
				$("#loopingAlert").show();$("#loopingAlert").html("<table style=\"width:100%;height:100%;background:transparent;opacity:0.5;\"><tr><th style=\"background:#4700b2;color:white;\">Looping Back to End of Day</th></tr></table>");
			}
			else{
				$("#loopingAlert").show();$("#loopingAlert").html("<table style=\"width:100%;height:100%;background:transparent;opacity:0.5;\"><tr><th style=\"background:#4700b2;color:white;\">Looping Back to Start of Day</th></tr></table>");
			}
		}
		else{
			$("#loopingAlert").hide();
		}

                if(cinematicMode){
			if(prevIndex != index){
				var randView = Math.random();
				if(randView < 0.05){
					satelliteViewType = 0 + (satelliteViewType==0);
				}
				else if(randView < 0.1){
					satelliteViewType = 1 + (satelliteViewType==1);
                                }
				else if(randView < 0.15){
                                        satelliteViewType = 2 + (satelliteViewType==2);
                                }
                                else if(randView < 0.2){
                                        satelliteViewType = 3 - (satelliteViewType==3);
                                }
                                else if(randView < 0.4){
                                        satelliteViewType = 5 + (satelliteViewType==5);
                                }
                                else if(randView < 0.6){
                                        satelliteViewType = 6 + (satelliteViewType==6);
                                }
                                else if(randView < 0.8){
                                        satelliteViewType = 7 + (satelliteViewType==7);
                                }
				else{
					satelliteViewType = 8 - (satelliteViewType==8);
				}
				prevIndex = index;
			}
                }

		currTime = aFactor*futureSatelliteTime[index] + bFactor*futureSatelliteTime[nextIndex];
		for(var i=0; i<satellitePositions.length; i++){
			var bFactor = lerpCounter/lerpTime;
			var aFactor = 1 - bFactor;
	
			var tmpVRot1 = (90-futureSatellitevRot[i][index])*angleFactor;
			var tmpHRot1 = futureSatellitehRot[i][index]*angleFactor;
			var tmpVRot2 = (90-futureSatellitevRot[i][nextIndex])*angleFactor;
			var tmpHRot2 = futureSatellitehRot[i][nextIndex]*angleFactor;
			var sin1 = futureSatelliteOrbitRadius[i][index] * Math.sin(tmpVRot1);
			var sin2 = futureSatelliteOrbitRadius[i][nextIndex] * Math.sin(tmpVRot2);
			var tmpZ = sin1 * Math.cos(tmpHRot1);
			var tmpX = sin1 * Math.sin(tmpHRot1);
			var tmpY = futureSatelliteOrbitRadius[i][index] * Math.cos(tmpVRot1);
			var tmpZ2 = sin2 * Math.cos(tmpHRot2);
                        var tmpX2 = sin2 * Math.sin(tmpHRot2);
                        var tmpY2 = futureSatelliteOrbitRadius[i][nextIndex] * Math.cos(tmpVRot2);
			
			var tmpX3 = aFactor*tmpX + bFactor*tmpX2;
			var tmpY3 = aFactor*tmpY + bFactor*tmpY2;
			var tmpZ3 = aFactor*tmpZ + bFactor*tmpZ2;

			satellitePositions[i].x = tmpX3;
		        satellitePositions[i].y = tmpY3;
		        satellitePositions[i].z = tmpZ3;

			//Calculations for adding shadows to satellites when light is blocked by Earth	
			var r_p_2 = sun.x*sun.x + sun.y*sun.y + sun.z*sun.z;
			var r_q_2 = tmpX3*tmpX3 + tmpY3*tmpY3 + tmpZ3*tmpZ3;
			var pDotQ = sun.x*tmpX3 + sun.y*tmpY3 + sun.z*tmpZ3;
			var tmpCoefA = r_p_2 + r_q_2 - 2*pDotQ;
			var tmpCoefB = pDotQ - r_p_2;
			var tmpCoefC = Math.sqrt((tmpCoefB*tmpCoefB) - tmpCoefA*(r_p_2 - 1))/tmpCoefA;
			var tmpCoefD = -(tmpCoefB/tmpCoefA);
			var tmpValT1 = tmpCoefD + tmpCoefC;
			var tmpValT2 = tmpCoefD - tmpCoefC;

			if((tmpValT1 < 1 && tmpValT1 > 0) || (tmpValT2 < 1 && tmpValT2 > 0)){
				if(satelliteInShadow[i] < 0.7){
				satelliteInShadow[i] +=0.1;
					if(satelliteInShadow[i] > 0.7){satelliteInShadow[i] = 0.7;}
				}
			}
			else{
				if(satelliteInShadow[i] > 0){
				satelliteInShadow[i] -=0.1;
					if(satelliteInShadow[i] < 0){satelliteInShadow[i] = 0;}
				}
				else{
					satelliteInShadow[i] = 0;
				}
			}
	
			


			if(i == satelliteToFollow){
			currSatelliteCartesianY = tmpY3;
			currSatelliteCartesianX = tmpZ3;
			currSatelliteCartesianZ = -tmpX3;

				if(satelliteViewType == 6){
			var cinematicPosition1Y = (futureSatelliteOrbitRadius[i][nextIndex]+0.5) * Math.cos(tmpVRot2);
			var cinematicPosition1X = (futureSatelliteOrbitRadius[i][nextIndex]+0.5) * Math.sin(tmpVRot2) * Math.cos(tmpHRot2);
			var cinematicPosition1Z = -(futureSatelliteOrbitRadius[i][nextIndex]+0.5) * Math.sin(tmpVRot2) * Math.sin(tmpHRot2);

			var x2=cinematicPosition1X-currSatelliteCartesianX;
			var y2=cinematicPosition1Y-currSatelliteCartesianY;
			var z2=cinematicPosition1Z-currSatelliteCartesianZ;

			cinematicPosition1Radius = Math.sqrt(x2*x2 + y2*y2 + z2*z2);
                        cinematicPosition1rX = 90-Math.acos(y2/cinematicPosition1Radius)/angleFactor;
                        cinematicPosition1rY = Math.atan2(x2,z2)/angleFactor;
				}
				else if(satelliteViewType == 7){
                        var cinematicPosition1Y = (futureSatelliteOrbitRadius[i][index]+0.5) * Math.cos(tmpVRot1);
                        var cinematicPosition1X = (futureSatelliteOrbitRadius[i][index]+0.5) * Math.sin(tmpVRot1) * Math.cos(tmpHRot1);
                        var cinematicPosition1Z = -(futureSatelliteOrbitRadius[i][index]+0.5) * Math.sin(tmpVRot1) * Math.sin(tmpHRot1);
                        var x2=cinematicPosition1X-currSatelliteCartesianX;
                        var y2=cinematicPosition1Y-currSatelliteCartesianY;
                        var z2=cinematicPosition1Z-currSatelliteCartesianZ;

                        cinematicPosition2Radius = Math.sqrt(x2*x2 + y2*y2 + z2*z2);
                        cinematicPosition2rX = 90-Math.acos(y2/cinematicPosition2Radius)/angleFactor;
                        cinematicPosition2rY = Math.atan2(x2,z2)/angleFactor;
			
                                }
				else if(satelliteViewType == 8){
                        var cinematicPosition1Y = (futureSatelliteOrbitRadius[i][nextIndex] + 0.05) * Math.cos(tmpVRot2);
                        var cinematicPosition1X = (futureSatelliteOrbitRadius[i][nextIndex] + 0.05) * Math.sin(tmpVRot2) * Math.cos(tmpHRot2);
                        var cinematicPosition1Z = -(futureSatelliteOrbitRadius[i][nextIndex] + 0.05) * Math.sin(tmpVRot2) * Math.sin(tmpHRot2);

                        var x2=cinematicPosition1X-currSatelliteCartesianX;
                        var y2=cinematicPosition1Y-currSatelliteCartesianY;
                        var z2=cinematicPosition1Z-currSatelliteCartesianZ;

                        cinematicPosition3Radius = Math.sqrt(x2*x2 + y2*y2 + z2*z2);
                        cinematicPosition3rX = 90-Math.acos(y2/cinematicPosition3Radius)/angleFactor;
                        cinematicPosition3rY = Math.atan2(x2,z2)/angleFactor;
                                }
			}
			
			var finalRadius = Math.sqrt(tmpX3*tmpX3 + tmpY3*tmpY3 + tmpZ3*tmpZ3);
			var finalLat = 90-Math.acos(tmpY3/finalRadius)/angleFactor;
			var finalLon = Math.atan2(tmpX3,tmpZ3)/angleFactor; 

			var tmpFinalLat = finalLat*angleFactor;
			var tmpVRot = satellitePositions[i].vRot*angleFactor;
			var tmpLonDiff = (finalLon - satellitePositions[i].hRot)*angleFactor;
			var tmpFinalLatCos = Math.cos( tmpFinalLat );

			var tmpBearingY = Math.sin( tmpLonDiff ) * tmpFinalLatCos;
                        var tmpBearingX = Math.cos( tmpVRot  ) * Math.sin( tmpFinalLat  ) - 
                                Math.sin( tmpVRot  ) * tmpFinalLatCos * Math.cos( tmpLonDiff  );

                        satelliteForwardRotations[i] = 0;
                        if(satellitePositions[i].orbitRadius <= 2){
                        satelliteForwardRotations[i] = (playInReverse ? 180 : 0) + Math.atan2(tmpBearingY, tmpBearingX)/angleFactor;
                        }


			satellitePositions[i].orbitRadius = finalRadius;
			satellitePositions[i].hRot = finalLon;
			satellitePositions[i].vRot = finalLat;
			satellitePositions[i].orbitRadius = aFactor*futureSatelliteOrbitRadius[i][index] + bFactor*futureSatelliteOrbitRadius[i][nextIndex];
		}
		if(!playInReverse){
		movingSatelliteCounter+=10*satelliteSpeedFactor;
		}
		else{
		movingSatelliteCounter-=10*satelliteSpeedFactor;
			if(movingSatelliteCounter < 0){
				movingSatelliteCounter += maxCounter;
			}
		}
		movingSatelliteCounter%=maxCounter;

		if(!playInRealtime){
			earthRotation = earthRotation = 0.0042*currTime;
		}
	}	
}

function followingSatellite(index){

if(followSatellite){
var hRot = satellitePositions[index].hRot;
if(centerAroundSun){hRot += earthRotation;}
var vRot = satellitePositions[index].vRot;
userRadius = satellitePositions[index].orbitRadius;
if(tourMode && tourTransition){
        var bFactor = tourTransitionCounter/tourTransitionInterval;
	var aFactor = 1 - bFactor;

	var nextIndex = (index+1)%satellitePositions.length;

	var tmpVRot1 = (90-satellitePositions[index].vRot)*angleFactor;
        var tmpHRot1 = satellitePositions[index].hRot*angleFactor;
        var tmpVRot2 = (90-satellitePositions[nextIndex].vRot)*angleFactor;
        var tmpHRot2 = satellitePositions[nextIndex].hRot*angleFactor;
        var sin1 = satellitePositions[index].orbitRadius * Math.sin(tmpVRot1);
        var sin2 = satellitePositions[nextIndex].orbitRadius * Math.sin(tmpVRot2);
        var tmpZ = sin1 * Math.cos(tmpHRot1);
        var tmpX = sin1 * Math.sin(tmpHRot1);
        var tmpY = satellitePositions[index].orbitRadius * Math.cos(tmpVRot1);
        var tmpZ2 = sin2 * Math.cos(tmpHRot2);
        var tmpX2 = sin2 * Math.sin(tmpHRot2);
        var tmpY2 = satellitePositions[nextIndex].orbitRadius * Math.cos(tmpVRot2);
                        
        var tmpX3 = aFactor*tmpX + bFactor*tmpX2;
        var tmpY3 = aFactor*tmpY + bFactor*tmpY2;
        var tmpZ3 = aFactor*tmpZ + bFactor*tmpZ2;

	var finalRadius = Math.sqrt(tmpX3*tmpX3 + tmpY3*tmpY3 + tmpZ3*tmpZ3);
        var finalLat = 90-Math.acos(tmpY3/finalRadius)/angleFactor;
        var finalLon = Math.atan2(tmpX3,tmpZ3)/angleFactor;

	hRot = finalLon;
	if(centerAroundSun){hRot += earthRotation;}
	vRot = finalLat;
	userRadius = finalRadius;
	userRadius = aFactor*satellitePositions[index].orbitRadius + bFactor*satellitePositions[nextIndex].orbitRadius;
}

rY = -(90 + hRot);
if(rY < -180){rY += 360;}
else if(rY > 180){rY -= 360;}
rX = vRot;
}

}


function rotateSpinnerSatellites(){
  if(moveSatellite){
        satelliteSpinnerRotationCounter+=8.7;
        satelliteSpinnerRotationCounter%=360;
  }
}

function tourModeCalculationsForDrawFunction(){
	if(tourMode){
                tourCounter++;

                if(tourCounter >= tourInterval - tourTransitionInterval && tourCounter < tourInterval){ //if transitioning between satellites
			if(tourCounter%10 == 0){
				tourTransitionInterval = 240 + 1.2*Number($('#sliderTourTransition').slider('option', 'value'));
                	        tourInterval = 280 + 1.4*Number($('#sliderTourInterval').slider('option', 'value')) + tourTransitionInterval;
        	                updateHashLink('tourInterval', $('#sliderTourInterval').slider('option', 'value'));
	                        updateHashLink('tourTransition', $('#sliderTourTransition').slider('option', 'value'));
			}
			
                        if(tourModeRealtime){
                                tmpDate = new Date();
                                currTime = Number((tmpDate.getUTCHours()*3600+ tmpDate.getUTCMinutes()*60 + tmpDate.getUTCSeconds()).toFixed(0));
                                movingSatelliteCounter=3.33333*currTime;
                                initSatellitePositions();
                        }

                        tourTransition = true;
                        if(tourTransitionCounter < tourTransitionInterval){
                                tourTransitionCounter++;
                        }
                }
                else{ //if not transitioning
			if(tourCounter%10 == 0){
                                tourTransitionInterval = 240 + 1.2*Number($('#sliderTourTransition').slider('option', 'value'));
                                tourInterval = 280 + 1.4*Number($('#sliderTourInterval').slider('option', 'value')) + tourTransitionInterval;
                                updateHashLink('tourInterval', $('#sliderTourInterval').slider('option', 'value'));
                                updateHashLink('tourTransition', $('#sliderTourTransition').slider('option', 'value'));
                        }			

                        tourTransitionCounter = 0;
                        tourTransition = false;
                }       
                if(tourCounter >= tourInterval){ //if the tour stop is done
                        tourTransitionInterval = 240 + 1.2*Number($('#sliderTourTransition').slider('option', 'value'));
                        tourInterval = 280 + 1.4*Number($('#sliderTourInterval').slider('option', 'value')) + tourTransitionInterval;
                        updateHashLink('tourInterval', $('#sliderTourInterval').slider('option', 'value'));
                        updateHashLink('tourTransition', $('#sliderTourTransition').slider('option', 'value'));

                        tourCounter = 0;
                        satelliteToFollow++;
                        satelliteToFollow %= satellitePositions.length;
                        document.getElementById("satelliteBeingFollowed").innerHTML=satellitePositions[satelliteToFollow].name;
                        document.getElementById("satelliteBeingFollowedFlag").style.backgroundImage="url("+satelliteFlags[satelliteToFollow%satelliteFlags.length]+")";

			for(var i=0; i<satellitePositions.length; i++){
			        $("#satelliteFollowToggle"+i+"").css({color:'white'});
		        }
		        $("#satelliteFollowToggle"+satelliteToFollow+"").css({color:'skyblue'});


                        if(tourModeRealtime){
                                tmpDate = new Date();
                                currTime = Number((tmpDate.getUTCHours()*3600+ tmpDate.getUTCMinutes()*60 + tmpDate.getUTCSeconds()).toFixed(0));
                                movingSatelliteCounter=3.33333*currTime;
                                initSatellitePositions();
                        }

                }
        }
}

function aimCameraInDrawFunction(){
  if(rocketMode){
	mvTranslate([0,(realSize ? -0.000000418 : -0.01),(realSize ? -0.00000209  : -0.05)]);
	mvRotate(-90, [1,0,0]);
	mvRotate(90, [0,1,0]);
	if(debugMode){drawLines(xyzAxis,0,0,0,90,.25,.25,.25);}
	var realSizeFactor = (realSize ? 1/23900 : 1);
	if(!rocketExploding){drawSatellite(rocket,0,0,0,90,realSizeFactor,realSizeFactor,realSizeFactor,999999);}
	else{
		var tmpRocketExplodingScale = realSizeFactor*rocketExplodingCounter/3200;
		drawSphere(explosion,0,0,0,90,tmpRocketExplodingScale,tmpRocketExplodingScale,tmpRocketExplodingScale);
	}

	if(rocket.velocity > 0 && wPressed){
		var tmpRandAngle = Math.random();
		if(tmpRandAngle < 0.25){
		tmpRandAngle = 0;
		}
		else if(tmpRandAngle < 0.5){
		tmpRandAngle = 90;
                }
		else if(tmpRandAngle < 0.75){
		tmpRandAngle = 180;
                }
		else{
		tmpRandAngle = 270;
		}
		
	mvRotate(tmpRandAngle, [0,1,0]);
	gl.enable(gl.BLEND);
	gl.blendFunc(gl.SRC_ALPHA, gl.ONE_MINUS_SRC_ALPHA);
	if(!rocketExploding){drawSphere(rocketFlames,0,0,0,90,realSizeFactor,realSizeFactor*((rocket.velocity/0.003)*(5+2*Math.random()) + 1),realSizeFactor);}
	gl.disable(gl.BLEND);
	mvRotate(-tmpRandAngle, [0,1,0]);
	}
	mvRotate(-90, [0,1,0]);
	mvRotate(90, [1,0,0]);
	
	mvRotate(-rocket.rotX, [1,0,0]);
	mvRotate(180-rocket.rotY, [0,1,0]);
	mvTranslate([-rocket.x, -rocket.y, -rocket.z]);
  }
  else if(followSatellite && satelliteFreeMode){
	mvTranslate([0,0,-(realSize ? 0.0001 : 0.1)]);
        mvRotate(satelliteFreeModeRX, [1,0,0]);
        mvRotate(satelliteFreeModeRY, [0,1,0]);
        mvTranslate([-currSatelliteCartesianX, -currSatelliteCartesianY, -currSatelliteCartesianZ]);
  }
  else if(followSatellite && satelliteViewType==0){ //directly in front of satellite
        mvTranslate([0,0,-userRadius+0.05]);
        mvRotate(rX, [1,0,0]);
        mvRotate(rY, [0,1,0]);
  }
  else if(followSatellite && satelliteViewType==1){ //directly behind satellite
        mvTranslate([0,0,-userRadius-(realSize ? 0.00005 : 1)]);
        mvRotate(rX, [1,0,0]);
        mvRotate(rY, [0,1,0]);
  }
  else if(followSatellite && satelliteViewType==2){ //behind and slightly above satellite
        mvTranslate([0,0,-userRadius-0.25]);
        mvRotate(rX + 0.25, [1,0,0]);
        mvRotate(rY, [0,1,0]);
  }
  else if(followSatellite && satelliteViewType==3){ //behind and slightly below satellite
        mvTranslate([0,0,-userRadius-0.1]);
        mvRotate(rX - 0.25, [1,0,0]);
        mvRotate(rY, [0,1,0]);
  }
  else if(followSatellite && satelliteViewType==4){ //directly in front of and looking back up at satellite
        mvTranslate([0,0,userRadius-0.1]);
        mvRotate(-rX , [1,0,0]);
        mvRotate(rY+180, [0,1,0]);
  }
  else if(followSatellite && satelliteViewType==5){
        mvTranslate([0,0,-0.2]);
        mvRotate(0, [1,0,0]);
        mvRotate(rY, [0,1,0]);
        mvTranslate([-currSatelliteCartesianX, -currSatelliteCartesianY, -currSatelliteCartesianZ]);
  }
  else if(followSatellite && satelliteViewType==6){
        mvTranslate([0,0,-cinematicPosition1Radius]);
        mvRotate(cinematicPosition1rX, [1,0,0]);
        mvRotate(cinematicPosition1rY, [0,1,0]);
        mvTranslate([-currSatelliteCartesianX, -currSatelliteCartesianY, -currSatelliteCartesianZ]);
  }
  else if(followSatellite && satelliteViewType==7){
        mvTranslate([0,0,-cinematicPosition2Radius]);
        mvRotate(cinematicPosition2rX, [1,0,0]);
        mvRotate(cinematicPosition2rY, [0,1,0]);
        mvTranslate([-currSatelliteCartesianX, -currSatelliteCartesianY, -currSatelliteCartesianZ]);
  }
  else if(followSatellite && satelliteViewType==8){
        mvTranslate([0,0,-cinematicPosition3Radius]);
        mvRotate(cinematicPosition3rX, [1,0,0]);
        mvRotate(cinematicPosition3rY, [0,1,0]);
        mvTranslate([-currSatelliteCartesianX, -currSatelliteCartesianY, -currSatelliteCartesianZ]);
  }
  else{

        mvTranslate([0,0,-userRadius]);
        mvRotate(rX, [1,0,0]);
        mvRotate(rY, [0,1,0]);
  }
}

function drawStarSkybox(){
    if(!centerAroundSun){
    drawSphere(celestialSphere,0,0,0,-sun.hRot,1,1,1);
    }
    else{
    drawSphere(celestialSphere,0,0,0,0,1,1,1);
    }
}

function drawTheEarth(){
  if(selfDestructCounter < 1){
	if(centerAroundSun){
	  gl.enable(gl.BLEND);
	  gl.blendFunc(gl.SRC_ALPHA, gl.ONE_MINUS_SRC_ALPHA);
	}
  gl.enable(gl.CULL_FACE);
  gl.cullFace(gl.FRONT);

  if(centerAroundSun){
  mvRotate(earthRotation, [0,1,0]);
  }
  if(debugMode){drawLines(xyzAxis,0,0,0,90,2.25,2.25,2.25);}
  drawSphere((centerAroundSun ? earthSunCentered : earth),0,0,0,90,1,1,1);
  if(centerAroundSun){drawSphere(satellitePath,0,0,0,90,1,1,1);}
  if(centerAroundSun){
  mvRotate(-earthRotation, [0,1,0]);
  }
  gl.disable(gl.CULL_FACE);
if(centerAroundSun){
  gl.enable(gl.CULL_FACE);
  gl.cullFace(gl.FRONT);
  drawSphere(terminator,0,0,0,90,1,1,1);
  gl.disable(gl.CULL_FACE);
  gl.disable(gl.BLEND);
}
        if((userRadius < 2 && !rocketMode) && !cinematicMode && selfDestructCounter < 0.5){
          drawSphere(earthMantle,0,0,0,0,1,1,1);
          drawSphere(earthCore,0,0,0,0,1,1,1);
        }
  }
}

function drawMoonAndSun(){
//draw the moon //need to align the moon correctly
mvRotate(moon.hRot, [0,1,0]);
mvRotate(moon.vRot, [0,0,1]);
mvTranslate([moon.orbitRadius,0,0]);
drawSphere(moon,0,0,0,0,1,1,1);
mvTranslate([-moon.orbitRadius,0,0]);
mvRotate(-moon.vRot, [0,0,1]);
mvRotate(-moon.hRot, [0,1,0]);

//draw the sun -use currTime to rotate
if(!centerAroundSun){
mvRotate(-sun.hRot, [0,1,0]);
}
mvRotate(sun.vRot, [0,0,1]); 
mvTranslate([sun.orbitRadius,0,0]);
gl.enable(gl.BLEND);
gl.blendFunc(gl.SRC_ALPHA, gl.ONE_MINUS_SRC_ALPHA);
drawSphere(sunGlow, 0, 0, 0, 90,1,1,1);
mvTranslate([1,0,0]);
drawSphere(rainbowGlare, 0, 0, 0, 90,1,1,1);
mvTranslate([-1,0,0]);
gl.disable(gl.BLEND);
drawSphere(sun,0,0,0,0,1,1,1);
mvTranslate([-sun.orbitRadius,0,0]);
mvRotate(-sun.vRot, [0,0,1]);
if(!centerAroundSun){
mvRotate(sun.hRot, [0,1,0]);
}
}

function drawMeteors(){
	if(rocketMode){
	for(var i=0; i<meteors.length; i++){
		mvTranslate([meteors[i].x,meteors[i].y,meteors[i].z]);
		var meteorDoneExploding = false;
		if(meteors[i].exploding){
			var explodingScale = meteors[i].explodingCounter/200;
	                drawSphere(explosion,0,0,0,90,explodingScale,explodingScale,explodingScale);
			meteors[i].explodingCounter++;
			if(meteors[i].explodingCounter > 30){
				meteorDoneExploding = true;
			}
		}
		else{
			drawSphere(meteor,0,0,0,0,1,1,1);
			meteors[i].velocity += meteorDelVelocity;
		}
		mvTranslate([-meteors[i].x,-meteors[i].y,-meteors[i].z]);
		
		if(!meteors[i].exploding){
			var delGravX = meteors[i].velocity * Math.sin(Math.atan2(meteors[i].x, 1));
                        var delGravY = meteors[i].velocity * Math.sin(Math.atan2(meteors[i].y, 1));
                        var delGravZ = meteors[i].velocity * Math.sin(Math.atan2(meteors[i].z, 1));
                        meteors[i].x -= delGravX;
                        meteors[i].y -= delGravY;
                        meteors[i].z -= delGravZ;
			meteors[i].velocity = 0;
			if(Math.sqrt(meteors[i].x*meteors[i].x + meteors[i].y*meteors[i].y + meteors[i].z*meteors[i].z) < 1.1){
	                        meteors[i].exploding = true;
                        	meteors[i].velocity = 0;
                	        numMeteorsHitEarth++;
        	                $("#meteorsMissed").html(numMeteorsHitEarth);
	                }
		}
		if(meteorDoneExploding){
			genRandomMeteor(i);
		}
	}
	}
}

function drawBullets(){
	if(rocketMode){
		for(var i=0; i<bullets.length; i++){
			bullets[i].x += bullets[i].delX;
			bullets[i].y += bullets[i].delY;
			bullets[i].z += bullets[i].delZ;
			bullets[i].age++;
			mvTranslate([bullets[i].x,bullets[i].y,bullets[i].z]);
			drawSphere(bullet,0,0,0,0,1,1,1);
			mvTranslate([-bullets[i].x,-bullets[i].y,-bullets[i].z]);
			if(bullets[i].age > bullets[i].lifetime){
				bullets.splice(i,1);
			}
		}
	}
}

function drawIndividualPath(i){
if(displaySatellitePaths && !selfDestruct){
if(isDrawingPath[i]){
mvRotate(90, [0,1,0]);
drawLines(satellitePaths[i],0,0,0,0,1,1,1);
mvRotate(-90, [0,1,0]);
}
}
}

function drawIndividualSatelliteName(i){
  gl.enable(gl.BLEND);
  gl.disable(gl.DEPTH_TEST);
  gl.blendFunc(gl.SRC_ALPHA, gl.ONE_MINUS_SRC_ALPHA);
  mvRotate(-90, [0,0,1]); 
  mvTranslate([0, -0.05, 0.0]);
  var satelliteNameDisplayScaleFactor = 1;
  var absUserSatelliteHeightDifference = Math.abs(userRadius - satellitePositions[i].orbitRadius);
        if(absUserSatelliteHeightDifference < 1.8){
                satelliteNameDisplayScaleFactor = (absUserSatelliteHeightDifference/2)+0.1;
        }

  gl.enable(gl.CULL_FACE);
  gl.cullFace(gl.FRONT);
  drawSphere(satelliteNames[i],0,0,0,90,satelliteNameDisplayScaleFactor,satelliteNameDisplayScaleFactor,1);
  gl.disable(gl.CULL_FACE);
  mvTranslate([0, 0.05, 0.0]);
  mvRotate(90, [0,0,1]); 
  gl.enable(gl.DEPTH_TEST);
  gl.disable(gl.BLEND);
}

function drawIndividualSatelliteSwath(i){
if(isDrawingSatelliteVision[i]){
mvRotate(-90, [0,1,0]);
mvTranslate([0, -satelliteVisionScales[i][1], 0.0]);
gl.enable(gl.BLEND);
gl.blendFunc(gl.SRC_ALPHA, gl.ONE_MINUS_SRC_ALPHA);
drawSphere(satelliteVision,0,0,0,0,satelliteVisionScales[i][0],satelliteVisionScales[i][1],satelliteVisionScales[i][2]);
gl.disable(gl.BLEND);
mvTranslate([0, satelliteVisionScales[i][1], 0.0]);
mvRotate(90, [0,1,0]);
}
}

function drawIndividualSatelliteModel(i){

  mvRotate(-satelliteForwardRotations[i], [0,1,0]);

  if(debugMode){
  mvTranslate([-0.1, 0.0, 0]);
  drawSphere(satelliteModels[i%satelliteModels.length],0,0,0,90,1,1,1);
  mvTranslate([0.1, 0.0, 0]);
  drawLines(xyzAxis,0,0,0,90,0.25,0.25,0.25);
  }

  mvRotate(satelliteRotations[i][0], [1,0,0]);
  mvRotate(satelliteRotations[i][2], [0,0,1]);
  mvRotate(satelliteRotations[i][1], [0,1,0]);

  if(satelliteSpinners[i]){
        mvRotate(satelliteSpinnerRotationCounter, [0,1,0]);
  }

  var realSizeFactor = (realSize ? 1/23900 : 1);
  drawSatellite(satelliteModels[i%satelliteModels.length],0,0,0,90,realSizeFactor,realSizeFactor,realSizeFactor,i);

  if(satelliteSpinners[i]){
        mvRotate(-satelliteSpinnerRotationCounter, [0,1,0]);
  }

  mvRotate(-satelliteRotations[i][1], [0,1,0]);
  mvRotate(-satelliteRotations[i][2], [0,0,1]);
  mvRotate(-satelliteRotations[i][0], [1,0,0]);

  drawIndividualSatelliteSwath(i);

  mvRotate(satelliteForwardRotations[i], [0,1,0]);

}

function drawGroundStations(){
if(shouldDrawGroundStations && !selfDestruct){
for(var i=0; i<groundStationPositions.length; i++){
  if(isDrawingGroundStation[i]){
  mvRotate(groundStationPositions[i].hRot, [0,1,0]);
  mvRotate(groundStationPositions[i].vRot, [0,0,1]);
  mvTranslate([1, 0.0, 0.0]);
  mvRotate(-90, [0,0,1]); 

  gl.enable(gl.BLEND);
  gl.blendFunc(gl.SRC_ALPHA, gl.ONE_MINUS_SRC_ALPHA);
  drawSphere(cone,0,0,0,90,coneXZScale,closestSatelliteToEarthDistance,coneXZScale);
  gl.disable(gl.BLEND);
   
  mvRotate(90, [0,0,1]);
  mvTranslate([-1, 0.0, 0.0]);
  mvRotate(-groundStationPositions[i].vRot, [0,0,1]);
  mvRotate(-groundStationPositions[i].hRot, [0,1,0]);
  }
 }
}
}

function drawSelfDestruct(){
if(selfDestruct){
if(selfDestructCounter < 30){
drawSphere(explosion,0,0,0,90+200*selfDestructCounter,selfDestructCounter,selfDestructCounter,selfDestructCounter);
selfDestructCounter+=0.1;
}
}
}

//
// drawScene
//
// Draw the scene.
//
function drawScene() {

  gl.clear(gl.COLOR_BUFFER_BIT | gl.DEPTH_BUFFER_BIT);
  
  perspectiveMatrix = makePerspective(45, $(window).width()/$(window).height(), (realSize ? 0.00000001 : 0.01), 200.0);
  
  loadIdentity();

  rotateSpinnerSatellites();

  earthRotation += 90;
  
  tourModeCalculationsForDrawFunction();

  moveRocket();

  followingSatellite(satelliteToFollow);

  aimCameraInDrawFunction();
  
  drawStarSkybox();

  drawSelfDestruct();

  drawMeteors();
  drawBullets();

  drawTheEarth();

  drawMoonAndSun();

  if(centerAroundSun){
	mvRotate(earthRotation, [0,1,0]);
  }
 if(drawNames){
 for(var i=0; i<satellitePositions.length; i++){

  drawIndividualPath(i);

  if(isDrawingSatellite[i] && (satellitePositions[i].orbitRadius > selfDestructCounter)){
mvRotate(satellitePositions[i].hRot, [0,1,0]);
mvRotate(satellitePositions[i].vRot, [0,0,1]);
mvTranslate([satellitePositions[i].orbitRadius, 0.0, 0.0]);

  mvRotate(-90, [0,0,1]); 

  drawIndividualSatelliteName(i);

  mvRotate(90, [0,0,1]);

mvTranslate([-satellitePositions[i].orbitRadius, 0.0, 0.0]);
mvRotate(-satellitePositions[i].vRot, [0,0,1]);
mvRotate(-satellitePositions[i].hRot, [0,1,0]);
  }
 }
 }

 for(var i=0; i<satellitePositions.length; i++){

  drawIndividualPath(i);

  if(isDrawingSatellite[i] && (satellitePositions[i].orbitRadius > selfDestructCounter)){
mvRotate(satellitePositions[i].hRot, [0,1,0]);
mvRotate(satellitePositions[i].vRot, [0,0,1]);
mvTranslate([satellitePositions[i].orbitRadius, 0.0, 0.0]);

  mvRotate(-90, [0,0,1]);

  drawIndividualSatelliteModel(i);

  mvRotate(90, [0,0,1]);

mvTranslate([-satellitePositions[i].orbitRadius, 0.0, 0.0]);
mvRotate(-satellitePositions[i].vRot, [0,0,1]);
mvRotate(-satellitePositions[i].hRot, [0,1,0]);
  }
 }

  drawGroundStations();

  if(centerAroundSun){
        mvRotate(-earthRotation, [0,1,0]);
  }

  earthRotation -= 90;

}

