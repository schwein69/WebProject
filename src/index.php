<?php
require_once 'bootstrap.php';
//check login
/*if(!isUserLoggedIn() || !isset($_GET["action"])){
    echo '<script>
    alert("Devi essere loggato!");
    window.location.href="login.php";
    </script>';
}*/

$templateParams["content"] = "home.php";

require '../template/base.php';

?>