<?php
require_once 'bootstrap.php';
redirectNotLoggedUser();
$posts = $dbh->getFollowedPosts($_SESSION["idUtente"]);
$templateParams["content"] = "home.php";
$templateParams["js"] = array("../js/like.js",
                            "../js/settings.js",
                            "../js/functions.js",
                            "../js/follow-event.js",
                            "../js/scrolldown-home.js");
$templateParams["title"] = 'Lynkzone - home'; 
require '../template/base.php';

?>