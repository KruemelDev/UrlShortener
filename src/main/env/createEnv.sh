#!/bin/bash

read -p "Servername: " serverName
read -p "Databaseusername: " databaseUsername
read -p "Databasepassword: " databasePassword
read -p "Databasename: " databaseName

touch .env
echo SERVER_NAME=$serverName > .env
echo DATABASE_USERNAME=$databaseUsername >> .env
echo DATABASE_PASSWORD=$databasePassword >> .env
echo DATABASE_NAME=$databaseName >> .env