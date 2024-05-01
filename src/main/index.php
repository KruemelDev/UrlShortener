<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="js/script.js"></script>
        <title>UrlShorter</title>
        <link rel="stylesheet" type="text/css" href="css/style.css"/>
    </head>
    <body>
        <h1><p class="text-center">UrlShortener</p></h1>
        <h2 class="text-center">TargetUrl</h2>
        <h3><p style="visibility: hidden" class="text-center text-primary" id="displayTargetUrlText"> qwer</p></h3>
        <p></p>

        <form id="urlInputForm" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <div class="alignCenterForm">
                <div class="w-30 p-3">
                    <div class="form-floating mb-3">
                        <input name="targetUrl" type="url" class="form-control" id="urlInput" placeholder="Url" oninput="displayFormInput()">
                        <label for="floatingInput">Url</label>

                    </div>
                </div>
                <button class="btn btn-primary" type="submit">Submit</button>
            </div>


        </form>
    </body>
</html>

<?php
class DatabaseCommands{
    public $serverName;
    public $databaseUsername;
    public $databasePassword;
    public $databaseName;

    public $conn;

    function __construct($serverName, $databaseUsername, $databasePassword, $databaseName) {
        $this->serverName = $serverName;
        $this->databaseUsername = $databaseUsername;
        $this->databasePassword = $databasePassword;
        $this->databaseName = $databaseName;
    }
    function Connect()
    {
        $this->conn = new mysqli($this->serverName, $this->databaseUsername, $this->databasePassword, $this->databaseName);
        if ($this->conn->connect_error) {
            die(500);
        }
    }
    function CloseConnection(){
        $this->conn->close();
    }
    function CreateDatabase($name)
    {
        $createDatabaseQuery = "CREATE DATABASE IF NOT EXISTS $name";
        $this->conn->query($createDatabaseQuery);
    }
    function CreateTable($name){
        $createTableQuery = "CREATE TABLE IF NOT EXISTS $name (Id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,ShortUrl varchar(255),TargetUrl varchar(255)";
        $this->conn->query($createTableQuery);
    }

}

if (isset($_POST['targetUrl'])) {
    $targetUrl = $_POST['targetUrl'];
    $database = new DatabaseCommands("127.0.0.1", "root", "123456","UrlShortener");
    $database->Connect();


}
function CalculateShortUrl()
{

}
?>