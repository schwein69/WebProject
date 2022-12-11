<?php
require_once 'bootstrap.php';
//check login
if (!isUserLoggedIn()) {
    echo '<script>
    alert("Devi essere loggato!");
    window.location.href="login.php";
    </script>';
}
$isPost = 0;

if (isset($_GET["searchOption"]) && $_GET["searchOption"] != "" && isset($_GET["searchValue"]) && $_GET["searchValue"] != "") {
    if ($_GET["searchOption"] == "User") {
        $userData = $dbh->getSearchUser($_GET["searchValue"]);
        $isPost = 0;
    } elseif ($_GET["searchOption"] == "Tag") {
        $posts = $dbh->getSearchTagPosts(5, $_GET["searchValue"]);
        $isPost = 1;
    }
} else {
    $posts = $dbh->getRandomPosts(5, $_SESSION["idUtente"]); //random post tranne dell'utente loggato
    $isPost = 1;
}
$templateParams["selector"] = $isPost;
$templateParams["title"] = 'Lynkzone - search'; 
$templateParams["content"] = "search-template.php";
require '../template/base.php';

?>