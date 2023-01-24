<?php
require_once 'bootstrap.php';
 
//login with cookie
if(isset($_COOKIE["Lynkzone_keepLogin"])){
    $user = $dbh->getUserFunctionHandler()->getUserByKeepConnectionCode($_COOKIE["Lynkzone_keepLogin"]);
    if (!is_null($user)) {
        registerLoggedUser($user);
        header("Location: index.php");
    }
}

//standard login
if(isset($_POST["username"]) && isset($_POST["password"]) && $_POST["username"] !== "" && $_POST["password"] !== ""){
    $user = $dbh->getUserFunctionHandler()->getUserDataLogin($_POST["username"]);
    if(count($user) < 1){
        $templateParams["errormsg"] = "Username inesistente!";
    } else {
        if(password_verify($_POST["password"], $user[0]["pwd"])){
            registerLoggedUser($user[0]);
            //set keep logged
            if(isset($_POST["keepLogin"])){
                //generating unique code
                $code = "";
                do{
                    $code = createRandomCode(256);
                }while(!is_null($dbh->getUserFunctionHandler()->getUserByKeepConnectionCode($code)));
                
                //set cookie time
                $oneDayTime = time()+60*60*24;
                $cookieTime = $oneDayTime * 30;//=30 days
                //saving data on client and on server
                setcookie("Lynkzone_keepLogin",$code, $cookieTime,'/');
                $dbh->getUserFunctionHandler()->updateKeepLogin($user[0]['idUtente'],$code);
            }
        }else{
            $templateParams["errormsg"] = "Credenziali errate!";
        }
    }
}
if(isUserLoggedIn()){
    header("Location: index.php");
}else{
    $templateParams["content"] = "login-template.php";
    $templateParams["loginTopNav"]=true;
    $templateParams["loginBottomNav"]=true;
   
}
$templateParams["js"] = array("../js/languageOnChange.js");
$templateParams["title"] = 'Lynkzone - login'; 
require '../template/base.php';
?>