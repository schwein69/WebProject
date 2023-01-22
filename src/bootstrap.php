<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
define("UPLOAD_DIR", "../imgs/uploads/");
require_once '../PHPMailer/src/Exception.php';
require_once '../PHPMailer/src/PHPMailer.php';
require_once '../PHPMailer/src/SMTP.php';

require_once('../db/DatabaseHelper.php');
require_once('../util/functions-util.php');


$dbh = new DatabaseHelper('localhost', 'root', '', 'social_network');

//include language
if(isset($_SESSION["idUtente"])){
    $_SESSION["lang"] = $dbh->getUserFunctionHandler()->getUserData($_SESSION["idUtente"])["lang"];
} else {
    $_SESSION["lang"] = 'en';
}

include "../lang/".$_SESSION["lang"].".php";

?>