<?php
require_once 'bootstrap.php';
if(isset($_POST["inputValue"]) && $_POST["inputValue"] != "" && isset($_POST["searchValue"]) && $_POST["searchValue"] != ""){
    if($_POST["searchValue"] == "User"){
        $posts = $dbh->getSearchUserPosts(5, $_POST["inputValue"]);
    } else {
        $posts = $dbh->getSearchTagPosts(5, $_POST["inputValue"]);
    }
    header('Content-Type: application/json');
    echo json_encode($posts);
}
?>