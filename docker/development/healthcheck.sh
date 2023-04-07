#!/bin/bash

cmds=("nginx" "php-fpm")
healthcheck=0

for cmd in "${cmds[@]}"
do
	count=$(pgrep -c -f $cmd)
	if [ $count -eq 0 ]
	then
		healthcheck=1
	fi
done

if [ $healthcheck -eq 0 ]
then
    statusCode=$(curl -s -o /dev/null -w "%{http_code}" http://localhost/_health)
    if [ $statusCode -ne 200 ]
    then
        healthcheck=1
    fi
fi

exit $healthcheck
