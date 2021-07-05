<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['username'] === 'tronghieu' && $_POST['password'] === 'tronghieu') {
        session_start();
        $_SESSION['authenticated'] = time();
        header('Location: dashboard.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>

<body>

    <?php
    if (isset($_GET['expired'])) {
        echo '<p>Your session\'s expired. Please login again.</p>';
    }
    ?>

    <form action="" method="POST">
        <input type="text" name="username" id="username"><br>
        <input type="password" name="password" id="password"><br>
        <input type="submit" value="Submit">
    </form>
</body>

</html>
