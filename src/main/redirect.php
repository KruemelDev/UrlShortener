<?php
$code = $_SERVER['REQUEST_URI'];

if ($code == $_SERVER["PHP_SELF"]){
    str_replace($_SERVER["PHP_SELF"],"", $code);
    if ($code != ""){
        redirect($code);
    }
}
else{
    redirect($code);
}


function redirect($code){
    $database = new DatabaseCommands("192.168.66.58", "admin", "1234","UrlShortener");
    $database->Connect();
    $targetUrl = $database->GetTargetUrlByShortUrl($_SERVER['SERVER_NAME'] . "/" . $code);
    $database->CloseConnection();
    header("Location: $targetUrl");
    die();
}
