function getEarthTexture(tmpYear, dayOfYear, hours){
        var imageFilenames = new Array();
        var textureFilename = imageFilenamePrefix+"vis-ir-lights-"+tmpYear+"00"+dayOfYear+"-"+hours+"00";
        if(dayOfYear > 99){
                textureFilename = imageFilenamePrefix+"vis-ir-lights-"+tmpYear+dayOfYear+"-"+hours+"00";
        }
        else if(dayOfYear > 9){
                textureFilename = imageFilenamePrefix+"vis-ir-lights-"+tmpYear+"0"+dayOfYear+"-"+hours+"00";
        }

        $.get("./earthTextures/",function(data,status){
                var output = strip(data).split('\n');
//              var displayOutput = "";
                if(maxTextureSize >= 8192 && !selectLowResTexture){
                        for(var i=0; i<output.length; i++){
                                if(output[i][0] == 'v' && output[i][1] == 'i' && output[i][2] == 's'){
//                                      displayOutput += i + ": " + output[i].split(".jpg")[0] + "\n";
                                        imageFilenames[i] = (output[i].split(".jpg")[0]);
                                }
                        }
                }
                else{
                        for(var i=0; i<output.length; i++){
                                if(output[i][0] == 'l' && output[i][1] == 'r' && output[i][2] == '_'){
//                                      displayOutput += i + ": " + output[i].split(".jpg")[0] + "\n";
                                        imageFilenames[i] = (output[i].split(".jpg")[0]);
                                }
                        }
                }
//              alert("Length: " + output.length + "\nData: \n" + displayOutput  + "\nStatus: " + status);
//              alert(imageFilenames.indexOf(textureFilename) + ", " + textureFilename + ", " + imageFilenames.length);

                if(imageFilenames.indexOf(textureFilename) != -1){
                        getTimeFromImageFilename(textureFilename);
                        initTextures(earth, "./earthTextures/"+textureFilename+".jpg", true);
                }
                else{
                        getTimeFromImageFilename(imageFilenames[imageFilenames.length-1]);
                        initTextures(earth, "./earthTextures/"+imageFilenames[imageFilenames.length-1]+".jpg", true);
                }
        });
}

function getCloudTexture(tmpYear, dayOfYear, hours){
        var cloudTextureFilename = imageFilenamePrefix+"clouds-"+tmpYear+"00"+dayOfYear+"-"+hours+"00";
        if(dayOfYear > 99){
                cloudTextureFilename = imageFilenamePrefix+"clouds-"+tmpYear+dayOfYear+"-"+hours+"00";
        }
        else if(dayOfYear > 9){
                cloudTextureFilename = imageFilenamePrefix+"clouds-"+tmpYear+"0"+dayOfYear+"-"+hours+"00";
        }

        var cloudImageFilenames = new Array();
        $.get("./cloudsOnly/",function(data,status){
                var output = strip(data).split('\n');
//              var displayOutput = "";
                if(maxTextureSize >= 8192 && !selectLowResTexture){
                        for(var i=0; i<output.length; i++){
                                if(output[i][0] == 'c' && output[i][1] == 'l' && output[i][2] == 'o'){
//                                      displayOutput += i + ": " + output[i].split(".png")[0] + "\n";
                                        cloudImageFilenames[i] = (output[i].split(".png")[0]);
                                }
                        }
                }
                else{
                        for(var i=0; i<output.length; i++){
                                if(output[i][0] == 'l' && output[i][1] == 'r' && output[i][2] == '_'){
//                                      displayOutput += i + ": " + output[i].split(".png")[0] + "\n";
                                        cloudImageFilenames[i] = (output[i].split(".png")[0]);
                                }
                        }
                }
//              alert("Length: " + output.length + "\nData: \n" + displayOutput  + "\nStatus: " + status);

                if(cloudImageFilenames.indexOf(cloudTextureFilename) != -1){
//                      alert(cloudTextureFilename);
                        initTextures(satellitePath, "./cloudsOnly/"+cloudTextureFilename+".png", false);
                }
                else{
//                      alert(cloudImageFilenames[cloudImageFilenames.length-1]);
                        initTextures(satellitePath, "./cloudsOnly/"+cloudImageFilenames[cloudImageFilenames.length-1]+".png", false);
                }

//              alert(imageFilenames.indexOf(textureFilename) + ", " + textureFilename + ", " + imageFilenames.length);
        });
}

function getTerminatorTexture(dayOfYear){
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

    initTextures(terminator, terminatorFilename, false);
}
