<?php
require_once 'bootstrap.php';
//check login
/*if(!isUserLoggedIn() || !isset($_GET["action"])){
    echo '<script>
    alert("Devi essere loggato!");
    window.location.href="login.php";
    </script>';
}
*/
$templateParams["content"] = "profilepage.php";
$templateParams["profileTopNav"]=true;

require '../template/base.php';
?>