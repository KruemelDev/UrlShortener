@echo on

echo DirectoryIndex ./UrlShortener/src/main/index.php > ..\.htaccess
echo DirectoryIndex ./src/main/index.php > .htaccess
echo DirectoryIndex ../src/main/index.php > .\docker\.htaccess
echo DirectoryIndex ./main/index.php > .\src\,htaccess

@echo off
