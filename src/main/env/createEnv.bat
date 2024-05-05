@echo off

set /p serverName="Servername: "
set /p databaseUsername="Databaseusername: "
set /p databasePassword="Databasepassword: "
set /p databaseName="Databasename: "

echo SERVER_NAME=%serverName% > .env
echo DATABASE_USERNAME=%databaseUsername% >> .env
echo DATABASE_PASSWORD=%databasePassword% >> .env
echo DATABASE_NAME=%databaseName% >> .env
