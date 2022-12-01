<?php
session_start();

require_once('../db/DatabaseHelper.php');

$dbh = new DatabaseHelper('localhost', 'root', '', 'social_network');
?>