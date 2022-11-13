<?php
    if(isset($_SESSION['id'])){
        $myUserID=$_SESSION['id'];
        $profilePicture = ($connect->query("SELECT `profile-pic` FROM users WHERE id='$myUserID'"));
        if($profilePicture->num_rows>0){
            $profilePicture=$profilePicture->fetch_assoc()['profile-pic'];
            $profilePictureFolder="uploads/";

            if($profilePicture=='default-user.svg'){
                $profilePictureFolder="img/";
            }
        }
    }
?>
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
                        <img src="<?php echo "http://localhost/homder/".$profilePictureFolder.$profilePicture?>" alt="Foto de perfil" class="profile-picture">
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