<?php
require_once 'bootstrap.php';
//check login
redirectNotLoggedUser();
$templateParams["user"] = $dbh->getUserFunctionHandler()->getUserData($_SESSION["idUtente"]);
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["submit"])) {
    switch ($_POST['form']) {
        case "dataForm": //data form
            if (isset($_POST["name"]) && $templateParams["user"]["username"] != $_POST["name"]) {
                if (!$dbh->getUserFunctionHandler()->checkUsername($_POST["name"])) { //se è settato(di default è quello vecchio) ed è diverso da quello originale, lo aggiorno
                    $dbh->getUserFunctionHandler()->updateUsername($_POST["name"], $_SESSION["idUtente"]);
                } else {
                    $msg = "Username esistente!";
                    $templateParams["errormsg"] = $msg;
                }
            }
            if (isset($_POST["email"]) && $templateParams["user"]["email"] != $_POST["email"]) {
                if (!$dbh->getUserFunctionHandler()->checkEmail($_POST["email"])) {
                    $dbh->getUserFunctionHandler()->updateUserEmail($_POST["email"], $_SESSION["idUtente"]);
                } else {
                    $msg = "Email esistente!";
                    $templateParams["errormsg"] = $msg;
                }
            }
            if (isset($_POST["date"]) && $templateParams["user"]["dataDiNascita"] != $_POST["date"]) {
                $dbh->getUserFunctionHandler()->updateUserBirthday($_POST["date"], $_SESSION["idUtente"]);
            }

            if ($_FILES['newImage']['size'] != 0) {
                $img = $_FILES["newImage"];
                $picPath = UPLOAD_DIR . $templateParams["user"]["idUtente"] . '/profile.' . $templateParams["user"]["formatoFotoProfilo"];
                if (file_exists($picPath)) {
                    unlink($picPath);
                }
                $dbh->getUserFunctionHandler()->updateUserAvatar(strtolower(pathinfo($img["name"], PATHINFO_EXTENSION)), $_SESSION["idUtente"]);
                $userPath = UPLOAD_DIR . $_SESSION["idUtente"] . '/';
                list($result, $fileType, $msg) = uploadFile($userPath, $img, "profile");
            }
            $templateParams["user"] = $dbh->getUserFunctionHandler()->getUserData($_SESSION["idUtente"]);
        break;

        case "passwordForm": //password form
            if (isset($_POST["oldpwd"]) && isset($_POST["pwd"]) && isset($_POST["pwdrepeat"]) && $_POST["pwd"] !== "" && $_POST["pwdrepeat"] !== "") {
                if (password_verify($_POST["oldpwd"], $templateParams["user"]["pwd"])) {
                    if ($_POST["pwd"] == $_POST["pwdrepeat"]) {
                        $pwd = password_hash($_POST["pwd"], PASSWORD_DEFAULT);
                        $dbh->getUserFunctionHandler()->updatePassword($pwd, $templateParams["user"]["idUtente"]);
                    }
                } else {
                    $msg = "Password originale errata!";
                    $templateParams["errormsgPsw"] = $msg;
                }
            }
            $templateParams["user"] = $dbh->getUserFunctionHandler()->getUserData($_SESSION["idUtente"]);
        break;

        case "languageFormSubmission": //language form
            if (isset($_POST["languages"]) && $_POST["languages"] != $_SESSION["lang"]) { //se è diverso da quello già settato  
                $dbh->getUserFunctionHandler()->changeLanguage($templateParams["user"]["idUtente"],$_POST["languages"]);
                $_SESSION["lang"] = $_POST["languages"];
                header("Refresh: 1");
            }
        break;

        case "descriptionFormSubmission": //description form
            if (isset($_POST["textArea"]) && $_POST["textArea"] != $templateParams["user"]["descrizione"]) {
                $dbh->getUserFunctionHandler()->updateUserDescription($templateParams["user"]["idUtente"],$_POST["textArea"]);
                $templateParams["user"] = $dbh->getUserFunctionHandler()->getUserData($_SESSION["idUtente"]);
            }
        break;
    }
}

/*
Preparing posts
*/
$templateParams["posts"] = $dbh->getPostFunctionHandler()->getSavedPosts($_SESSION["idUtente"]);
$templateParams["oldPostIds"] = array();

$numPosts = count($templateParams["posts"]);
for ($i = 0; $i < $numPosts; $i++) {
    array_push($templateParams["oldPostIds"], $templateParams["posts"][$i]["idPost"]);
    $user = $dbh->getUserFunctionHandler()->getUserData($templateParams["posts"][$i]['idUser']);
    $templateParams["posts"][$i]["fotoProfilo"] = UPLOAD_DIR . $user['idUtente'] . '/profile.' . $user['formatoFotoProfilo'];
    $templateParams["posts"][$i]["fotoProfiloAlt"] = "foto profilo di " . $user['username'];
    $templateParams["posts"][$i]["username"] = $user['username'];
    $templateParams["posts"][$i]["isLoggedUserPost"] = $user['idUtente'] == $_SESSION["idUtente"];
    $templateParams["posts"][$i]["followedByMe"] = $dbh->getUserFunctionHandler()->isFollowedByMe($_SESSION["idUtente"], $user['idUtente']);
    $templateParams["posts"][$i]["isFull"] = false;
    $templateParams["posts"][$i]["liked"] = $dbh->getPostFunctionHandler()->isPostLiked($_SESSION["idUtente"], $templateParams["posts"][$i]["idPost"]);
    $templateParams["posts"][$i]["saved"] = $dbh->getPostFunctionHandler()->isPostSaved($_SESSION["idUtente"], $templateParams["posts"][$i]["idPost"]);

    //adding medias to post
    $templateParams["posts"][$i]["mediaPath"] = UPLOAD_DIR . $user['idUtente'] . '/' . $templateParams["posts"][$i]["idPost"] . '/';
    $media = $dbh->getPostFunctionHandler()->getPostContents($templateParams["posts"][$i]["idPost"]);

    for ($m = 0; $m < count($media); $m++) {
        $media[$m]["isImage"] = isImageExtension($media[$m]["formato"]);
    }
    $templateParams["posts"][$i]["media"] = $media;
}


$templateParams["user"]["profilePic"] = UPLOAD_DIR . $templateParams["user"]["idUtente"] . '/profile.' . $templateParams["user"]["formatoFotoProfilo"];
$templateParams["content"] = "settings-template.php";
$templateParams["profileSetting"] = "profileSetting.php";
$templateParams["accountSetting"] = "accountSetting.php";
$templateParams["savedposts"] = "post_template.php";
if($_SESSION["lang"] == "it"){
    $templateParams["privacy"] = 'privacy_it.php';
} else {
    $templateParams["privacy"] = 'privacy_en.php';
}
$templateParams["profileTopNav"] = true;
$templateParams["title"] = 'Lynkzone - Settings';
$templateParams["js"] = array("../js/functions.js", "../js/theme.js", "../js/email-checker.js", "../js/updateUserData.js", 
"../js/scrolldown-savedPost.js", "../js/like.js", "../js/savePost.js", "../js/newPassword-checker.js","../js/removePost.js","../js/follow-event.js","../js/sharePost.js","../js/setting_tabs.js");
require '../template/base.php';

?>