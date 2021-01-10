<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP Basic - 02. Data Type</title>
</head>
<body>
<?php
    $number1 = 10;
    $number2 = 20;

    echo $number1 . ' + ' . $number2 . ' = ';
    echo $number1 + $number2 . '<br>';

    $numbers1 = array('Nguyen Trong', 'Hieu');
    $numbers2 = array('first_name' => 'Hieu', 'last_name' => 'Nguyen Trong');

    print_r($numbers1);

    echo '<br>';
    print_r($numbers2);
?>
</body>
</html>