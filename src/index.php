<?php
require_once 'bootstrap.php';
    redirectNotLoggedUser();
    $posts = $dbh->getFollowedPosts($_SESSION["idUtente"]);
    $templateParams["content"] = "home.php";
array_push($templateParams["js"],"../js/scrolldown-home.js");
$templateParams["title"] = 'Lynkzone - home'; 
require '../template/base.php';

?>