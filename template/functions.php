<?php

function registerLoggedUser($user){
    $_SESSION["idUtente"] = $user["idUtente"];
    $_SESSION["username"] = $user["username"];
}

function isUserLoggedIn(){
    return !empty($_SESSION['idUtente']);
}


?>