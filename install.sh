#!/bin/bash
set -e
red=`tput setaf 1`
green=`tput setaf 2`
reset=`tput sgr0`
echo "${green}>Pulling the latest code from the repository...${reset}"
git pull origin master
echo "${green}>Installing vendor package dependencies...${reset}"

if [ "$1" = "dev" ]; then
	composer update;
else
	composer install --no-dev;
fi
echo "${green}>Insatlling NPM package dependencies...${reset}"
npm install
echo "${green}>Installing JS script dependencies...${reset}"
bower update
echo "${green}>Compile and minify CSS and Scripts...${reset}"
gulp
echo "${green}>Checking storage directory for permissions...${reset}"
if [ "$1" != "dev" ]; then

	perm=$(stat -c %G storage)
	if [ "$perm" != "apache" ]; then
		echo "${red}Group needs to be set to apache on the storage folder${reset}" 1>&2
	fi
	mode=$(stat -c %a storage)
	if [ "$mode" != "775" ]; then
		echo "${red}Need to set the permisson of the storage folder (recursively) to 775${reset}" 1>&2
	fi
fi 
echo "Done."
echo "Be sure to make sure the .env file is set correctly for this environment"
echo "${green}Be sure to run any migrations manually: php artisan migrate${reset}"

