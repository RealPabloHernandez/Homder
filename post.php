<!DOCTYPE html>

<?php
include 'scripts/php/partials/header-config_1.php';

if(!(isset($_SESSION['id']) || isset($_GET['id']))){
   header("location: http://localhost/homder/");
}

$message="";
if(isset($_GET['message'])){
    $message=$_GET['message'];
    $err_login=filter_var($_GET['err'], FILTER_VALIDATE_BOOLEAN);
}
$post_id=$_GET['id'];
$posts=$connect->query("SELECT * FROM posts WHERE id=$post_id");
if($posts->num_rows>0){
    $post=$posts->fetch_assoc();
    $post_userID=$post['userID'];
    $users=$connect->query("SELECT * FROM users WHERE id=$post_userID");
    if($users->num_rows>0){
        $author=$users->fetch_assoc();

        $thisProfilePicture=$author['profile-pic'];
        $thisProfilePictureFolder="uploads/";

        if($thisProfilePicture=='default-user.svg'){
            $thisProfilePictureFolder="img/";
        }


        $imagesPHP=$connect->query("SELECT * FROM post_images WHERE post_id=$post_id");
    }
    else{
        post_notFound();
    }
} else{
    post_notFound();
}

function post_notFound(){
    header("location: http://localhost/homder/");
}
?>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Encuentra o publica fácil y rápido apartamentos disponibles en tu lugar de preferencia.">
    <title>Homder - <?php echo $post['title']?>Publicación</title>

    <link rel="stylesheet" href="styles/css//03_pages/post.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    
    <link rel="icon" href="img/favicon/favicon.ico" sizes="any">
    <link rel="icon" href="img/favicon/favicon.svg" type="image/svg+xml">
    <script src="scripts/javascript/post.js"></script>
</head>
<body>
    <?php include "scripts/php/partials/header.php";?>

    <main>
        <div class="post">
            <div class="post__presentation">
                <div class="post__info">
                    <h2 class="post__title"><?php echo $post['title']?></h2>
                    <div class="location"><?php echo $post['location']?></div>
                </div>
                <div class="post__images">
                    <?php
                    if(!$imagesPHP->num_rows>0){
                        $preview="http://localhost/Homder/img/default-photo.svg";?>
                        <img class="post__image" src="<?php echo $preview?>" alt="El creador de la publicación no subió fotos.">
                    <?php }
                    else{
                        $first=true;
                        while($row=$imagesPHP->fetch_assoc()){
                            if($first){
                                $first=false;
                                ?>
                                <img class="post__image" src="<?php echo "http://localhost/homder/uploads/".$row['file_name']?>" alt="Previsualización de las imágenes asociadas a la publicación.">
                        <?php
                            }
                        ?>
                            <script>addToGallery('<?php echo "http://localhost/homder/uploads/".$row['file_name'];?>')</script>
                        <?php
                        }
                        ?>
                    <?php

                    }
                    ?>
                </div>
            </div>

            <div>
                <div class="post__description">
                    <h3 class="post__price"><?php echo $post['price'];?></h3>
                    <h3 class="post__section">Descripción general</h3>
                    <?php echo $post['description']?>
                    <h3 class="post__section">Contiene</h3>
                    <?php
                    if(isset($post['rooms'])){
                        echo '<div class="feature rooms">'. $post['rooms'] .'</div>';
                    }

                    if(isset($post['bathrooms'])){
                        echo '<div class="feature bathrooms">'. $post['bathrooms'] .'</div>';
                    }

                    if(isset($post['innerArea'])){
                        echo '<div class="feature area-inside">'. $post['innerArea'] .'m²</div>';
                    }

                    if(isset($post['outerArea'])){
                        echo '<div class="feature area-outside">'. $post['outerArea'] .'m²</div>';
                    }
                    ?>
                </div>
                <div class="contact" onclick="window.location='http://localhost/homder/profile.php?id=<?php echo $author['id']?>';">
                    <div class="contact__author">
                        <image class="contact__profile" src="<?php echo "http://localhost/homder/".$thisProfilePictureFolder.$thisProfilePicture?>"></image>
                        <h3 class="contact__name"><?php echo $author['name']?></h3>
                    </div>
                    <div class="contact__data">
                        <a class="contact__phone"></a>
                        <a class="contact__email"></a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        document.querySelector(".post__images").addEventListener("click", (e)=>{
            e.stopPropagation()
            openGallery();
        });
    </script>
    <script src="scripts/javascript/access.js"></script>
    <?php
        include 'scripts/php/partials/header-config_2.php';
    ?>
</body>
</html>