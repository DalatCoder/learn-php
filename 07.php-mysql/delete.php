<?php include "db.php";
    if (!isset($_POST['submit'])) {
        echo 'Oops! Something went wrong';
        return;
    }

    $id = $_POST['id'];
    if (!$id) {
        echo 'Please select user id';
        return;
    }

    $query = "DELETE FROM users WHERE Id = $id";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        die('Oops! Something went wrong!' . mysqli_error($connection));
        return;
    }

    echo 'Delete user successfully!';
?>