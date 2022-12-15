<?php
require_once 'bootstrap.php';
//check login
redirectNotLoggedUser();
$isPost = 0;
$isTag = 0;
if (isset($_GET["searchOption"]) && $_GET["searchOption"] != "" && isset($_GET["searchValue"]) && $_GET["searchValue"] != "") {
    if ($_GET["searchOption"] == "User") {
        $userData = $dbh->getSearchUser($_GET["searchValue"],$_SESSION["idUtente"]);
        $isPost = 0;
    } elseif ($_GET["searchOption"] == "Tag") {
        $isTag = 1;
        $templateParams["tagName"] = $_GET["searchValue"];
        $posts = $dbh->getSearchTagPosts($_GET["searchValue"]);
        $isPost = 1;
    }
} else {
    $posts = $dbh->getRandomPosts($_SESSION["idUtente"]); //random post tranne dell'utente loggato
    $isPost = 1;
}

$templateParams["isTag"] = $isTag;
$templateParams["selector"] = $isPost;
$templateParams["title"] = 'Lynkzone - search'; 
$templateParams["content"] = "search-template.php";
array_push($templateParams["js"],"../js/scrolldown-event.js");
require '../template/base.php';

?>