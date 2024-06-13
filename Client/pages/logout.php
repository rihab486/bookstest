<?php
// clear all the session variables and redirect to index
session_start();
session_unset();
session_destroy();
$url = "../server/index.php";
header("Location: $url");
exit();
?>