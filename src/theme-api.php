<?php 
require_once 'bootstrap.php';

$theme=$_POST["newTheme"];
$_SESSION["theme"] = $theme;
$dbh->changeTheme($_SESSION["idUtente"], $theme);
header('Content-Type: application/json');
echo json_encode(true);
?>