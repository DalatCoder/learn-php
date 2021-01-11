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

    $query = "SELECT * FROM users";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        die('Oops! Something went wrong when fetching data from database');
        return;
    }

    $accountList = [];
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($accountList, $row);
    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>07 - PHP and MySQL</title>
</head>
<body>
<ol>
<?php
    foreach ($accountList as $account) {
        $id = $account['Id'];
        $username = $account['Username'];
        $password = $account['Password'];

        ?>
        <li>
            <div>ID: <?php echo $id ?></div>
            <div>UserName: <?php echo $username ?></div>
            <div>Password: <?php echo $password ?></div>
        </li>
        <hr>
        <?php
    }
?>
</ol>
</body>
</html>