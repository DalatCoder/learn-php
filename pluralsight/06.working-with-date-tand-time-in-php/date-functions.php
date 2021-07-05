<?php

ini_set('date.timezone', 'Asia/Ho_Chi_Minh');

$timestamp_now = time();
echo "Timestamp for now: {$timestamp_now} <br>";

$timestamp_tomorrow = $timestamp_now + (60 * 60 * 24);
echo "Timestamp for tomorrow: {$timestamp_tomorrow} <br>";

$timestamp_tomorrow = strtotime("+1 day");
echo "Timestamp for tomorrow: {$timestamp_tomorrow} <br>";

$timestamp_newyear = strtotime("first day of January 2021");
echo "Timestamp for newyear: {$timestamp_newyear} <br>";

$timestamp_newyear = mktime(0, 0, 0, 1, 1, 2021);
echo "Timestamp for newyear: {$timestamp_newyear} <br>";

echo "<br><br>";

echo "Today is " . date('g:i:s a \o\n l, F j, Y') . '<br>';
echo "Tomorrow is " . date('g:i:s a \o\n l, F j, Y', $timestamp_tomorrow) . '<br>';
echo "New Year 2021 is " . date('g:i:s a \o\n l, F j, Y', $timestamp_newyear) . '<br>';

echo "<br><br>";

$year = 2021;

if (checkdate(2, 29, $year)) {
    echo "{$year} is a leap year";
} else {
    echo "{$year} is not a leap year";
}
