<?php

use Ninja\EntryPoint;
use Todos\TodoRoutes;

try {
    include __DIR__ . '/../includes/autoload.php';

    $route = strtok($_SERVER['REQUEST_URI'], '?');
    $routes_handler = new TodoRoutes();

    $method = $_SERVER['REQUEST_METHOD'];

    $entryPoint = new EntryPoint($route, $method, $routes_handler);
    $entryPoint->run();
} catch (\PDOException $e) {
    $title = 'Đã có lỗi nghiêm trọng xảy ra';
    $output = 'Lỗi trong quá trình kết nối CSDL: ' . $e->getMessage() . ' in ' . $e->getFile() . ': ' . $e->getLine();

    include __DIR__ . '/../templates/master.html.php';
}
