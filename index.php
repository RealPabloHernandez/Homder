<!DOCTYPE html>
<html lang="es">

<?php
    include 'scripts/php/partials/header-config_1.php';
    $message="";
    if(isset($_GET['message'])){
        $message=$_GET['message'];
        $err_login=filter_var($_GET['err'], FILTER_VALIDATE_BOOLEAN);
    }
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Encuentra o publica fácil y rápido apartamentos disponibles en tu lugar de preferencia.">
    <title>Homder - Inicio</title>

    <link rel="stylesheet" href="css//03_pages/home.css">
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

    <main>
        <form action="" class="search">
            <input type="text" class="text-input text-input--shadow" name="search" placeholder="¿Qué buscas hoy?" aria-label="Busqueda" autocomplete="off" required>
            <input type="submit" class="button button--darkgray button--semiradius button--bigger" value="Buscar">
        </form>

        <div class="content">
            <section class="cards">
                <h2 class="cards__title">Cerca de ti</h2>
                <div class="card">
                    <div class="card__options">
                        <img alt="User" class="card__user">
                        <img alt="Guardar" class="card__save card__saved">
                    </div>
                    <div class="card__info">
                        <div class="card__content">
                            <img alt="Foto" class="card__preview" loading="lazy">

                            <div class="card__text">
                                <h2 class="card__title">Apartamento de dos alcobas en El Socorro</h2>
                                <div class="card__location"> Cartagena, Colombia</div>
                                <div class="card__description">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni ad harum eveniet nemo facere quas quos laboriosam doloribus libero dolorum expedita ab optio, enim, accusantium, minima laborum soluta earum modi?
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium cupiditate nesciunt doloremque nobis quam repellat sunt quae non impedit, aut cumque dolor quaerat fugiat sequi possimus magni architecto tempora eum?
                                </div>
                            </div>
                        </div>

                        <div class="card__properties">
                            <h3 class="card__price">$380,000</h3>
                            <div class="card__features">
                                <div class="card__bedrooms card__feature">
                                    3
                                </div>

                                <div class="card__bathrooms card__feature">
                                    2
                                </div>

                                <div class="card__area-inside card__feature">
                                    360m²
                                </div>

                                <div class="card__area-outside card__feature">
                                    512m²
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                
            </section>
        </div>
        
    </main>

    <script src="scripts/javascript/cards.js"></script>
    <script src="scripts/javascript/access.js"></script>
    <?php
        include 'scripts/php/partials/header-config_2.php';
    ?>
</body>
</html>