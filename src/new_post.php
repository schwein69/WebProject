<?php
require_once 'bootstrap.php';

//check params and session
redirectNotLoggedUser();

$templateParams["content"] = 'create_post.php'; 
$templateParams["title"] = 'Lynkzone - nuovo post'; 
require '../template/base.php';
?>