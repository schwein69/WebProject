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
$templateParams["title"] = 'Lynkzone - all the people who liked this post';
require '../template/base.php';
?>