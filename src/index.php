<?php
require_once 'bootstrap.php';

if(!isUserLoggedIn() || !isset($_GET["action"])){
    header("location: login.php");//header: interrompe e riesegue login
}

$templateParams["content"] = "home.php";

require '../template/base.php';

?>