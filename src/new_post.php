<?php
require_once 'bootstrap.php';

//check params and session
redirectNotLoggedUser();
$templateParams["submitButtonText"] = $lang["postCreation"];
$templateParams["formTarget"] = "post_creation.php";
$templateParams["content"] = 'create_post.php'; 
$templateParams["title"] = 'Lynkzone - '.$lang["createPost_title"]; 
$templateParams["js"] = array();
array_push($templateParams["js"], "../js/post_creation_buttons.js", "../js/functions.js",'../js/notifications_receiver.js');
require '../template/base.php';
?>