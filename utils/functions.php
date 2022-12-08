<?phpfunction isUserLoggedIn(){
    return !empty($_SESSION['idUtente']);
}

function registerLoggedUser($user){
    $_SESSION["idUtente"] = $user["idUtente"];
}
?>