<?php include "db.php";
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
    <title>06 - Form Data</title>
</head>
<body>
<form action="update.php" method="post">
    <div>
        <select name="id" id="userId">
            <?php
            foreach ($accountList as $account) {
                $id = $account['Id'];
                echo "<option value='$id'>$id</option>";
            }
            ?>
        </select>
    </div>
    <div>
        <input type="text" name="username" placeholder="Username">
    </div>
    <div>
        <input type="password" name="password" placeholder="Password">
    </div>
    <div>
        <input type="submit" value="Update" name="submit">
    </div>
</form>
</body>
</html>
