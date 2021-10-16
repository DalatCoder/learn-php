<?php 
$host = 'localhost';
$dbname = 'jokes';
$charset = 'utf8';
$db_username = 'root';
$db_password = '';

$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=$charset", $db_username, $db_password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
