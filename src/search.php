<?php
require_once 'bootstrap.php';
//check login
redirectNotLoggedUser();
$isPost = 0;
$isTag = 0;
if (isset($_GET["searchOption"]) && $_GET["searchOption"] != "" && isset($_GET["searchValue"]) && $_GET["searchValue"] != "") {
    if ($_GET["searchOption"] == "User") {
        $userData = $dbh->getUserFunctionHandler()->getSearchUser($_GET["searchValue"], $_SESSION["idUtente"]);
        $isPost = 0;
        $isTag = 2; //2 = utente
    } elseif ($_GET["searchOption"] == "Tag") {
        $isTag = 1; //1 = ricerca per tag
        $templateParams["tagName"] = $_GET["searchValue"];
        $templateParams["posts"] = $dbh->getPostFunctionHandler()->getSearchTagPosts($templateParams["tagName"], $_SESSION["idUtente"]);
        $isPost = 1;
        $templateParams["oldPostIds"] = array();

        $numPosts = count($templateParams["posts"]);
        for ($i = 0; $i < $numPosts; $i++) {
            array_push($templateParams["oldPostIds"], $templateParams["posts"][$i]["idPost"]);
            $user = $dbh->getUserFunctionHandler()->getUserData($templateParams["posts"][$i]['idUser']);
            $templateParams["posts"][$i]["fotoProfilo"] = UPLOAD_DIR . $user['idUtente'] . '/profile.' . $user['formatoFotoProfilo'];
            $templateParams["posts"][$i]["fotoProfiloAlt"] = getProfilePicAlt($user['username']);
            $templateParams["posts"][$i]["username"] = $user['username'];
            $templateParams["posts"][$i]["isLoggedUserPost"] = $user['idUtente'] == $_SESSION["idUtente"];
            $templateParams["posts"][$i]["followedByMe"] = $dbh->getUserFunctionHandler()->isFollowedByMe($_SESSION["idUtente"], $user['idUtente']);
            $templateParams["posts"][$i]["isFull"] = false;
            $templateParams["posts"][$i]["liked"] = $dbh->getPostFunctionHandler()->isPostLiked($_SESSION["idUtente"], $templateParams["posts"][$i]["idPost"]);
            $templateParams["posts"][$i]["saved"] = $dbh->getPostFunctionHandler()->isPostSaved($_SESSION["idUtente"], $templateParams["posts"][$i]["idPost"]);
            $templateParams["posts"][$i]["tags"] = $dbh->getPostFunctionHandler()->getPostTags($templateParams["posts"][$i]["idPost"]);
            //adding medias to post
            $templateParams["posts"][$i]["mediaPath"] = UPLOAD_DIR . $user['idUtente'] . '/' . $templateParams["posts"][$i]["idPost"] . '/';
            $media = $dbh->getPostFunctionHandler()->getPostContents($templateParams["posts"][$i]["idPost"]);

            for ($m = 0; $m < count($media); $m++) {
                $media[$m]["isImage"] = isImageExtension($media[$m]["formato"]);
            }
            $templateParams["posts"][$i]["media"] = $media;
        }
    }
} else {
    $templateParams["posts"] = $dbh->getPostFunctionHandler()->getRandomPosts($_SESSION["idUtente"]); //random post tranne dell'utente loggato
    $templateParams["oldPostIds"] = array();
    /*
    Preparing posts
    */
    $numPosts = count($templateParams["posts"]);
    for ($i = 0; $i < $numPosts; $i++) {
        array_push($templateParams["oldPostIds"], $templateParams["posts"][$i]["idPost"]);
        $user = $dbh->getUserFunctionHandler()->getUserData($templateParams["posts"][$i]['idUser']);
        $templateParams["posts"][$i]["fotoProfilo"] = UPLOAD_DIR . $user['idUtente'] . '/profile.' . $user['formatoFotoProfilo'];
        $templateParams["posts"][$i]["fotoProfiloAlt"] = getProfilePicAlt($user['username']);
        $templateParams["posts"][$i]["username"] = $user['username'];
        $templateParams["posts"][$i]["isLoggedUserPost"] = $user['idUtente'] == $_SESSION["idUtente"];
        $templateParams["posts"][$i]["followedByMe"] = $dbh->getUserFunctionHandler()->isFollowedByMe($_SESSION["idUtente"], $user['idUtente']);
        $templateParams["posts"][$i]["isFull"] = false;
        $templateParams["posts"][$i]["liked"] = $dbh->getPostFunctionHandler()->isPostLiked($_SESSION["idUtente"], $templateParams["posts"][$i]["idPost"]);
        $templateParams["posts"][$i]["saved"] = $dbh->getPostFunctionHandler()->isPostSaved($_SESSION["idUtente"], $templateParams["posts"][$i]["idPost"]);
        $templateParams["posts"][$i]["tags"] = $dbh->getPostFunctionHandler()->getPostTags($templateParams["posts"][$i]["idPost"]);
        //adding medias to post
        $templateParams["posts"][$i]["mediaPath"] = UPLOAD_DIR . $user['idUtente'] . '/' . $templateParams["posts"][$i]["idPost"] . '/';
        $media = $dbh->getPostFunctionHandler()->getPostContents($templateParams["posts"][$i]["idPost"]);

        for ($m = 0; $m < count($media); $m++) {
            $media[$m]["isImage"] = isImageExtension($media[$m]["formato"]);
        }
        $templateParams["posts"][$i]["media"] = $media;
    }
    $isPost = 1;
    $isTag = 0; //0 = random
}

$templateParams["isTag"] = $isTag;
$templateParams["selector"] = $isPost;
$templateParams["title"] = 'Lynkzone - search';
$templateParams["content"] = "search-template.php";
$templateParams["js"] = array("../js/functions.js", "../js/like.js", "../js/follow-event.js", "../js/scrolldown-search.js", "../js/livesearch.js", "../js/savePost.js", '../js/notifications_receiver.js', "../js/sharePost.js");
require '../template/base.php';

?>