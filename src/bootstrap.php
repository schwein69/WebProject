<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
define("UPLOAD_DIR", "../imgs/uploads/");
require_once '../PHPMailer/src/Exception.php';
require_once '../PHPMailer/src/PHPMailer.php';
require_once '../PHPMailer/src/SMTP.php';

require_once('../db/DatabaseHelper.php');
require_once('../utils/functions-util.php');
require_once('../utils/post_print.php');


$dbh = new DatabaseHelper('localhost', 'root', '', 'social_network');
?>