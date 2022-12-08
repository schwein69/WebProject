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
        $pwd =$_POST["pwd"];
        $id = $dbh->insertNewUser($name, $pwd, $email, $date, $img);
        if($id!=false){
            $msg = "Inserimento completato correttamente!";
        }
        else{
            $msg = "Errore in inserimento!";
        }
    } else {
        if(count($checkUsername) != 0){
            $msg= "Username esistente!";
        }else{
            $msg = "Email esistente!";
        }
    }
    echo '<script>
    alert("${msg}");
    window.location.href="login.php";
    </script>';
}

$templateParams["content"] = "registration-template.php";
$templateParams["loginTopNav"]=true;
$templateParams["loginBottomNav"]=true;;
   

require '../template/base.php';
echo '<script src="../javascript/registrationchecker.js" type="text/javascript"></script>'

?>