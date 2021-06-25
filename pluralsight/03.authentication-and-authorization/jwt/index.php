<?php
require_once __DIR__ . "/vendor/autoload.php";

if (!isset($_SERVER['HTTP_AUTHORIZATION'])) {
  header('Location: /login.php');
  exit;
}

if (!preg_match('/Bearer\s(\S+)/', $_SERVER['HTTP_AUTHORIZATION'], $matches)) {
  header('HTTP/1.1 401 Unauthorized');
  exit;
}

$retrievedToken = $matches[1];
$issuer = 'https://localdomain.dev';
$key = 'nguyenthihatrongtronghieu';

$token = \Firebase\JWT\JWT::decode($retrievedToken, $key, ['HS256']);
$now = new DateTimeImmutable();

if ($token->iss = !$issuer || $token->nbf > $now->getTimestamp() || $token->exp < $now->getTimestamp()) {
  header('HTTP/1.1 401 Unauthorized');
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
  <h1>Hello user</h1>
</body>

</html>
