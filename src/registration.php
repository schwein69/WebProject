<?php

require_once 'bootstrap.php';

//TODO autocrop profile picture 1:1

if(isset($_POST["submit"])){
    $checkUsername = $dbh->getUserFunctionHandler()->checkUsername($_POST["name"])
                    || areThereDangerousChars($_POST["name"])
                    || strpos($_POST["name"]," ") !== false;
    $checkEmail = $dbh->getUserFunctionHandler()->checkEmail($_POST["email"]);
    if(!$checkUsername && !$checkEmail){
        $name = $_POST["name"];
        $email = $_POST["email"];
        $date = $_POST["date"];
        $img = $_FILES["image"];
        $pwd = password_hash($_POST["pwd"], PASSWORD_DEFAULT);
        $id = $dbh->getUserFunctionHandler()->insertNewUser($name, $pwd, $email, $date, strtolower(pathinfo($img["name"],PATHINFO_EXTENSION)),$_SESSION["lang"]);
        $userPath = UPLOAD_DIR . '/' . $id . '/';
        mkdir($userPath, 0777, true);
        list($result, $fileType, $msg) = uploadFile($userPath, $img, "profile");//TODO inserire file type nel db
        header("Location: login.php");
    } else {
        if($checkUsername != 0){
            $msg = $lang["accountSetting_wrongUsernameMsg"];
        }else{
            $msg = $lang["accountSetting_wrongEmailMsg"];
        }
        $templateParams["errormsg"] = $msg;
    }

   
}
$templateParams["content"] = "registration-template.php";
$templateParams["loginTopNav"]=true;
$templateParams["loginBottomNav"]=true;
$templateParams["title"] = 'Lynkzone - '.$lang["Registration"]; 
$templateParams["js"] = array("../js/registrationchecker.js","../js/functions.js","../js/languageOnChange.js");

require '../template/base.php';



?>