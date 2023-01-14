<?php
require_once 'bootstrap.php';

//check params and session
redirectNotLoggedUser();

$templateParams["content"] = 'create_post.php'; 
$templateParams["title"] = 'Lynkzone - nuovo post'; 
$templateParams["js"] = array();
array_push($templateParams["js"], "../js/post_creation_buttons.js", "../js/functions.js");
require '../template/base.php';
?>