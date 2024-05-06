<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="js/script.js"></script>
        <title>UrlShorter</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
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
                        <a class="nav-link active" aria-current="page" href="/home">Home</a>
                        <a class="nav-link" href="/deleteUrl">Delete</a>
                        <a class="nav-link" href="#">Redirect</a>
                    </div>
                </div>
            </div>
        </nav>

        <div class="outputUrlAlignment text-center bg-body-secondary p-4 shadow rounded">
            <h2>Output</h2>
            <?php
            include "DatabaseCommands.inc";

            if (isset($_POST['targetUrl'])) {
                $targetUrl = htmlspecialchars($_POST['targetUrl']);
                if(!filter_var($targetUrl, FILTER_VALIDATE_URL)){
                    echo "<h3 class='text-danger'>Please enter a valid url</h3>";

                }
                else{
                    include "Utility.inc";
                    $envVariables = getEnvVariables();
                    $database = new DatabaseCommands($envVariables["SERVER_NAME"], $envVariables["DATABASE_USERNAME"], $envVariables["DATABASE_PASSWORD"], $envVariables["DATABASE_NAME"]);
                    $database->Connect();
                    $database->CreateTable("Urls");
                    $shortUrl = $database->CreateShortUrl();
                    echo "<h3 class='text-success'>$shortUrl</h3>";
                    $database->InsertUrl($shortUrl, $targetUrl);
                    $database->CloseConnection();
                }

            }



            ?>
        </div>
        <div class="alignFormWithTargetUrl">
            <h2 class="text-center">Destination</h2>
            <h3 style="visibility: hidden" class    ="text-center text-primary" id="displayTargetUrlText">qwer</h3>
            <form id="urlInputForm" action="/home" method="post" >
                <div class="bg-body-secondary p-4 shadow rounded align-bottom">
                    <div class="alignCenterForm">
                        <div class="w-30 p-3">
                            <div class="form-floating mb-3">
                                <input name="targetUrl" type="url" class="form-control" id="urlInput" placeholder="Url" oninput="displayFormInput()">
                                <label for="floatingInput">Url</label>

                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </div>

            </form>
        </div>

    </body>
</html>
