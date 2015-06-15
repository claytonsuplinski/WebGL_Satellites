function startRocketMode(){
rocketMode = true;
$("#rocketModeButton").css({backgroundColor:'#23415a'});

stopFollowingSatellites();

$("#rocketFollowing").show();
$("#meteorScore").show();
$("#meteorDisplay").show();
}

function stopRocketMode(){
rocketMode = false;
$("#rocketModeButton").css({backgroundColor:'#333333'});
$("#rocketFollowing").hide();
$("#meteorScore").hide();
$("#meteorDisplay").hide();
}

function toggleMeteors(){
	if(!meteorsOn){ //Meteors are off -> on
		meteors = [];
		genRandomMeteors();
		$("#meteorToggle").html("Meteors On");
		meteorsOn = true;
	}
	else{ //Meteors are on -> off
		meteors = [];
		$("#meteorToggle").html("Meteors Off");
		meteorsOn = false;
	}
}
