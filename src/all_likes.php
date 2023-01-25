<?php
require_once 'bootstrap.php';

redirectNotLoggedUser();
//check parameter and if post exist
if (isset($_GET["idPost"]) && $dbh->getPostFunctionHandler()->getPostData($_GET["idPost"]) != null) {
    $templateParams["likes"] = $dbh->getAllLikes($_GET["idPost"]);
} else {
    header("Location: index.php");
}


$templateParams["content"] = 'like_list.php';
$templateParams["title"] = 'Lynkzone - Likes';
require '../template/base.php';
?>