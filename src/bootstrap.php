<?php
session_start();

require_once('../db/Database.php');

$dbh = new DatabaseHelper('localhost', 'root', '', 'social_network');
?>