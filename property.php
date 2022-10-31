<!DOCTYPE html>

<?php
session_start();

if(!isset($_SESSION['id'])){
    echo '<script>console.log("No iniciado")</script>';
   header("location: http://localhost/homder/");
}

?>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Encuentra o publica fácil y rápido apartamentos disponibles en tu lugar de preferencia.">
    <title>Homder - Publicar</title>

    <link rel="stylesheet" href="css//03_pages/property.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    
    <link rel="icon" href="img/favicon/favicon.ico" sizes="any">
    <link rel="icon" href="img/favicon/favicon.svg" type="image/svg+xml">
</head>
<body>
    
</body>
</html>