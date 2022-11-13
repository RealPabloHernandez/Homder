<?php
include('../../config.php');
session_start();

if(isset($_POST['property']) || isset($_POST['editProperty'])){
    $title=$_POST['title'];
    $description=$_POST['description'];
    $location=$_POST['location'];
    $price=$_POST['price'];
    $rooms=$_POST['rooms'];
    $bathrooms=$_POST['bathrooms'];
    $innerArea=$_POST['innerArea'];
    $outerArea=$_POST['outerArea'];
    $userID=$_SESSION['id'];
    $title=filter($connect, $title);
    $description=filter($connect, $description);
    $location=filter($connect, $location);
    $price=filter($connect, $price);
    $rooms=filter($connect, $rooms);
    $bathrooms=filter($connect, $bathrooms);
    $innerArea=filter($connect, $innerArea);
    $outerArea=filter($connect, $outerArea);
    $userID=filter($connect, $userID);

    $post_info="'".$title."','". $description."','". $location."','".$price."','".$rooms."','".$bathrooms."','".$innerArea."','".$outerArea."','".$userID."'";

    if(isset($_POST['property'])){
        $insertedPost = $connect ->query("INSERT INTO posts (title, description, location, price, rooms, bathrooms, innerArea, outerArea, userID) values ($post_info)");
        $post_ID=$connect->insert_id;
    }

    if(isset($_POST['editProperty'])){
        $post_ID = $_POST['postID'];
        $insertedPost = $connect ->query("UPDATE posts SET title='$title', description='$description', location='$location', price='$price', rooms='$rooms', bathrooms='$bathrooms', innerArea='$innerArea', outerArea='$outerArea' WHERE id = '$post_ID'");
    }


    if($insertedPost){

        if(isset($_POST['editProperty'])){
            $toDelete = $connect->query("SELECT * FROM post_images WHERE post_id=$post_ID");
            if($toDelete->num_rows>0){
                while ($row=$toDelete->fetch_assoc()){
                    $deleted = unlink($_SERVER["DOCUMENT_ROOT"]."/homder/uploads/".$row['file_name']);
                    if($deleted){
                    } else{
                        echo "sorry";
                    }
                }
            }
            $deleted = $connect ->query("DELETE FROM post_images WHERE post_id=$post_ID");
        }

        $_SESSION['message']="";
        $targetDir=$_SERVER["DOCUMENT_ROOT"]."/homder/uploads/";
        $allowTypes = array('jpg','png','jpeg','gif', 'webp');
        $fileNames = array_filter($_FILES['files']['name']);

        if(!empty($fileNames)){
            $insertValuesSQL="";
            foreach($_FILES['files']['name'] as $key=>$val){
                $fileName = basename($_FILES['files']['name'][$key]);
                $extension = pathinfo($fileName, PATHINFO_EXTENSION);

                $fileName= md5(uniqid(rand(), true)) . '.' . $extension;

                $targetFilePath = $targetDir . $fileName;

                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
                if(in_array($fileType, $allowTypes)){
                    if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)){
                        $insertValuesSQL .= "('".$fileName."', NOW(), $post_ID),";
                    }
                }
            }

            if(!empty($insertValuesSQL)){
                $insertValuesSQL = trim($insertValuesSQL, ',');
                $insert = $connect->query("INSERT INTO post_images (file_name, uploaded_on, post_id) VALUES $insertValuesSQL");

                if($insert){
                    header("location: http://localhost/homder/post.php?id=$post_ID");
                    echo "done";
                }else{
                    $_SESSION['message']="Sorry, there was an error uploading your file.";
                    echo $_SESSION['message'];
                }
            }else{
                $_SESSION['message']="Upload failed! ";
            }
        }

    }else{
        $_SESSION['message']="Sorry, there was an error uploading your post.";
    }
} else{
    header("location: http://localhost/homder");
}
echo $_SESSION['message'];

function filter($connection, $text){
    $text=mysqli_real_escape_string($connection, $text);
    $text=strip_tags($text);
    return trim($text);
}

?>