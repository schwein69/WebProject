<?php
require_once 'bootstrap.php';

if (isset($_POST["newLanguage"])) {
    $_SESSION["lang"] = $_POST["newLanguage"];
}
header('Content-Type: application/json');
echo json_encode($_SESSION["lang"]);
?>