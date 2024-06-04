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
    include "Utility.inc";
    $envVariables = Utility::getEnvVariables('env/.env');
    $database = new DatabaseCommands($envVariables["SERVER_NAME"], $envVariables["DATABASE_USERNAME"], $envVariables["DATABASE_PASSWORD"], $envVariables["DATABASE_NAME"]);
    $database->Connect();
    $shortUrl = $_SERVER['SERVER_NAME'] . $code;
    $targetUrl = $database->GetTargetUrlByShortUrl($shortUrl);
    $targetUrlDecoded = htmlspecialchars_decode($targetUrl);
    if ($targetUrlDecoded){
        $database->CloseConnection();
        echo "<script>redirectExecute('" . $targetUrlDecoded . "')</script>";
        die();
    }
    echo "<script>redirectExecute('http://" . $_SERVER["HTTP_HOST"] . "')</script>";
    $database->CloseConnection();

}?>
