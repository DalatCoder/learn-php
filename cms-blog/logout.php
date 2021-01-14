<?php session_start(); ?>

<?php
$_SESSION['user_id'] = null;
$_SESSION['user_username'] = null;
$_SESSION['user_firstname'] = null;
$_SESSION['user_lastname'] = null;
$_SESSION['user_role'] = null;
$_SESSION['user_email'] = null;
$_SESSION['user_password'] = null;
$_SESSION['user_image'] = null;

header("Location: index.php");
?>

