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
<form action="form_process.php" method="post">
    <div>
        <input type="text" name="username" placeholder="Username">
    </div>
    <div>
        <input type="password" name="password" placeholder="Password">
    </div>
    <div>
        <input type="submit" value="Submit" name="submit">
    </div>
    <div>
        <a href="account_list.php">View accounts</a>
        <a href="form_update.php">Update account</a>
    </div>
</form>
</body>
</html>