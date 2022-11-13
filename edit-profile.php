<!DOCTYPE html>

<?php
include 'scripts/php/partials/header-config_1.php';
if(!isset($_SESSION['id'])){
    header("location: http://localhost/homder/");
}

$userID=$_SESSION['id'];
$users=$connect->query("SELECT * FROM users WHERE id=$userID");


if(!($users->num_rows>0)){
    header("location: http://localhost/homder/");
}

$user=$users->fetch_assoc();

$thisProfilePicture=$user['profile-pic'];
$thisProfilePictureFolder="uploads/";

if($thisProfilePicture=='default-user.svg'){
    $thisProfilePictureFolder="img/";
}

if(isset($_POST['edit-user'])){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $description=$_POST['description'];

    $target_dir=$_SERVER["DOCUMENT_ROOT"]."/homder/uploads/";
    $fileName=basename($_FILES['image']['name']);
    $imageType=$_FILES['image']['type'];

    $extension = pathinfo($fileName, PATHINFO_EXTENSION);
    $fileName= md5(uniqid(rand(), true)) . '.' . $extension;

    $targetFilePath = $target_dir . $fileName;

    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

    $image_moved=false;
    if(!empty($_FILES["image"]["name"])){
        $allowTypes = array('jpg','png','jpeg','gif', 'webp');

        if(in_array($fileType, $allowTypes)){
            if(move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)){
                $image_moved=true;
            }
        }
    }

    $queryText="UPDATE users SET name='$name', email='$email', description='$description', phone='$phone'";

    if($image_moved){
        $queryText.=", `profile-pic`='$fileName' ";
    }

    $queryText.="WHERE id='$userID'";

    $query=$connect->query($queryText);
    header("location: http://localhost/homder/profile.php?id=$userID");

}

$message="";
if(isset($_GET['message'])){
    $message=$_GET['message'];
    $err_login=filter_var($_GET['err'], FILTER_VALIDATE_BOOLEAN);
}


?>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Encuentra o publica fácil y rápido apartamentos disponibles en tu lugar de preferencia.">
    <title>Homder - <?php echo $user['name'] ?></title>

    <link rel="stylesheet" href="styles/css/03_pages/edit-profile.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="icon" href="img/favicon/favicon.ico" sizes="any">
    <link rel="icon" href="img/favicon/favicon.svg" type="image/svg+xml">
</head>
<body>
    <?php include "scripts/php/partials/header.php";?>

    <main>
        <div class="content">
            <form class="profile-form" method="post" enctype="multipart/form-data">
                <input type="file" name="image" class="profile__picture" id="profile__picture" accept="image/jpg,image/png,image/jpeg,image/gif, image/webp">
                <label for="profile__picture">
                    <img class="profile__picture-image" src="<?php echo "http://localhost/homder/".$thisProfilePictureFolder.$thisProfilePicture?>" alt="Foto de perfil de <?php echo $user['name']?>" class="profile-current-picture">
                </label>

                <input type="text" class="text-input" name="name" id="username" value="<?php echo $user['name']?>" placeholder="Nombre completo" required>
                <input type="email" class="text-input" name="email" autocomplete="username" id="" value="<?php echo $user['email']?>" placeholder="Email" required>
                <input type="tel" class="text-input" name="phone" autocomplete="tel" id="" value="<?php echo $user['phone']?>" pattern="^[0-9].{7,15}$" title="Ingrese un número de 7 a 15 dígitos." placeholder="Número de teléfono">
                <textarea name="description" class="text-input" id="" maxlength="150" rows="5" pattern="^.{16,}$" title="Ingrese un mínimo de 16 caracteres" placeholder="Breve descripción"><?php echo $user['description']?></textarea>
                <input type="submit" class="button button--green button--large" value="Guardar" name="edit-user">
            </form>
        </div>
    </main>


<script>
        let star
    </script>
    <script src="scripts/javascript/access.js"></script>
    <script src="scripts/javascript/edit-profile.js"></script>
    <?php
        include 'scripts/php/partials/header-config_2.php';
    ?>
</body>
</html>