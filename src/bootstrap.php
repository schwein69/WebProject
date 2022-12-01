<?php
session_start();

require_once("../template/functions.php");

require_once('../db/DatabaseHelper.php');

$dbh = new DatabaseHelper('localhost', 'root', '', 'social_network');

?>