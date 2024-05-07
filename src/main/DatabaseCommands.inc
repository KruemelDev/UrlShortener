<?php

class DatabaseCommands{
    public $serverName;
    public $databaseUsername;
    public $databasePassword;
    public $databaseName;

    private $conn;

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
        $createTableQuery = "CREATE TABLE IF NOT EXISTS $name (id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,shortUrl varchar(255),targetUrl varchar(255), password varchar(255))";
        $this->conn->query($createTableQuery);
    }

    function InsertUrl($shortUrl, $targetUrl, $password)
    {
        $escapedShortUrl = $this->conn->real_escape_string($shortUrl);
        $escapedTargetUrl = $this->conn->real_escape_string($targetUrl);
        $escapedPassword = $this->conn->real_escape_string($password);
        $insertQuery = "INSERT INTO Urls (shortUrl, targetUrl, password) VALUES ('$escapedShortUrl', '$escapedTargetUrl', '$escapedPassword')";
        $this->conn->query($insertQuery);
    }
    function CreateShortUrl()
    {
        do{
            $randomString = $this->CreateRandomString();
            $exists = $this->UrlExists($_SERVER['SERVER_NAME'] . "/" . $randomString);
        }
        while($exists);
        return $_SERVER['SERVER_NAME'] . "/" . $randomString;
    }
    public function GetTargetUrlByShortUrl($shortUrl)
    {
        $escapeShortUrl = $this->conn->real_escape_string($shortUrl);
        $getQuery = "SELECT targetUrl FROM Urls WHERE shortUrl = '" . $escapeShortUrl . "'";
        $result = $this->conn->query($getQuery);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();

            if (isset($row['targetUrl'])) {
                return $row['targetUrl'];
            }
        }
        return false;
    }
    private function UrlExists($url){
        $escapedUrl = $this->conn->real_escape_string($url);
        $query = "SELECT * FROM Urls WHERE shortUrl = '$escapedUrl'";
        $result = $this->conn->query($query);
        if ($result && $result->num_rows > 0) {
            return true;
        }
        return false;
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
    public function ShortUrlExists($shortUrl, $password){
        $escapedShortUrl = $this->conn->real_escape_string($shortUrl);
        $escapedPassword = $this->conn->real_escape_string($password);

        $query = "SELECT password FROM Urls WHERE shortUrl = '" . $escapedShortUrl . "'";
        $result = $this->conn->query($query);

        if ($result && $result->num_rows > 0) {
            while($databaseHashPassword = $result->fetch_assoc()) {
                if(password_verify($escapedPassword, $databaseHashPassword['password'])) {
                    return true;
                }
            }
            return false;
        }
        return false;
    }
    public function GetHashedPassword($shortUrl, $password)
    {
        $escapedShortUrl = $this->conn->real_escape_string($shortUrl);
        $escapedPassword = $this->conn->real_escape_string($password);
        $query = "SELECT password FROM Urls WHERE shortUrl = '" . $escapedShortUrl . "'";
        $result = $this->conn->query($query);

        if ($result && $result->num_rows > 0) {
            while($databaseHashPassword = $result->fetch_assoc()) {
                if(password_verify($escapedPassword, $databaseHashPassword['password'])) {
                    return $databaseHashPassword['password'];
                }
            }
            return false;
        }
        return false;
    }
    public function DeleteShortUrl($shortUrl, $password){
        $escapedShortUrl = $this->conn->real_escape_string($shortUrl);
        $deleteQuery = "DELETE FROM Urls WHERE shortUrl = '$escapedShortUrl' AND password = '$password'";
        if ($this->conn->query($deleteQuery) === TRUE) {
            if ($this->conn->affected_rows > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }

    }
}