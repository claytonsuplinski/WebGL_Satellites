var selectedDate="";
var tmpDate = new Date();
var currTime=Number((tmpDate.getUTCHours()*3600+ tmpDate.getUTCMinutes()*60 + tmpDate.getUTCSeconds()).toFixed(0));
var satelliteViewType=2; //0=no satellite in display, 1=satellite in display, 2=satellite in display off-center [slightly above]
var numSatelliteViewTypes=9;
var moveSatellite = false;var movingSatelliteIndex = 0;var movingSatelliteCounter=3.33333*currTime;var lerpTime = 1000;
var displaySatellitePaths = true;
var cinematicMode = false;
var tourMode = false;var tourCounter = 0;var tourInterval = 280;var tourModeRealtime = false;
var tourTransition = false;var tourTransitionInterval = 240;var tourTransitionCounter = 0;
var playInReverse = false;
var playInRealtime = false;
var drawNames = false;

var realSize = false;

var centerAroundSun = false;

var angleFactor = 3.14159/180;

var scaleLocation;
var moreVariablesLocation;

var closestSatelliteToEarthDistance = 99;

var selfDestruct = false;var selfDestructCounter = 0;

var autoReload = false;

var selectLowResTexture = false;

var mouseIdleCounter = 0;

var satelliteFreeMode = false;
var satelliteFreeModeRX = 0;var satelliteFreeModeRY = 0;

var rocketMode = false;
var rocketExploding = false;
var rocketExplodingCounter = 0;

var secondsOfBurningFuel = 0;
var dollarsOfUsedFuel = 0;

var currSatelliteCartesianX = 0;var currSatelliteCartesianY = 0;var currSatelliteCartesianZ = 0;
var cinematicPosition1Radius = 0;var cinematicPosition1rX = 0;var cinematicPosition1rY = 0;
var cinematicPosition2Radius = 0;var cinematicPosition2rX = 0;var cinematicPosition2rY = 0;
var cinematicPosition3Radius = 0;var cinematicPosition3rX = 0;var cinematicPosition3rY = 0;

var displayBottomline = false;

var leftInfoTabs = new Array();var rightInfoTabs = new Array();

var isTouchScreen;

var axisOrientation = 1;

var debugMode = false;

var satelliteInShadow = new Array();
satelliteInShadow[999999] = 0;

//ADD_GROUND_STATION//
var groundStationPositions = new Array();
groundStationPositions.push({hRot: -179.4, vRot: 43.1}); //Madison
groundStationPositions.push({hRot: -75.47-90, vRot: 37.85}); //Wallops
groundStationPositions.push({hRot: -80.22-90, vRot: 25.79}); //Miami
groundStationPositions.push({hRot: -147.72-90, vRot: 64.84}); //Fairbanks
groundStationPositions.push({hRot: 16-90, vRot: 78}); //Svalbard

//ADD_GROUND_STATION//
var isDrawingGroundStation = new Array();
isDrawingGroundStation.push(false);
isDrawingGroundStation.push(false);
isDrawingGroundStation.push(false);
isDrawingGroundStation.push(false);
isDrawingGroundStation.push(false);

var shouldDrawGroundStations = true;

/*
Create different objects to be drawn in the display.
*/
var satellite = new Object();
satellite.VerticesBuffer="empty";
satellite.VerticesNormalBuffer="empty";
satellite.VerticesTextureCoordBuffer="empty";
satellite.VerticesIndexBuffer="empty";
satellite.Image="empty";
satellite.Texture="empty";
satellite.vertices = [];
satellite.vertexNormals=[];
satellite.textureCoordinates=[];
satellite.VertexIndices=[];

var rocket = new Object();
rocket.VerticesBuffer="empty";
rocket.VerticesNormalBuffer="empty";
rocket.VerticesTextureCoordBuffer="empty";
rocket.VerticesIndexBuffer="empty";
rocket.Image="empty";
rocket.Texture="empty";
rocket.vertices = [];
rocket.vertexNormals=[];
rocket.textureCoordinates=[];
rocket.VertexIndices=[];
rocket.velocity=0;
rocket.rotY=0;
rocket.rotX=0;
rocket.x=-1;rocket.y=0;rocket.z=-1;

