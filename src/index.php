<?php
require_once 'bootstrap.php';
//check login
if (!isUserLoggedIn()) {
    echo '<script>
    alert("Devi essere loggato!");
    window.location.href="login.php";
    </script>';
} else {
    $posts = $dbh->getFollowedPosts($_SESSION["idUtente"]);//quelli se seguo io
    $templateParams["content"] = "home.php";
}
$templateParams["title"] = 'Lynkzone - home'; 
require '../template/base.php';

?>