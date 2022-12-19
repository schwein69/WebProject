<?php
require_once 'bootstrap.php';

redirectNotLoggedUser();

$templateParams["content"] = "theme_template.php";
$templateParams["js"] = array("../js/theme.js");
$templateParams["title"] = 'Lynkzone - profile settings'; 
require '../template/base.php';

?>