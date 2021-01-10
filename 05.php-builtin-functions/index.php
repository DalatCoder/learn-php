<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>05 - PHP built-in functions</title>
</head>
<body>
<?php
    $rand = rand(1, 10);
    echo $rand . '<br>';

    $str = "Hello World";
    echo strlen($str);
    echo '<br>';

    $list = [1, 2, 3, 4, 5, 6, 7];
    print_r($list);
    echo '<br>';
?>
</body>
</html>