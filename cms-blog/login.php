<?php include "includes/db.php"; ?>
<?php session_start(); ?>

<?php
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);

    $query = "SELECT * FROM Users WHERE user_username='$username'";

    $select_user_query = mysqli_query($connection, $query);
    if (!$select_user_query) {
        die('Oops! Error when log user in ' . mysqli_error($connection));
    }

    $count = mysqli_num_rows($select_user_query);
    if ($count > 0) {
        $row = mysqli_fetch_assoc($select_user_query);
        $db_user_id = $row['user_id'];
        $db_user_password = $row['user_password'];
        $db_user_username = $row['user_username'];
        $db_user_firstname = $row['user_firstname'];
        $db_user_lastname = $row['user_lastname'];
        $db_user_role = $row['user_role'];
        $db_user_email = $row['user_email'];
        $db_user_image = $row['user_image'];

        if ($password === $db_user_password && $db_user_role === 'admin') {
            $_SESSION['user_id'] = $db_user_id;
            $_SESSION['user_username'] = $db_user_username;
            $_SESSION['user_firstname'] = $db_user_firstname;
            $_SESSION['user_lastname'] = $db_user_lastname;
            $_SESSION['user_role'] = $db_user_role;
            $_SESSION['user_image'] = $db_user_image;
            $_SESSION['user_email'] = $db_user_email;
            $_SESSION['user_password'] = $db_user_password;

            header("Location: admin");
            return;
        }
    }

    header("Location: index.php");
}
?>
