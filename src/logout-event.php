<?php
require_once "bootstrap.php";
session_destroy(); //destroy the session
$result=true;
header('Content-Type: application/json');
echo json_encode($result);
?>