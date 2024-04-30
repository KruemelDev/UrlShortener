# UrlShortener

## This is a school computer science project which we are supposed to implement with php.

## Set Up:
### Linux, MacOS and Windows:
- Make sure ````docker```` and ````docker-compose```` is installed [Link to docker webpage](https://www.docker.com/)
- Next run this script [setupProjectDockerLinux](./setupProjectDocker.sh) if you are on linux or macos else run this script [setupProjectDockerWindows](./setupProjectDocker.bat)
- Next navigate to the [docker](./docker/) directory
- Next run this command ````docker-compose up -d````
- Now you are ready and can reach your page under the following url [http://127.0.0.1](http://127.0.0.1/)

### Windows only:
- Download xampp for windows here [Link to apachefriends](https://www.apachefriends.org/)
- When the download has finished run the installer and navigate to your xampp installation path
- Next navigate into the ````htdocs```` directory and clone this repository into the folder ````git clone https://github.com/KruemelDev/UrlShortener.git````
- Next run the [setupProjectXampp](setupProjectXampp) script
- Now you are ready and can reach your page under the following url [http://127.0.0.1](http://127.0.0.1/)
## Functions:
- 
## TODO: 
- Setup a database to store the target locations
- Setup webserver to host our webpages
- Implement websites to add a path
- Implement to redirect client to target url
- Edit setupProjectXampp.bat file to create .htaccess files automatically.

## Database structure:
| Id         | path         | target                      |
| :----------- | :--------------: | -------------------------: |
| 1 | qj478i | [Link to example.com](http://www.example.com)  |
| 2 | uiOp90 | [Link to google.com](https://www.google.com) |


## Contributors
  - Thomas
  - Lennart
