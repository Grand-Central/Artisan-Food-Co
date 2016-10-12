#!/bin/bash

#really?
read -r -p "Are you sure? This will drop and replace the local artisan_food_co database destroying all data [y/N] " response
response=${response,,}    # tolower
if [[ $response =~ ^(yes|y)$ ]]
then
    sudo service postgresql restart

    #disconnect any other sessions
    echo "Disconnecting other sessions..."
    psql postgres -c "SELECT pg_terminate_backend(pg_stat_activity.pid) FROM pg_stat_activity WHERE pg_stat_activity.datname = 'artisan_food_co'  AND pid <> pg_backend_pid();"

    #drop & create the database
    psql postgres -c "DROP DATABASE IF EXISTS artisan_food_co"
    psql postgres -c "CREATE DATABASE artisan_food_co"

    #create tables from model
    cd /vagrant && php app/console doctrine:schema:create
fi
