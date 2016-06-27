#!/bin/bash

#config
databaseName=cms_bootstrap_data
role=cms_bootstrap_user
rolePassword=strapmybootslikethatpuss3827
connectTo=grandcentral@gc-web1.grandcentralcreative.com
remoteDir=/var/lib/postgresql/backup/data/$databaseName.*

#really?
read -r -p "Are you sure? This will drop and replace your local $databaseName database with a recent backup from live [y/N] " response
response=${response,,}    # tolower
if [[ $response =~ ^(yes|y)$ ]]
then
    #get the chosen backup from the live db server
    scp $connectTo:`ssh $connectTo ls -1td $remoteDir | head -1` /home/vagrant/

    #restart postgres to help with disconnecting sessions
    sudo service postgresql restart

    #disconnect any other sessions
    echo -e "\e[32mDisconnecting other sessions...\e[0m"
    psql postgres -c "SELECT pg_terminate_backend(pg_stat_activity.pid) FROM pg_stat_activity WHERE pg_stat_activity.datname = '$databaseName'  AND pid <> pg_backend_pid();"

    echo -e "\e[32mCreating Role\e[0m"
    psql postgres -c "CREATE ROLE \"$role\" WITH LOGIN PASSWORD '$rolePassword'"

    echo -e "\e[32mCreating database\e[0m"
    psql postgres -c "DROP DATABASE \"$databaseName\""
    psql postgres -c "CREATE DATABASE \"$databaseName\" OWNER \"$role\""

    echo -e "\e[32mRestoring Database..."
    pg_restore -d $databaseName -j4 /home/vagrant/$databaseName.*

    rm /home/vagrant/$databaseName.*

    echo -e "\e[32mDone!\e[0m"
fi
