<!DOCTYPE html>
<html>
    <head>
        <title>UrlShortener - editUrl</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="js/script.js"></script>
        <link rel="stylesheet" type="text/css" href="css/editUrl.css">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="/home">UrlShortener</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link" aria-current="pFage" href="/home">Home</a>
                        <a class="nav-link" href="/deleteUrl">Delete</a>
                        <a class="nav-link active" href="/editUrl">Edit</a>
                    </div>
                </div>
            </div>
        </nav>
        <div class="alignOutput">

        <?php
        include "DatabaseCommands.inc";
        include "Utility.inc";
        if(isset($_POST["shortUrl"]) && isset($_POST["newUrl"]) && isset($_POST["password"])){
            $shortUrl = htmlspecialchars($_POST["shortUrl"]);
            $newUrl = htmlspecialchars($_POST["newUrl"]);
            $password = htmlspecialchars($_POST["password"]);

            $envVariables = Utility::getEnvVariables('env/.env');
            $database = new DatabaseCommands($envVariables["SERVER_NAME"], $envVariables["DATABASE_USERNAME"], $envVariables["DATABASE_PASSWORD"], $envVariables["DATABASE_NAME"]);
            $database->Connect();
            if(!$database->ShortUrlExists($shortUrl, $password)){
                echo "<h3 class='text-danger text-center'>The password, the shortlink or both do not exist</h3>";
            }else{
                $hashedPassword = $database->GetHashedPassword($shortUrl, $password);
                if(!$hashedPassword){
                    echo "<h3 class='text-danger text-center'>The password, the shortlink or both do not exist</h3>";
                }
                else{
                    if($database->UpdateDestinationUrl($shortUrl, $newUrl, $hashedPassword)){
                        echo "<h3 class='text-success text-center'>The Shortlink was edited successfully</h3>";
                    }
                    else{
                        echo "<h3 class='text-danger text-center'>The link was not edited</h3>";
                    }
                }
    
                $database->CloseConnection();
            }

        }
        ?>
        </div>
        <div class="alignEditUrlForm">
            <h2 class="text-center mb-4">EditDestination</h2>
            <form id="urlEditForm" action="/editUrl" method="post" autocomplete="off">
                <div class="bg-body-secondary p-4 shadow rounded align-bottom">
                    <div>
                    <div class="w-30 p-3">
                            <div class="form-floating mb-3">
                                <input name="shortUrl" type="text" class="form-control" id="urlInput" placeholder="ShortUrl" oninput="displayFormInput()">
                                <label for="floatingInput">ShortUrl</label>
                            </div>
                        </div>
                        <div class="w-30 p-3">
                            <div class="form-floating mb-3">
                                <input name="newUrl" type="text" class="form-control" id="urlInput" placeholder="NewUrl" oninput="displayFormInput()">
                                <label for="floatingInput">NewUrl</label>
                            </div>
                        </div>
                        <div class="w-30 p-3">
                            <div class="form-floating mb-3">
                                <input name="password" type="password" class="form-control" id="urlInput" placeholder="Password">
                                <label for="floatingInput">Password</label>

                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </div>

            </form>
        </div>
    </body>
</html>