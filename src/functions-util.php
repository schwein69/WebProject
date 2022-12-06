<?php
function redirectNotLoggedUser(){
    if(!isset($_SESSION["userid"])){
        header("Location: login.php");
    }
}

function isVideoFormat($extension){
    return $extension == "mp4";
}
function registerLoggedUser($user){
    $_SESSION["idUtente"] = $user["idUtente"];
    $_SESSION["username"] = $user["username"];
}

function isUserLoggedIn(){
    return !empty($_SESSION['idUtente']);
}
?>