var rocketFlames = new Object();
rocketFlames.VerticesBuffer="empty";
rocketFlames.VerticesNormalBuffer="empty";
rocketFlames.VerticesTextureCoordBuffer="empty";
rocketFlames.VerticesIndexBuffer="empty";
rocketFlames.Image="empty";
rocketFlames.Texture="empty";
rocketFlames.vertices = [];
rocketFlames.vertexNormals=[];
rocketFlames.textureCoordinates=[];
rocketFlames.VertexIndices=[];

var explosion = new Object();
explosion.VerticesBuffer="empty";
explosion.VerticesNormalBuffer="empty";
explosion.VerticesTextureCoordBuffer="empty";
explosion.VerticesIndexBuffer="empty";
explosion.Image="empty";
explosion.Texture="empty";
explosion.vertices = [];
explosion.vertexNormals=[];
explosion.textureCoordinates=[];
explosion.VertexIndices=[];

var cone = new Object();
cone.VerticesBuffer="empty";
cone.VerticesNormalBuffer="empty";
cone.VerticesTextureCoordBuffer="empty";
cone.VerticesIndexBuffer="empty";
cone.Image="empty";
cone.Texture="empty";
cone.vertices = [];
cone.vertexNormals=[];
cone.textureCoordinates=[];
cone.VertexIndices=[];

var coneXZScale = 1;

var satelliteVision = new Object();
satelliteVision.VerticesBuffer="empty";
satelliteVision.VerticesNormalBuffer="empty";
satelliteVision.VerticesTextureCoordBuffer="empty";
satelliteVision.VerticesIndexBuffer="empty";
satelliteVision.Image="empty";
satelliteVision.Texture="empty";
satelliteVision.vertices = [];
satelliteVision.vertexNormals=[];
satelliteVision.textureCoordinates=[];
satelliteVision.VertexIndices=[];

var isDrawingSatellite = new Array();
var isDrawingPath = new Array();
var satelliteRotations = new Array();
var satelliteSpinners = new Array();var satelliteSpinnerRotationCounter = 0;
var satelliteForwardRotations = new Array();
var tmpSatelliteForwardRotation = 0;

var satelliteFlags = new Array();
satelliteFlags.push("./flags/unitedStates.png");
satelliteFlags.push("./flags/china.png");
satelliteFlags.push("./flags/japan.png");
satelliteFlags.push("./flags/europe.png");
satelliteFlags.push("./flags/india.png");
satelliteFlags.push("./flags/southKorea.png");
satelliteFlags.push("./flags/russia.png");

//ADD_SATELLITE// --Add new textures to the end of the array (order matters)
var satelliteNames = new Array();
var satelliteModels = new Array();
var satellitePaths = new Array();
var satelliteTextures = new Array();
satelliteTextures.push("./satelliteModels/goes1x.png");
satelliteTextures.push("./satelliteModels/mtsat.png");
satelliteTextures.push("./satelliteModels/coms.png");
satelliteTextures.push("./satelliteModels/fy1.png");
satelliteTextures.push("./satelliteModels/fy2.png");
satelliteTextures.push("./satelliteModels/fy3.png");
satelliteTextures.push("./satelliteModels/insat3d.png");
satelliteTextures.push("./satelliteModels/terra.png");
satelliteTextures.push("./satelliteModels/aqua.png");
satelliteTextures.push("./satelliteModels/npp.png");
satelliteTextures.push("./satelliteModels/metop.png");
satelliteTextures.push("./satelliteModels/meteosat7.png");
satelliteTextures.push("./satelliteModels/meteosat10.png");
satelliteTextures.push("./satelliteModels/noaa15_16.png");
satelliteTextures.push("./satelliteModels/noaa18_19.png");
satelliteTextures.push("./satelliteModels/kalpana.png");
satelliteTextures.push("./satelliteModels/landsat8.png");
satelliteTextures.push("./satelliteModels/gcomW1.png");

