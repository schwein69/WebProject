<?php
require_once 'bootstrap.php';
    redirectNotLoggedUser();
    $posts = $dbh->getFollowedPosts($_SESSION["idUtente"]);
    $templateParams["content"] = "home.php";

$templateParams["js"] = array("../js/functions.js","../js/like.js","../js/follow-event.js","../js/scrolldown-home.js");
$templateParams["title"] = 'Lynkzone - home'; 
require '../template/base.php';

?>