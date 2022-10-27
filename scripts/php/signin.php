<?php
    include 'lib/config.php';
    
    if(isset($_POST['signin'])){
        $name=mysqli_real_escape_string($connect, $_POST['name']);
        $email=mysqli_real_escape_string($connect, $_POST['email']);
        $password=md5(mysqli_real_escape_string($connect, $_POST['password']));

        $checkEmail=mysqli_num_rows(mysqli_query($connect, "SELECT email FROM user as u WHERE u.email='$email'"));

        if($checkEmail >=1){
            $message= "El correo ingresado está en uso, por favor escoja otro o inicie sesión.";
            $err_login=false;
        }

        else{
            $insert=mysqli_query($connect, "INSERT INTO user (name, email, password) values ('$name', '$email', '$password')");

            if(!$insert){
                $message="No se pudo realizar el registro. Inténtelo de nuevo más tarde.";
                $err_login=false;
            }
        }

        header('location: http://localhost/homder');
    }
?>