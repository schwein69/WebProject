<?php
require_once 'bootstrap.php';
//check login
if (!isUserLoggedIn()) {
    echo '<script>
    alert("Devi essere loggato!");
    window.location.href="login.php";
    </script>';
}
$posts = $dbh->getRandomPosts(5,$_SESSION["idUtente"]);
$templateParams["content"] = "search-template.php";
require '../template/base.php';

?>