<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>04 - Custom Functions</title>
</head>
<body>
<?php
define('PI', 3.14);

echo PI;
echo '<br>';

function add($number1, $number2) {
    return $number1 + $number2;
}

echo add(1, 2);
?>
</body>
</html>