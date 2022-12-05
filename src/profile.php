<?php
require_once 'bootstrap.php';
//check login
if(!isUserLoggedIn()){
    echo '<script>
    alert("Devi essere loggato!");
    window.location.href="login.php";
    </script>';
} else {
    $templateParams["content"] = "profilepage.php";
    $templateParams["profileTopNav"]=true;
}
require '../template/base.php';
?>