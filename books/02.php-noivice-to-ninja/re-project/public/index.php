<?php

use Ijdb\IjdbRoutes;
use Ninja\EntryPoint;

try {
    include __DIR__ . '/../includes/autoload.php';

    // sites.local:8000/joke/list?page=1&limit=10
    // $_SERVER['REQUEST_URI'] = '/joke/list?page=1&limit=10'
    // strtok => '/joke/list'
    // ltrim => 'joke/list'
    $route = ltrim(strtok($_SERVER['REQUEST_URI'], '?'), '/');

    $method = $_SERVER['REQUEST_METHOD'];
    $routes = new IjdbRoutes();

    // This index.php always be loaded first because or served folder is /public
    $entryPoint = new EntryPoint($route, $method, $routes);
    $entryPoint->run();
} catch (PDOException $e) {
    $title = 'An error has occurred';

    $output = 'Database error: ' . $e->getMessage() . ' in ' . $e->getFile() . ': ' . $e->getLine();

    include __DIR__ . '/../templates/layout.html.php';
}
