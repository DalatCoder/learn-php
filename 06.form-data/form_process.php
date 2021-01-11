<?php
    print_r($_POST);

    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        echo '<br>';
        echo 'Your username is: ' . $username;
        echo '<br>';
        echo 'Your password is: ' . $password;
    }
?>