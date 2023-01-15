<?php
require_once 'bootstrap.php';

//check params and session
redirectNotLoggedUser();

$templateParams["post"] = $dbh->getPostData($_GET["postid"]);
if($templateParams["post"]["idUser"] != $_SESSION["idUtente"]){
    header("Location: index.php");
}

$templateParams["post"]["tags"] = $dbh->getPostTags($_GET["postid"]);

$templateParams["content"] = 'create_post.php'; 
$templateParams["title"] = 'Lynkzone - modifica post'; 
$templateParams["js"] = array("../js/post_creation_buttons.js", "../js/functions.js");
require '../template/base.php';
?>