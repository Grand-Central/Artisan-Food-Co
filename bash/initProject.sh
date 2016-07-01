#!/bin/bash

#starting
echo -e "Initialising Symfony Project"

#request project details
read -r -p "Please enter a project name, E.g. CMS Bootstrap: " projectName
read -r -p "Please enter a database name, E.g. cms_bootstrap: " databaseName
read -r -p "Please enter a database username, E.g. cms_bootstrap: " databaseUser
read -r -p "Please enter a database password: " databasePassword

#format project name
projectNameSlug=$(echo "$projectName" | iconv -t ASCII//TRANSLIT | sed -E s/[^a-zA-Z0-9]+/-/g | sed -E s/^-+\|-+$//g | tr A-Z a-z)

#get the current dir
DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

#rename Vagrantfile entries
sed -i '' -- "s/cms-bootstrap/$projectNameSlug/g" "$DIR/../Vagrantfile"

#rename config entries
configPath="$DIR/../app/config/config.yml"
sed -i '' -- "s/cms-session/$projectNameSlug-session/g" $configPath

#rename parameter entries
paramerersPath="$DIR/../app/config/parameters.yml"
sed -i '' -- "s/cms_bootstrap_data/$databaseName/g" $paramerersPath
sed -i '' -- "s/cms_bootstrap_user/$databaseUser/g" $paramerersPath
sed -i '' -- "s/strapmybootslikethatpuss3827/$databasePassword/g" $paramerersPath
sed -i '' -- "s/CMS Bootstrap/$projectName/g" $paramerersPath

paramerersDistPath="$DIR/../app/config/parameters.yml.dist"
sed -i '' -- "s/cms_bootstrap_data/$databaseName/g" $paramerersDistPath
sed -i '' -- "s/cms_bootstrap_user/$databaseUser/g" $paramerersDistPath
sed -i '' -- "s/strapmybootslikethatpuss3827/$databasePassword/g" $paramerersDistPath
sed -i '' -- "s/CMS Bootstrap/$projectName/g" $paramerersDistPath

#rename createDatabase bash entries
sed -i '' -- "s/cms_bootstrap_data/$databaseName/g" "$DIR/createDatabase.sh"

#rename syncVagrantDatabaseWithLive bash entries
syncVagrantDatabaseWithLivePath="$DIR/syncVagrantDatabaseWithLive.sh"
sed -i '' -- "s/cms_bootstrap_data/$databaseName/g" $syncVagrantDatabaseWithLivePath
sed -i '' -- "s/cms_bootstrap_user/$databaseUser/g" $syncVagrantDatabaseWithLivePath
sed -i '' -- "s/strapmybootslikethatpuss3827/$databasePassword/g" $syncVagrantDatabaseWithLivePath

#rename puppet manifest bash entries
manifestPath="$DIR/../puppet/manifests/xenial64.pp"
sed -i '' -- "s/cms_bootstrap_user/$databaseUser/g" $manifestPath
sed -i '' -- "s/strapmybootslikethatpuss3827/$databasePassword/g" $manifestPath

#rename base template entries
sed -i '' -- "s/CMS Bootstrap/$projectName/g" "$DIR/../app/config/config.yml"

#rename README entries
readmePath="$DIR/../README.md"
sed -i '' -- "s/cms-bootstrap/$projectNameSlug/g" $readmePath
sed -i '' -- "s/CMS Bootstrap/$projectName/g" $readmePath

#finished
echo -e "Done. Follow the rest of the README then visit http://$projectNameSlug.dev/app_dev.php in your browser."
