<?php
session_start();
include $_SERVER["DOCUMENT_ROOT"]."/homder/config.php";
if(isset($_GET['id'])){
    $postID=$_GET['id'];
    $posts=$connect->query("SELECT * FROM posts WHERE id= $postID");
    $post=$posts->fetch_assoc();
    if($post['userID']==$_SESSION['id']){
        $images = $connect->query("SELECT pi.file_name FROM post_images as pi WHERE post_id = $postID");
        while($row=$images->fetch_assoc()){
            unlink($_SERVER['DOCUMENT_ROOT']."/homder/uploads/".$row['file_name']);
        }

        $images = $connect->query("DELETE FROM post_images WHERE post_id = $postID");
        $posts=$connect->query("DELETE FROM posts WHERE id=$postID");
    }
}

header("location: http://localhost/homder/");
