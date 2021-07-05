<?php

ini_set('date.timezone', 'Asia/Ho_Chi_Minh');

$date = new DateTime();
$sun_info = date_sun_info($date->getTimestamp(), 11.904979, 108.472754);

echo '<pre>' . print_r($sun_info, true) . '</pre>';
