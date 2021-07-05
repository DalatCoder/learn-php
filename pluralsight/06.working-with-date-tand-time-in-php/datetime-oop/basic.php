<?php

ini_set('date.timezone', 'Asia/Ho_Chi_Minh');

$date_now = new DateTime();
$date = new DateTime('January 14, 2020');

echo '<br>';

echo $date_now->format('l, F j, Y g:i a') . '<br>';
echo $date->format('l, F j, Y g:i a') . '<br>';

$time_now = $date_now->getTimestamp();
$date->setTimestamp($time_now);

echo $date->format('l, F j, Y g:i a') . '<br>';
