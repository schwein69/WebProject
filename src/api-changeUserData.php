<?php 
require_once 'bootstrap.php';

$userData = $dbh->getUserData($_SESSION["idUtente"]);
$result;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST["name"]) && $userData["username"] != $_POST["name"]) {
        if (!$dbh->checkUsername($_POST["name"])) { //se è settato(di default è quello vecchio) ed è diverso da quello originale, lo aggiorno
            $dbh->updateUsername($_POST["name"], $_SESSION["idUtente"]);
        } else {
            $msg = "Username esistente!";
            $result["errormsg"] = $msg;
        }
    }
    if (isset($_POST["email"]) && $userData["email"] != $_POST["email"]) {
        if (!$dbh->checkEmail($_POST["email"])) {
            $dbh->updateUserEmail($_POST["email"], $_SESSION["idUtente"]);
        } else {
            $msg = "Email esistente!";
            $result["errormsg"] = $msg;
        }
    }
    if (isset($_POST["date"]) && $userData["dataDiNascita"] != $_POST["date"]) {
        $dbh->updateUseBirthday($_POST["date"], $_SESSION["idUtente"]);
    }
   
    if($_FILES['newImage']['size'] != 0){
        $img = $_FILES["newImage"];
        $dbh->updateUserAvatar(strtolower(pathinfo($img["name"], PATHINFO_EXTENSION)),$_SESSION["idUtente"]);
        $userPath = UPLOAD_DIR . '/' . $_SESSION["idUtente"] . '/';
        list($result, $fileType, $msg) = uploadFile($userPath, $img, "profile");
    } 
}

header('Content-Type: application/json');
echo json_encode($result);
?>