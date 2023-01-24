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
        $id = $dbh->getUserFunctionHandler()->insertNewUser($name, $pwd, $email, $date, strtolower(pathinfo($img["name"],PATHINFO_EXTENSION)));
        $userPath = UPLOAD_DIR . '/' . $id . '/';
        mkdir($userPath, 0777, true);
        list($result, $fileType, $msg) = uploadFile($userPath, $img, "profile");//TODO inserire file type nel db
        header("Location: login.php");
    } else {
        if(!$checkUsername != 0){
            $msg= "Username esistente!";
        }else{
            $msg = "Email esistente!";
        }
        $templateParams["errormsg"] = $msg;
    }

   
}
$templateParams["title"] = "Lynkzone - Registration";
$templateParams["content"] = "registration-template.php";
$templateParams["loginTopNav"]=true;
$templateParams["loginBottomNav"]=true;;
$templateParams["js"] = array("../js/registrationchecker.js","../js/functions.js");

require '../template/base.php';



?>