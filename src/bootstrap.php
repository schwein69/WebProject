<?php
session_start();
define('UPLOAD_DIR', '../imgs/uploads/');

require_once('../db/DatabaseHelper.php');
require_once('functions-util.php');

$dbh = new DatabaseHelper('localhost', 'root', '', 'social_network');
?>