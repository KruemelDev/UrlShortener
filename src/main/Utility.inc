<?php

function getEnvVariables()
{
    global $envVariables;

    $envFilePath = 'env/.env';

    if (!file_exists($envFilePath)) {
        die('Server error');
    }

    $envContent = file_get_contents($envFilePath);

    $envLines = explode("\n", $envContent);

    $envVariables = [];
    foreach ($envLines as $line) {
        if (empty($line) || strpos($line, '#') === 0) {
            continue;
        }

        list($key, $value) = explode('=', $line, 2);

        $envVariables[trim($key)] = trim($value);
    }
    return $envVariables;
}