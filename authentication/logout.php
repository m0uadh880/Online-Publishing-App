<?php
set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT']);
session_start();
unset($_SESSION["user"]);
unset($_SESSION["name"]);
header('location: /index.php');
?>
