# UrlShortener

## This is a school computer science project which we are supposed to implement with php.

## Set Up:
### Linux, MacOS and Windows:
- Make sure ````docker```` and ````docker-compose```` is installed [Link to docker webpage](https://www.docker.com/)
  #### Linux, MacOS
  - Run this [setupProjectDockerLinux](./setupProjectDocker.sh) script
  #### Windows
  - Run this [setupProjectDockerWindows](./setupProjectDocker.bat) script
- Next navigate into the [env](/src/main/env/) directory
  #### Linux, MacOS
  - Run this [createEnv.sh](/src/main/env/createEnv.sh) script
  #### Windows
  - Run this [createEnv.bat](/src/main/env/createEnv.bat) script

- Now navigate to the [docker](./docker/) directory
- Next run this command ````docker-compose up -d````
- Now you are ready and can reach your page under the following url [http://127.0.0.1](http://127.0.0.1/)
  ##### Hint:
    - If the server is running but you cannot reach the index page, try setting up a2enmod manually by running ````a2enmod rewrite```` in the Docker container.
    - Next, you just need to restart the Apache service by running ````service apache2 restart````.
    - Next, you need to restart the container and your server should now be running fine and you can reach it via the above address

### Windows only:
- Download xampp for windows here [Link to apachefriends](https://www.apachefriends.org/)
- When the download has finished run the installer and navigate to your xampp installation path
- Next clone this repository ````git clone https://github.com/KruemelDev/UrlShortener.git````
- Next copy all folders from the main directory in the ````htdocs```` of xampp
- Now you are ready and can reach your page under the following url [http://127.0.0.1](http://127.0.0.1/)
  
## Functions:
- Create new short url
- Redirect to other webpages
  
## TODO: 
- Implement feature to delete urls
- Design webpages

## Database structure:
| Id         | path         | destination                      |
| :----------- | :--------------: | -------------------------: |
| 1 | qj478i | [Link to example.com](http://www.example.com)  |
| 2 | uiOp90 | [Link to google.com](https://www.google.com) |


## Contributors
  - Thomas
  - Lennart
