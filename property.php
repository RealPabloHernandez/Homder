<!DOCTYPE html>

<?php
$postLink=$inSession="";
include 'scripts/php/partials/header-config_1.php';

if(!isset($_SESSION['id'])){
   header("location: http://localhost/homder/");
}

else{
    $message="";
    if(isset($_GET['message'])){
        $message=$_GET['message'];
    }
}

$title=$description=$location=$price=$rooms=$bathrooms=$outerArea=$innerArea="";

//Al editar, obtener los datos de las bases de datos y asignar los valores
//Para las imágenes simplemente se piden de nuevo y se borran las anteriores
if(isset($_POST['EditProperty'])){
    $post_ID = $_POST['postID'];
    $edit=$connect->query("SELECT * FROM posts WHERE id=$post_ID");
    if($edit->num_rows>0){
        $row=$edit->fetch_assoc();
        if($row['userID']==$_SESSION['id']){
            $title=$row['title'];
            $description=$row['description'];
            $location=$row['location'];
            $price=$row['price'];
            $rooms=$row['rooms'];
            $bathrooms=$row['bathrooms'];
            $innerArea=$row['innerArea'];
            $outerArea=$row['outerArea'];
        }

        else{
            header(window.$location.replace);
        }
    }
}

?>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Encuentra o publica fácil y rápido apartamentos disponibles en tu lugar de preferencia.">
    <title>Homder - Publicar</title>

    <link rel="stylesheet" href="styles/css//03_pages/property.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    
    <link rel="icon" href="img/favicon/favicon.ico" sizes="any">
    <link rel="icon" href="img/favicon/favicon.svg" type="image/svg+xml">
    <script src="scripts/javascript/post.js" defer></script>
    <?php
    if($inSession){
        echo '<link rel="stylesheet" href="styles/components/profile.php">';
    }
    ?>
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
        <div class="content">
            <form action="http://localhost/homder/scripts/php/property.php" method="post" class="property-form" enctype="multipart/form-data">
                    <legend class="form__title">¡Publica en Homder totalmente gratis!</legend>
                    
                    <div class="inputGroup">
                        <label for="title">Título de la publicación<span class="obligatory">*</span></label>
                        <input type="text" name="title" id="title" pattern="^.{5,}$" title="Ingrese un mínimo de 5 caracteres" <?php echo $title?>  required>
                    </div class="inputGroup">
                    <div class="inputGroup">   
                        <label for="description">Descripción de la publicación<span class="obligatory">*</span></label>
                        <textarea name="description" id="description" maxlength="500" rows="5" pattern="^.{16,}$" title="Ingrese un mínimo de 16 caracteres" <?php echo $description?>  required></textarea>
                    </div class="inputGroup">
                    <div class="inputGroup">
                        <label for="location">Ubicación de la propiedad</label>
                        <input type="text" name="location" id="location" <?php echo $location?> >
                    </div class="inputGroup">
                    <div class="inputGroup">
                        <label for="price">Precio<span class="obligatory">*</span></label>
                        <input type="text" name="price" id="price" <?php echo $price?> autocomplete="transaction-amount"  required>
                    </div class="inputGroup">

                    <fieldset class="detailsField">
                        <legend>Detalles de la propiedad</legend>
                        <div class="inputGroup" class="">
                            <label for="rooms">Habitaciones</label>
                            <input type="number" min="0" name="rooms" id="rooms" <?php echo $rooms?> autocomplete="off">
                        </div class="inputGroup">
                        <div class="inputGroup" class="">
                            <label for="bathrooms">Baños</label>
                            <input type="number" min="0" name="bathrooms" id="bathrooms" <?php echo $bathrooms?> autocomplete="off">
                        </div class="inputGroup">
                        <div class="inputGroup" class="">
                            <label for="inArea">Área interior(m²)</label>
                            <input type="number" min="0" name="innerArea" id="inArea" <?php echo $innerArea?> autocomplete="off">
                        </div class="inputGroup">
                        <div class="inputGroup" class="">
                            <label for="outArea">Área exterior(m²)</label>
                            <input type="number" min="0" name="outerArea" id="outArea" <?php echo $outerArea?> autocomplete="off">
                        </div class="inputGroup">
                    </fieldset>

                    <fieldset class="filesField">
                        <legend>Adjuntar archivos<span class="obligatory">*</span></legend>
                        <div>
                            <input type="file" name="files[]" id="postFiles" accept="image/jpg,image/png,image/jpeg,image/gif" multiple required>
                            <label class="fileLabel" for="postFiles">Examinar</label>
                            <small class="fileText">Sin archivos seleccionados</small>
                        </div>
                    </fieldset>

                    <label class="termsLabel" for="terms">
                        ¿Aceptas que se muestre tu información de contacto en la publicación?<span class="obligatory">*</span><input type="checkbox" name="terms" id="terms" required>
                    </label>
                    
                    <input type="submit" class="button button--green button--large" value="Publicar" name="property">
            </form>
        </div>
    </main>

    <script src="scripts/javascript/cards.js"></script>
    <script src="scripts/javascript/access.js"></script>
    <?php
        include 'scripts/php/partials/header-config_2.php';
    ?>
</body>
</html>