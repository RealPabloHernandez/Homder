<?php
include('../../config.php');
session_start();

if(isset($_POST['property'])){
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
    echo $post_info."<br>";
    $insertPost = $connect ->query("INSERT INTO posts (title, description, location, price, rooms, bathrooms, innerArea, outerArea, userID) values ($post_info)");
    $post_ID=$connect->insert_id;

    if($insertPost){
        $_SESSION['message']="";
        $targetDir="../../uploads/";
        $allowTypes = array('jpg','png','jpeg','gif');
        $fileNames = array_filter($_FILES['files']['name']);
        $insertValuesSQL= '';

        if(!empty($fileNames)){
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
                    $_SESSION['message']= "Files are uploaded successfully.";
                }else{
                    $_SESSION['message']="Sorry, there was an error uploading your file.";
                }
            }else{
                $_SESSION['message']="Upload failed! ";
            }

            echo("¿Error?<:::>".$_SESSION['message']);
        }

    }else{
        $_SESSION['message']="Sorry, there was an error uploading your post.";
    }
}

function filter($connection, $text){
    $text=mysqli_real_escape_string($connection, $text);
    $text=strip_tags($text);
    $text=trim($text);
    return $text;
}

?>