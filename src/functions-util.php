<?php
function redirectNotLoggedUser(){
    if(!isset($_SESSION["userid"])){
        header("Location: login.php");
    }
}

function isVideoFormat($extension){
    return $extension == "mp4";
}
?>