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
        <h1 id="heading" class="text-center">UrlShortener</h1>

        <div class="outputUrlAlignment text-center bg-body-secondary p-4 shadow rounded">
            <h2>Output</h2>
            <?php
            for ($i=0; $i<1; $i++) {
                if (isset($_POST['targetUrl'])) {
                    $targetUrl = $_POST['targetUrl'];
                    if(!filter_var($targetUrl, FILTER_VALIDATE_URL)){
                        echo "<h3 class='text-danger'>Please enter a valid url</h3>";
                        break;

                    }
                    $database = new DatabaseCommands("192.168.66.58", "admin", "1234","UrlShortener");
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
            <h2 class="text-center">TargetUrl</h2>
            <h3 style="visibility: hidden" class="text-center text-primary" id="displayTargetUrlText">qwer</h3>
            <form id="urlInputForm" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" >
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
        $this->conn = new mysqli($this->serverName, $this->databaseUsername, $this->databasePassword, $this->databaseName, 3306);
        if ($this->conn->connect_error) {
            die(500);
        }
    }
    function CloseConnection(){
        $this->conn->close();
    }
    function CreateTable($name){
        $createTableQuery = "CREATE TABLE IF NOT EXISTS $name (id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,shortUrl varchar(255),targetUrl varchar(255))";
        $this->conn->query($createTableQuery);
    }

    function InsertUrl($shortUrl, $targetUrl)
    {
        $insertQuery = "INSERT INTO Urls (shortUrl, targetUrl) VALUES ('$shortUrl', '$targetUrl')";
        $this->conn->query($insertQuery);
    }
    function CreateShortUrl()
    {
        do{
        $randomString = $this->CreateRandomString();
        $exists = $this->UrlExists($_SERVER['SERVER_NAME'] . "/" . $randomString);
        }
        while(!$exists);
        return $_SERVER['SERVER_NAME'] . "/" . $randomString;
    }
    public function GetTargetUrlByShortUrl($shortUrl)
    {

    }
    private function UrlExists($url){
        $query = "SELECT * FROM Urls WHERE shortUrl = '$url'";
        $result = $this->conn->query($query);
        if(isset($result)){
            return true;
        }
        else{
            return false;
        }
    }
    private function CreateRandomString(){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < 6; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return $randomString;
    }
}



?>