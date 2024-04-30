@echo on
setlocal EnableDelayedExpansion

:askForDatabasePassword
echo Please enter your password for the database:
set /p first_password=
echo Please enter your password again:
set /p second_password=

if "!first_password!"=="!second_password!" (
    call :createEnvFile "!first_password!"
) else (
    echo Passwords do not match.
    exit /b 1
)

exit /b 0

:createEnvFile
set password=%1

(
    echo DATABASE_PASSWORD=!password!
    echo DATABASE_PORT=3306
    echo PHPMYADMIN_PORT=8080
    echo APACHE_PORT=80
) > docker\.env

exit /b 0
