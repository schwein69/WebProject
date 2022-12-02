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
    $templateParams["content"] = "login-template.php";
    $templateParams["loginTopNav"]=true;
    $templateParams["loginBottomNav"]=true;
   
}
require '../template/base.php';

?>