/*
Initialize arrays for starting and future satellite positions
*/
var satellitePositions = [];var startingSatellitePositions = [];
var futureSatelliteOrbitRadius=new Array();
var futureSatellitehRot=new Array();
var futureSatellitevRot=new Array();
var futureSatelliteTime=new Array();
var tmpHour=00;var tmpMin=00;
while(tmpHour<23 || tmpMin < 55){
        futureSatelliteTime.push(3600*tmpHour+60*tmpMin);
        tmpMin+=5;
        if(tmpMin > 55){tmpMin = 0;tmpHour++;}
}
futureSatelliteTime.push(86100); //Manually push 23:55

var canvas;
var gl;
var maxTextureSize;
var imageFilenamePrefix = "";

/*
Variables used when the user follows the satellite
*/
var followSatellite = false;
var satelliteToFollow = 0;

var sunGlow = new Object();
sunGlow.VerticesBuffer="empty";
sunGlow.VerticesNormalBuffer="empty";
sunGlow.VerticesTextureCoordBuffer="empty";
sunGlow.VerticesIndexBuffer="empty";
sunGlow.Half = 10;
sunGlow.Image="empty";
sunGlow.Texture="empty";
sunGlow.vertices = [
     -sunGlow.Half, -sunGlow.Half,  0,
     sunGlow.Half, -sunGlow.Half,  0,
     sunGlow.Half,  sunGlow.Half,  0,
    -sunGlow.Half,  sunGlow.Half,  0
];
sunGlow.vertexNormals = [
     0.0,  0.0,  1.0,
     0.0,  0.0,  1.0,
     0.0,  0.0,  1.0,
     0.0,  0.0,  1.0
];
sunGlow.textureCoordinates = [
    0.0,  0.0,
    1.0,  0.0,
    1.0,  1.0,
    0.0,  1.0
];
sunGlow.VertexIndices = [
    0,  1,  2,      0,  2,  3
];

var rainbowGlare = new Object();
rainbowGlare.VerticesBuffer="empty";
rainbowGlare.VerticesNormalBuffer="empty";
rainbowGlare.VerticesTextureCoordBuffer="empty";
rainbowGlare.VerticesIndexBuffer="empty";
rainbowGlare.Half = 11;
rainbowGlare.Image="empty";
rainbowGlare.Texture="empty";
rainbowGlare.vertices = [
     -rainbowGlare.Half, -rainbowGlare.Half,  0,
     rainbowGlare.Half, -rainbowGlare.Half,  0,
     rainbowGlare.Half,  rainbowGlare.Half,  0,
    -rainbowGlare.Half,  rainbowGlare.Half,  0
];
rainbowGlare.vertexNormals = [
     0.0,  0.0,  1.0,
     0.0,  0.0,  1.0,
     0.0,  0.0,  1.0,
     0.0,  0.0,  1.0
];
rainbowGlare.textureCoordinates = [
    0.0,  0.0,
    1.0,  0.0,
    1.0,  1.0,
    0.0,  1.0
];
rainbowGlare.VertexIndices = [
    0,  1,  2,      0,  2,  3
];

var xyzAxis = new Object();
xyzAxis.VerticesBuffer="empty";
xyzAxis.VerticesNormalBuffer="empty";
xyzAxis.VerticesTextureCoordBuffer="empty";
xyzAxis.VerticesIndexBuffer="empty";
xyzAxis.Half = 1;
xyzAxis.Image="empty";
xyzAxis.Texture="empty";
xyzAxis.vertices = [
     0, 0,  0,
     xyzAxis.Half, 0,  0,
     0,  xyzAxis.Half, 0,
     0,  0,  xyzAxis.Half,
     0, 0,  0,
     0, 0,  0
];
xyzAxis.vertexNormals = [
     0.0,  0.0,  1.0,
     0.0,  0.0,  1.0,
     0.0,  0.0,  1.0,
     0.0,  0.0,  1.0
];
xyzAxis.textureCoordinates = [
    0.25,  0.0,
    0.25,  0.0,
    0.5,  1.0,
    0.75,  1.0,
    0.5,  1.0,
    0.75,  1.0
];
xyzAxis.VertexIndices = [
    0,  1,  0,      4,  2,  4,
    5,  3,  5
];

