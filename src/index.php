<?php
require_once 'bootstrap.php';
    redirectNotLoggedUser();
    $posts = $dbh->getFollowedPosts($_SESSION["idUtente"]);//quelli se seguo io
    $templateParams["content"] = "home.php";

$templateParams["title"] = 'Lynkzone - home'; 
require '../template/base.php';

?>