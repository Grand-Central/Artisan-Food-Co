#!/bin/bash

#config
connectTo=grandcentral@gc-web1.grandcentralcreative.com
remoteDir=/var/www/cms-bootstrap.co.uk/web/uploads
localDir=/vagrant/web

#really?
read -r -p "Are you sure? This will download any new files from $connectTo$remoteDir to $localDir. [y/N] " response
response=${response,,}    # tolower
if [[ $response =~ ^(yes|y)$ ]]
then
    #perform the rsync
    echo -e "\e[32mStarting rsync\e[0m"
    rsync -chavzP --stats $connectTo:$remoteDir $localDir

    echo -e "\e[32mDone!\e[0m"
fi
