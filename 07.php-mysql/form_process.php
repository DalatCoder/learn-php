<?php include "db.php";
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

        $query = "INSERT INTO users(Username, Password) ";
        $query .= "VALUES ('$username', '$password')";

        $result = mysqli_query($connection, $query);

        if (!$result) {
            die('Query failed ' . mysqli_error());
            return;
        }

        echo '<br>Create new user successfully';
    }
?>