<?php
require_once 'bootstrap.php';

if(isset($_POST["username"]) && isset($_POST["password"])){
    $login_result = $dbh->checkLogin($_POST["username"],$_POST["password"]);
    if(count($login_result)==0){
        $templateParams["errorelogin"] = "Errore! Credenziali errate";
    }else{
        registerLoggedUser($login_result[0]);
    }
}
if(isUserLoggedIn()){
    $templateParams["content"] = "index.php";
    //$templateParams["articoliProfili"] = $dbh->getPostByAuthorId($_SESSION["idautore"]);
    $templateParams["articoliseguiti"] = $dbh->getFollowedArticle();
    $templateParams["articolicasuali"] = $dbh->getRandomPosts();
}else{
    require '../template/login-template.html';
}


?>