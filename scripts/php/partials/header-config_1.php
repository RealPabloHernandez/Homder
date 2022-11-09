<?php
    include '../Homder/config.php';

    $err_login=false;
    $postLink="";
    session_start();

    $inSession=false;

    if(isset($_SESSION['id'])){
        $currentUserID=$_SESSION['id'];
        $exist=$connect->query("SELECT * FROM users WHERE id=$currentUserID");
        if($exist->num_rows>0){
            $inSession=true;
            $postLink='href="http://localhost/homder/property.php"';
            while ($row=$exist->fetch_assoc()){
                $_SESSION['profile-pic']=$row['profile-pic'];
            }

        }
    }


    include '../Homder/scripts/php/login.php';
    include '../Homder/scripts/php/signin.php';
?>