var isDrawingSatelliteVision = new Array();
var satelliteVisionScales = new Array();

var celestialSphere = new Object();
celestialSphere.VerticesBuffer="empty";
celestialSphere.VerticesNormalBuffer="empty";
celestialSphere.VerticesTextureCoordBuffer="empty";
celestialSphere.VerticesIndexBuffer="empty";
celestialSphere.Image="empty";
celestialSphere.Texture="empty";
celestialSphere.latitudeBands = 40;
celestialSphere.longitudeBands = 40;
celestialSphere.radius = 70;
celestialSphere.vertices = [];
celestialSphere.vertexNormals=[];
celestialSphere.textureCoordinates=[];
celestialSphere.VertexIndices=[];

/*
Creates the Earth model
*/
var earth = new Object();
earth.VerticesBuffer="empty";
earth.VerticesNormalBuffer="empty";
earth.VerticesTextureCoordBuffer="empty";
earth.VerticesIndexBuffer="empty";
earth.Image="empty";
earth.Texture="empty";
earth.latitudeBands = 80;
earth.longitudeBands = 80;
earth.radius = 1;
earth.vertices = [];
earth.vertexNormals=[];
earth.textureCoordinates=[];
earth.VertexIndices=[];

var earthSunCentered = new Object();
earthSunCentered.VerticesBuffer="empty";
earthSunCentered.VerticesNormalBuffer="empty";
earthSunCentered.VerticesTextureCoordBuffer="empty";
earthSunCentered.VerticesIndexBuffer="empty";
earthSunCentered.Image="empty";
earthSunCentered.Texture="empty";
earthSunCentered.latitudeBands = 40;
earthSunCentered.longitudeBands = 40;
earthSunCentered.radius = 1;
earthSunCentered.vertices = [];
earthSunCentered.vertexNormals=[];
earthSunCentered.textureCoordinates=[];
earthSunCentered.VertexIndices=[];

var earthRotation = 0;

var moon = new Object();
moon.VerticesBuffer="empty";
moon.VerticesNormalBuffer="empty";
moon.VerticesTextureCoordBuffer="empty";
moon.VerticesIndexBuffer="empty";
moon.Image="empty";
moon.Texture="empty";
moon.latitudeBands = 8;
moon.longitudeBands = 8;
moon.radius = 0.5;
moon.vertices = [];
moon.vertexNormals=[];
moon.textureCoordinates=[];
moon.VertexIndices=[];
moon.orbitRadius = 60.3;
moon.vRot = 0;
moon.hRot = 0;

var sun = new Object();
sun.VerticesBuffer="empty";
sun.VerticesNormalBuffer="empty";
sun.VerticesTextureCoordBuffer="empty";
sun.VerticesIndexBuffer="empty";
sun.Image="empty";
sun.Texture="empty";
sun.latitudeBands = 8;
sun.longitudeBands = 8;
sun.radius = 0.7;
sun.vertices = [];
sun.vertexNormals=[];
sun.textureCoordinates=[];
sun.VertexIndices=[];
sun.orbitRadius = -62.3;
sun.vRot = 0;
sun.hRot = 0;
sun.x = 0;sun.y = 0;sun.z = 0;

var satellitePath = new Object();
satellitePath.VerticesBuffer="empty";
satellitePath.VerticesNormalBuffer="empty";
satellitePath.VerticesTextureCoordBuffer="empty";
satellitePath.VerticesIndexBuffer="empty";
satellitePath.Image="empty";
satellitePath.Texture="empty";
satellitePath.latitudeBands = 40;
satellitePath.longitudeBands = 40;
satellitePath.radius = 1.001;
satellitePath.vertices = [];
satellitePath.vertexNormals=[];
satellitePath.textureCoordinates=[];
satellitePath.VertexIndices=[];

