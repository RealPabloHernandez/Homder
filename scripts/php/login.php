<?php
    include 'lib/config.php';

    if(isset($_POST['login'])){
        $email=mysqli_real_escape_string($connect, $_POST['email']);
        $email=strip_tags($email);

        $password=md5($_POST['password']);
        $password=mysqli_real_escape_string($connect, $password);
        $password=strip_tags($password);

        $query=mysqli_query($connect,"SELECT * FROM user as u WHERE u.email='$email' AND u.password='$password'");

        if(mysqli_num_rows($query)==1){
            while($row=mysqli_fetch_array($query)){
                $_SESSION['id'] = $row['id'];
            }
        }
        else{
            $message="Los datos ingresados no coinciden con nuestros registros.";
            $err_login=true;
        }

        header('location: http://localhost/homder');
    }
?>