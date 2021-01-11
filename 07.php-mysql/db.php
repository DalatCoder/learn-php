<?php
$db_server = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'loginapp';

$connection = mysqli_connect($db_server, $db_username, $db_password, $db_name);

if (!$connection) {
    die('Oops! Something went wrong when connecting to database');
    return;
}
?>