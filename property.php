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
$reference="property";
$submitValue="Publicar";
if(isset($_GET['edit'])){
    $reference="editProperty";
    $submitValue="Guardar";
    $post_ID = $_GET['id'];
    $edit=$connect->query("SELECT * FROM posts WHERE id=$post_ID");
    if($edit->num_rows>0){
        $row=$edit->fetch_assoc();
        if($row['userID']==$_SESSION['id']){
            $title="value='".$row['title']."'";
            $description=$row['description'];
            $location="value='".$row['location']."'";
            $price="value='".$row['price']."'";
            $rooms="value='".$row['rooms']."'";
            $bathrooms="value='".$row['bathrooms']."'";
            $innerArea="value='".$row['innerArea']."'";
            $outerArea="value='".$row['outerArea']."'";
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
    <script src="scripts/javascript/property.js" defer></script>
</head>
<body>
    <?php include "scripts/php/partials/header.php";?>

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
                        <textarea name="description" id="description" maxlength="500" rows="5" pattern="^.{16,}$" title="Ingrese un mínimo de 16 caracteres"  required><?php echo $description;?></textarea>
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
                        <div class="inputGroup">
                            <label for="rooms">Habitaciones</label>
                            <input type="number" min="0" name="rooms" id="rooms" <?php echo $rooms?> autocomplete="off">
                        </div class="inputGroup">
                        <div class="inputGroup">
                            <label for="bathrooms">Baños</label>
                            <input type="number" min="0" name="bathrooms" id="bathrooms" <?php echo $bathrooms?> autocomplete="off">
                        </div class="inputGroup">
                        <div class="inputGroup">
                            <label for="inArea">Área interior(m²)</label>
                            <input type="number" min="0" name="innerArea" id="inArea" <?php echo $innerArea?> autocomplete="off">
                        </div class="inputGroup">
                        <div class="inputGroup">
                            <label for="outArea">Área exterior(m²)</label>
                            <input type="number" min="0" name="outerArea" id="outArea" <?php echo $outerArea?> autocomplete="off">
                        </div class="inputGroup">
                    </fieldset>

                    <fieldset class="filesField">
                        <legend>Adjuntar archivos<span class="obligatory">*</span></legend>
                        <div>
                            <input type="file" name="files[]" id="postFiles" accept="image/jpg,image/png,image/jpeg,image/gif, image/webp" multiple required>
                            <label class="fileLabel" for="postFiles">Examinar</label>
                            <small class="fileText">Sin archivos seleccionados</small>
                        </div>
                    </fieldset>

                    <label class="termsLabel" for="terms">
                        ¿Aceptas que se muestre tu información de contacto en la publicación?<span class="obligatory">*</span><input type="checkbox" name="terms" id="terms" required>
                    </label>
                    <input type="hidden" name="postID" value="<?php echo $post_ID?>">
                    <input type="submit" class="button button--green button--large" value="<?php echo $submitValue?>" name="<?php echo $reference?>">
            </form>
        </div>
    </main>

    <script src="scripts/javascript/access.js"></script>
    <?php
        include 'scripts/php/partials/header-config_2.php';
    ?>
</body>
</html>