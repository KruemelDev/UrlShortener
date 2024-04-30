#!/bin/bash
askForDatabasePassword(){
    echo "Please enter your password for the database:"
    read -s first_password
    echo "Please enter your password again:"
    read -s second_password

    if [ "$first_password" == "$second_password" ]; then
        createEnvFile "$first_password"
    else
        return 1
    fi
}

createEnvFile(){
    password="$1"

    touch docker/.env && echo "DATABASE_PASSWORD=$password" > docker/.env && echo "DATABASE_PORT=3306" >> docker/.env && echo "PHPMYADMIN_PORT=8080" >> docker/.env && echo "APACHE_PORT=80" >> docker/.env
}

askForDatabasePassword
if [ $? -ne 0 ]; then
    echo "Passwords do not match."
fi
