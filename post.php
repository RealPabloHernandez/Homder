<!DOCTYPE html>

<?php
include 'scripts/php/partials/header-config_1.php';

if(!isset($_SESSION['id'])){
   header("location: http://localhost/homder/");
}

else{
    $message="";
    if(isset($_GET['message'])){
        $message=$_GET['message'];
        $err_login=filter_var($_GET['err'], FILTER_VALIDATE_BOOLEAN);
    }
}

?>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Encuentra o publica fácil y rápido apartamentos disponibles en tu lugar de preferencia.">
    <title>Homder - Publicación</title>

    <link rel="stylesheet" href="css//03_pages/property.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    
    <link rel="icon" href="img/favicon/favicon.ico" sizes="any">
    <link rel="icon" href="img/favicon/favicon.svg" type="image/svg+xml">
</head>
<body>
    
    <header class="header">
        <a href="http://localhost/homder/" class="header__logo">
            <img alt="Homder Logo" class="logo">
        </a>
        <div class="header__options">
            <div class="header__principal">
                <a <?php echo $postLink?> id="make-a-post" class="header__button button button--green">Publica</a>
                <?php if($inSession){?>
                    <div class="header__profile__container">
                        <div class="header__profile">
                            <img alt="Foto de perfil" class="profile-picture">
                        </div>

                        <button class="header__menubtn button button--darkgray button--small button--semiradius" aria-label="Abrir menú">
                            <img class="menu-icon menu-icon--small"src="img\icons\caret-down-solid.svg" alt="">
                        </button>
                    </div>
                <?php }?>
                
                <?php if(!$inSession){?>
                    <div class="header__profile header__profile--session-off">
                        <a class="link" id="access-ref">Acceder</a>
                    </div>
                <?php }?>
                
            </div>
        </div>

        <?php
        if($inSession){
        ?>
            <div class="menu menu--hidden">
                <div class="menu__list">
                    <a href="profile.php?id=<?php echo($_SESSION['id'])?>" class="menu-item link link--white link--wordspace link--noafter"><img class="menu-icon profile" alt="Icon"> Ver perfil</a>
                    <a href="scripts\php\logout.php" class="menu-item link link--white link--wordspace link--noafter"><img class="menu-icon logout" alt="icon">Cerrar sesión</a>
                </div>
            </div>
        <?php
        }
        ?>
    </header>

    <script src="scripts/javascript/cards.js"></script>
    <script src="scripts/javascript/access.js"></script>
    <?php
        include 'scripts/php/partials/header-config_2.php';
    ?>
</body>
</html>