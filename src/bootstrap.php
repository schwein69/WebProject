<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../PHPMailer/src/Exception.php';
require_once '../PHPMailer/src/PHPMailer.php';
require_once '../PHPMailer/src/SMTP.php';

require_once("../template/functions.php");

require_once('../db/DatabaseHelper.php');


$dbh = new DatabaseHelper('localhost', 'root', '', 'social_network');

?>