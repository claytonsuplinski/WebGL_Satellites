#!/bin/bash

year=$(date -u +%Y --date="today")
month=$(date -u +%m --date="today")
day=$(date -u +%d --date="today")

while read line;
do
	if [ "${line:0:8}" == "Location" ]
	then
		sat=${line:12}
		if [ ! -f ${sat}.png ]
		then
			convert -size 128x64 xc:transparent -font Helvetica -gravity center -pointsize 16 -fill white -draw "text 0,0 '${sat}'" ${sat}.png
		fi
	fi
done <../dataDir/satellitePositions/${year}_${month}_${day}.txt
