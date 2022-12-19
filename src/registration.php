<?php

require_once 'bootstrap.php';

if(isset($_POST["submit"])){
    $checkUsername = $dbh->checkUsername($_POST["name"]);
    $checkEmail = $dbh->checkEmail($_POST["email"]);
    if(count($checkUsername)==0 && count($checkEmail)==0){
        $name = $_POST["name"];
        $email = $_POST["email"];
        $date = $_POST["date"];
        $img = UPLOAD_DIR.$_POST["image"];
        $pwd =password_hash($_POST["pwd"], PASSWORD_DEFAULT);

        $id = $dbh->insertNewUser($name, $pwd, $email, $date, $img);
        $userPath=UPLOAD_DIR.'/'.$id["idUtente"].'/'.$postId.'/';
        mkdir($userPath, 0777, true);
    



       ;
        header("Location: login.php");
    } else {
        if(count($checkUsername) != 0){
            $msg= "Username esistente!";
        }else{
            $msg = "Email esistente!";
        }
        $templateParams["errormsg"] = $msg;
    }

   
}

$templateParams["content"] = "registration-template.php";
$templateParams["loginTopNav"]=true;
$templateParams["loginBottomNav"]=true;;
array_push($templateParams["js"],"../js/registrationchecker.js");

require '../template/base.php';



?>