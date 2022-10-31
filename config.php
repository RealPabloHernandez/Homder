<?php
    $host="localhost";
    $user="root";
    $password="";
    $db="homder";

    $connect=mysqli_connect($host,$user,$password,$db);

    if(!$connect){
        echo("No se ha conectado a la base de datos");
    }

    else{
        $select=mysqli_select_db($connect, $db);
    }
?>