<!DOCTYPE html>

<?php
include 'scripts/php/partials/header-config_1.php';

$userID=$_GET['id'];
$users=$connect->query("SELECT * FROM users WHERE id=$userID");

if(!(isset($_SESSION['id']) && $users->num_rows>0)){
   header("location: http://localhost/homder/");
}

$message="";
if(isset($_GET['message'])){
    $message=$_GET['message'];
    $err_login=filter_var($_GET['err'], FILTER_VALIDATE_BOOLEAN);
}

$user=$users->fetch_assoc();
$userID=$user['id'];
?>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Encuentra o publica fácil y rápido apartamentos disponibles en tu lugar de preferencia.">
    <title>Homder - <?php echo $user['name'] ?></title>

    <link rel="stylesheet" href="styles/css/03_pages/profile.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    
    <link rel="icon" href="img/favicon/favicon.ico" sizes="any">
    <link rel="icon" href="img/favicon/favicon.svg" type="image/svg+xml">
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
            <section class="userinfo">
                <img class="userinfo__picture" src="<?php echo $user['profile-pic']?>" alt="Foto de perfil de <?php echo $user['name']?>">

                <div class="userinfo__content">
                    <div class="userinfo__data">
                        <h2 class="userinfo__name"><?php echo $user['name']?></h2>
                        <span class="userinfo__email"><?php echo $user['email']?></span>
                        <?php
                        if(isset($user['description'])){
                        ?>  <p class="userinfo__description"><?php echo $user['description']?></p>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="userinfo__more">
                        <div class="userinfo__contact">
                            <?php
                            if(isset($user['phone'])){
                                echo '<div class="userinfo__phone">'.$user['phone'].'</div>';
                            }
                            ?>
                        </div>
                        <?php
                            $ratingQuery=$connect->query("SELECT `rating` FROM ratings WHERE user_id=$userID");
                            if($ratingQuery->num_rows>0){
                                $rating=$ratingQuery->fetch_assoc();
                            }

                            if($userID==$_SESSION['id']){
                                echo '<a class="userinfo__edit" href=""><img src="" alt="" class="card__edit"></a>';
                            }
                        ?>

                        <div class="rating-container">
                            <div class="rating">
                                <input type="radio" name="rating" id="star5" value="5" class="star">
                                <label for="star5" title="rating">5 Star</label>

                                <input type="radio" name="rating" id="star4" value="4" class="star">
                                <label for="star4" title="rating">4 Star</label>

                                <input type="radio" name="rating" id="star3" value="3" class="star">
                                <label for="star3" title="rating">3 Star</label>

                                <input type="radio" name="rating" id="star2" value="2" class="star">
                                <label for="star2" title="rating">2 Star</label>

                                <input type="radio" name="rating" id="star1" value="1" class="star">
                                <label for="star1" title="rating">1 Star</label>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php
                $posts=$connect->query("SELECT *, p.id as pid, u.id as uid FROM posts as p INNER JOIN users as u WHERE u.id=$userID");
            ?>
            <div class="controls">
                <span><small>Publicaciones: <?php echo $posts->num_rows?></small></span>
                <div class="filters">

                </div>
            </div>

            <section class="cards">
                <?php
                if($posts->num_rows>0){
                    while($post=$posts->fetch_assoc()){
                        ?>
                        <div onclick="window.location='http://localhost/homder/post.php?id=<?php echo $post['pid']?>';" class="card">
                            <div class="card__options card__options--center">
                                <a href="<?php echo "http://localhost/homder/property.php?edit=0&id=".$post['pid']?>"><img alt="Editar" class="card__edit"></a>
                                <a href="<?php echo "http://localhost/homder/scripts/php/deleteproperty.php?id=".$post['pid']?>"><img alt="Eliminar" class="card__delete"></a>
                            </div>
                            <div class="card__info card__info--large-padding">
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

    <script>
        let star
    </script>
    <script src="scripts/javascript/access.js"></script>
    <?php
        include 'scripts/php/partials/header-config_2.php';
    ?>
</body>
</html>