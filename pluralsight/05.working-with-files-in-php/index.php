<?php

$filename = './books/Charles Dickens/A Tale of Two Cities.txt';

header('content-type: text/plain');

readfile($filename);
