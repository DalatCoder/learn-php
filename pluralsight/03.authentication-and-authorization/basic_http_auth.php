<?php
$username = 'admin';
$password = 'admin';

if (!isset($_SERVER['PHP_AUTH_USER'])) {
  header('WWW-Authenticate: Basic realm="Parcel Tracker"');
  header('HTTP/1.0 401 Unauthorized');
  echo 'You must provide a valid username and password to access this application';
  exit;
}

if (
  $_SERVER['PHP_AUTH_USER'] !== $username ||
  $_SERVER['PHP_AUTH_PW'] !== $password
) {
  header('HTTP/1.0 401 Unauthorized');
  echo 'Either your username or password was not valid\n';
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <h1>Welcome</h1>
  <p>Nice to meet you!</p>
</body>

</html>
