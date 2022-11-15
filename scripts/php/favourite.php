<?php
function toggleFavourite($userID, $postID, $connection){
    $favourite=getFavourite($userID, $postID, $connection);
    if(!($favourite->num_rows>0)){
        if($connection->query("INSERT INTO favourites(user_id, post_id) VALUES ('$userID', '$postID')")){
            return true;
        }
    } else{
        if($connection->query("DELETE FROM favourites WHERE user_id='$userID' AND post_id='$postID'")){
            return true;
        }
    }
    return false;
}

function getFavourite($userID, $postID, $connection){
    return $connection->query("SELECT * FROM favourites WHERE user_id='$userID' AND post_id='$postID'");
}
