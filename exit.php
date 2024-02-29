<?php
session_start();
unset($_SESSION["role"]);
unset($_SESSION["id_users"]);
unset($_SESSION["login"]);
unset($_SESSION["passw"]);
header("Location:index.php");
?>