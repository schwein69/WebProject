<?php
require_once "bootstrap.php";
session_destroy(); //destroy the session
header("Refresh: 2; url=login.php");
?>
<script>
    localStorage.clear();
</script>