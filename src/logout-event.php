<?php   
session_start(); //to ensure you are using same session
session_destroy(); //destroy the session
$result=true;
header('Content-Type: application/json');
echo json_encode($result);
?>