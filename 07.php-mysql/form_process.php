<?php
    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        echo '<br>';
        if (!($username && $password)) {
            echo 'Please enter your credential';
            return;
        }

        echo 'Your username is: ' . $username;
        echo '<br>';
        echo 'Your password is: ' . $password;

        $db_server = 'localhost';
        $db_username = 'root';
        $db_password = '';
        $db_name = 'loginapp';

        $connection = mysqli_connect($db_server, $db_username, $db_password, $db_name);

        echo '<br>';
        if (!$connection) {
            die("Oops something went wrong :(");
            return;
        }

        echo 'Connect to database successfully!';
    }
?>