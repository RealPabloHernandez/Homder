<?php
    $err_login=false;
    $postLink="";
    session_start();

    $inSession=false;

    if(isset($_SESSION['id'])){
        $inSession=true;
        $postLink='href="http://localhost/homder/property.php"';
    }

    include '../Homder/config.php';
    include '../Homder/scripts/php/login.php';
    include '../Homder/scripts/php/signin.php';
?>
