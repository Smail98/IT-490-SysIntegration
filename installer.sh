#!/bin/bash
filename=$1

unzip -o ./bin/bundle.zip sim-meta.json -d ./bin/

for ((i=0;i<$(jq '. | length' ./bin/sim-meta.json);i++))
        do
                var1=$(jq -j .[$i]'["folderName"]' ./bin/sim-meta.json)
                echo $var1
                var2=$(jq -j .[$i]'["unpackTo"]' ./bin/sim-meta.json)
                echo $var2

                #if [ $var2 = "/Desktop/" ]
                #then
                #       unzip -o $filename $var1/* -d ~/Desktop/
                #else
                #       unzip -o $filename $var1/* -d $var2
                #fi

                unzip -o $filename $var1/* -d $var2
        done
