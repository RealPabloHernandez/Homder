<!DOCTYPE html>
<html lang="es">

<?php
    include 'scripts/php/partials/header-config_1.php';
    include 'scripts/php/favourite.php';
    $message="";
    if(isset($_GET['message'])){
        $message=$_GET['message'];
        if(isset($_GET['err'])){
            $err_login=filter_var($_GET['err'], FILTER_VALIDATE_BOOLEAN);
        }
    }
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Encuentra o publica fácil y rápido apartamentos disponibles en tu lugar de preferencia.">
    <title>Homder - Inicio</title>

    <link rel="stylesheet" href="styles/css//03_pages/home.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    
    <link rel="icon" href="img/favicon/favicon.ico" sizes="any">
    <link rel="icon" href="img/favicon/favicon.svg" type="image/svg+xml">
</head>
<body>
    <?php include "scripts/php/partials/header.php";?>

    <main>
        <form class="search" method="get">
            <input type="search" class="text-input text-input--shadow" name="search" placeholder="¿Qué buscas hoy?" aria-label="Busqueda" autocomplete="off" required>
            <input type="submit" class="button button--darkgray button--semiradius button--bigger" value="Buscar">
        </form>

        <div class="content">
            <section class="cards">
                <h2 class="cards__title">Recomendados</h2>
                <?php
                if(isset($_GET['search'])){
                    $search=$_GET['search'];
                    $posts=$connect->query("SELECT *, p.id as pid, u.id as uid, p.description FROM posts as p INNER JOIN users as u WHERE p.description LIKE '%$search%' OR p.title LIKE '%$search%' OR p.location LIKE '%$search%' OR u.name LIKE '%$search%'  ORDER BY pid DESC");
                }
                else{
                    $posts=$connect->query("SELECT *, p.id as pid, u.id as uid, p.description FROM posts as p INNER JOIN users as u ORDER BY pid DESC");
                }
                if($posts->num_rows>0){
                    while($post=$posts->fetch_assoc()){
                        $thisProfilePicture=$post['profile-pic'];
                        $thisProfilePictureFolder="uploads/";

                        if($thisProfilePicture=='default-user.svg'){
                            $thisProfilePictureFolder="img/";
                        }
                        ?>
                        <div class="card" id="<?php echo $post['id']?>" onclick="window.location='http://localhost/homder/post.php?id=<?php echo $post['pid']?>';" >
                            <div class="card__options">
                                <a><img alt="User" class="card__user" src="<?php echo "http://localhost/homder/".$thisProfilePictureFolder.$thisProfilePicture?>"></a>
                                <a><img alt="Guardar" class="card__save"></a>
                            </div>
                            <div class="card__info">
                                <div class="card__content">
                                    <?php
                                        $preview="http://localhost/Homder/img/default-photo.svg";
                                        $postID=$post['pid'];

                                        $images=$connect->query("SELECT * FROM post_images WHERE post_id='$postID' LIMIT 1");
                                        if($images){
                                            while($img=$images->fetch_assoc()){
                                                $previewFile=$img['file_name'];
                                                if(file_exists("uploads/".$previewFile)){
                                                    $preview="http://localhost/Homder/uploads/".$previewFile;
                                                }
                                            }
                                        }
                                    ?>
                                    <img alt="Foto" class="card__preview" src="<?php echo $preview?>" loading="lazy">

                                    <div class="card__text">
                                        <h2 class="card__title"><?php echo $post['title']?></h2>
                                        <div class="location"><?php echo $post['location']?></div>
                                        <div class="card__description"><?php echo $post['description']?></div>
                                    </div>
                                </div>

                                <div class="card__properties">
                                    <h3 class="card__price" title="<?php echo $post['price']?>"><?php echo $post['price']?></h3>
                                    <div class="card__features">
                                        <div class="rooms feature">
                                            <?php echo $post['rooms']?>
                                        </div>

                                        <div class="bathrooms feature">
                                            <?php echo $post['bathrooms']?>
                                        </div>

                                        <div class="area-inside feature">
                                            <?php echo $post['innerArea']."m²"?>
                                        </div>

                                        <div class="area-outside feature">
                                            <?php echo $post['outerArea']."m²"?>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
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