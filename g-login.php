<?php
    require_once "GoogleAPI/vendor/autoload.php";
    $gClient = new Google_Client();
    $gClient->setClientID("352985577412-es6ti619a6tpla4dtbsd9h354rh1vpb1.apps.googleusercontent.com");
    $gClient->setClientSecret("v6e9vMqXfonGKNkmdoZZwAD6");
    $gClient->setApplicationName("Newark Fraternity Order of Police");
    $gClient->setRedirectUri("http://localhost:8888/g-callback.php");
    $gClient->addScope("https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/plus.login");

    $login_url = $gClient->createAuthUrl();
?>
