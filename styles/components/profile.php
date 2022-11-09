<?php
session_start();
header('Content-Type: text/css');
$profile_picture=$_SESSION['profile-pic'];
?>

.profile-picture{
    content:url("<?php echo $profile_picture?>");
}