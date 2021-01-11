<?php include "db.php";
if (!isset($_POST['submit'])) {
    echo 'Oops! Something went wrong when updating data';
    return;
}

$id = $_POST['id'];
$userName = $_POST['username'];
$password = $_POST['password'];

if (!$id || !$userName || !$password) {
    echo 'Please enter your credentials.';
    return;
}

$query = "UPDATE users SET ";
$query .= "Username = '$userName', ";
$query .= "Password = '$password' ";
$query .= "WHERE Id = $id";

$result = mysqli_query($connection, $query);

if (!$result) {
    die("Oops! Error" . mysqli_error($connection));
    return;
}

echo 'Update info successfully';
?>
