<?php

$info = [];

$filename = './books/Charles Dickens/Great Expectations.txt';

$info['last accessed'] = new DateTime('@' . fileatime($filename));
$info['last modified'] = new DateTime('@' . filemtime($filename));

$info['size (B)'] = filesize($filename);
$info['type'] = filetype($filename);

$info['readable'] = is_readable($filename);
$info['writeable'] = is_writeable($filename);
$info['executable'] = is_executable($filename);
$info['link'] = is_link($filename);

var_dump($info);
