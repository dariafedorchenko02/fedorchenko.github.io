<?php
session_start();
$role = $row['role'];
include 'temp/db.php';
include 'temp/head.php';
include 'temp/nav_director.php';
echo'Вы зашли как '.$_SESSION['role'];
?>

<?php
include 'temp/footer.php';
?>