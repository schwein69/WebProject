<?php
require_once 'bootstrap.php';

if(isset($_POST["username"]) && isset($_POST["password"]) && $_POST["username"] !== "" && $_POST["password"] !== ""){
    $login_result = $dbh->checkLogin($_POST["username"],$_POST["password"]);
    if(count($login_result)==0){
        echo '<script>
         alert("Credenziali errate!");
         </script>';
    }else{
        registerLoggedUser($login_result[0]);
    }
}
if(isUserLoggedIn()){
    header("Location: index.php");
}else{
    $templateParams["content"] = "login-template.php";
    $templateParams["loginTopNav"]=true;
    $templateParams["loginBottomNav"]=true;
   
}
require '../template/base.php';

?>