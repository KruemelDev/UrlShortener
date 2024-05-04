<script>
    function redirectExecute(url){
        window.location.replace(url);
        return true;
    }

</script>

<?php
include "DatabaseCommands.inc";
$code = $_SERVER['REQUEST_URI'];
if ($code == $_SERVER["PHP_SELF"]){
    $code = str_replace("/redirect.php/","", $code);
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
    $shortUrl = $_SERVER['SERVER_NAME'] . $code;
    $targetUrl = $database->GetTargetUrlByShortUrl($shortUrl);
    if ($targetUrl){
        $database->CloseConnection();
        echo "<script>redirectExecute('" . $targetUrl . "')</script>";
        die();
    }
    echo "<script>redirectExecute('http://" . $_SERVER["HTTP_HOST"] . "')</script>";
    $database->CloseConnection();

}?>