var terminator = new Object();
terminator.VerticesBuffer="empty";
terminator.VerticesNormalBuffer="empty";
terminator.VerticesTextureCoordBuffer="empty";
terminator.VerticesIndexBuffer="empty";
terminator.Image="empty";
terminator.Texture="empty";
terminator.latitudeBands = 40;
terminator.longitudeBands = 40;
terminator.radius = 1.005;
terminator.vertices = [];
terminator.vertexNormals=[];
terminator.textureCoordinates=[];
terminator.VertexIndices=[];

var earthMantle = new Object();
earthMantle.VerticesBuffer="empty";
earthMantle.VerticesNormalBuffer="empty";
earthMantle.VerticesTextureCoordBuffer="empty";
earthMantle.VerticesIndexBuffer="empty";
earthMantle.Image="empty";
earthMantle.Texture="empty";
earthMantle.latitudeBands = 10;
earthMantle.longitudeBands = 10;
earthMantle.vertices = [];
earthMantle.vertexNormals=[];
earthMantle.textureCoordinates=[];
earthMantle.VertexIndices=[];
earthMantle.radius = 0.9;
var earthCore = new Object();
earthCore.VerticesBuffer="empty";
earthCore.VerticesNormalBuffer="empty";
earthCore.VerticesTextureCoordBuffer="empty";
earthCore.VerticesIndexBuffer="empty";
earthCore.Image="empty";
earthCore.Texture="empty";
earthCore.latitudeBands = 15;
earthCore.longitudeBands = 15;
earthCore.vertices = [];
earthCore.vertexNormals=[];
earthCore.textureCoordinates=[];
earthCore.VertexIndices=[];
earthCore.radius = 0.2;

var meteor = new Object();
meteor.VerticesBuffer="empty";
meteor.VerticesNormalBuffer="empty";
meteor.VerticesTextureCoordBuffer="empty";
meteor.VerticesIndexBuffer="empty";
meteor.Image="empty";
meteor.Texture="empty";
meteor.latitudeBands = 6;
meteor.longitudeBands = 6;
meteor.vertices = [];
meteor.vertexNormals=[];
meteor.textureCoordinates=[];
meteor.VertexIndices=[];
meteor.radius = 0.1;

var meteors = [];

var bullet = new Object();
bullet.VerticesBuffer="empty";
bullet.VerticesNormalBuffer="empty";
bullet.VerticesTextureCoordBuffer="empty";
bullet.VerticesIndexBuffer="empty";
bullet.Image="empty";
bullet.Texture="empty";
bullet.latitudeBands = 4;
bullet.longitudeBands = 4;
bullet.vertices = [];
bullet.vertexNormals=[];
bullet.textureCoordinates=[];
bullet.VertexIndices=[];
bullet.radius = 0.002;

var bullets = []; //need x,y,z,delX,delY,delZ,lifetime,age

var meteorsOn = false;
var numActiveMeteors = 1;//1 for easy; 2 for medium; 3 for difficult;
var numMeteorsDestroyed = 0;
var numMeteorsHitEarth = 0;
var meteorDelVelocity = 0.005;//0.005 for easy; 0.008 for medium; 0.01 for difficult;

var rY = 0.0; //Defines the horizontal rotation of the user
var rX = 0; //Defines the vertical rotation of the user
var userRadius = 10;
var mouseDown = false;
var rightMouseDown = false;
var mouseDownHeader = false;
var prevMouseX = 0;
var prevMouseY = 0;

var mvMatrix;
var shaderProgram;
var vertexPositionAttribute;
var vertexNormalAttribute;
var textureCoordAttribute;
var perspectiveMatrix;

var satelliteModelsReset = new Array();
var satelliteFlagsReset = new Array();


