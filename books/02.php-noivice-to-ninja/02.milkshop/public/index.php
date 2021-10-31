<?php

use Ninja\EntryPoint;
use Milkshop\MilkshopIRoutes;

try {
    include __DIR__ . '/../includes/autoload.php';

    $route = strtok($_SERVER['REQUEST_URI'], '?');
    $routes_handler = new MilkshopIRoutes();

    $method = $_SERVER['REQUEST_METHOD'];

    $entryPoint = new EntryPoint($route, $method, $routes_handler);
    $entryPoint->run();
} catch (\PDOException $e) {
    $title = 'Đã có lỗi nghiêm trọng xảy ra';
    $content = 'Lỗi trong quá trình kết nối CSDL: ' . $e->getMessage() . ' in ' . $e->getFile() . ': ' . $e->getLine();
    $custom_styles = [];
    $custom_scripts = [];
    
    include __DIR__ . '/../templates/master.html.php';
} catch (\Exception $e) {
    $title = 'Đã có lỗi nghiêm tọng xảy ra';
    $content = 'Đã có lỗi nghiêm trọng xảy ra: "' . $e->getMessage() . '" tại tập tin: ' . $e->getFile() . ': ' . $e->getLine();
    $custom_styles = [];
    $custom_scripts = [];

    include __DIR__ . '/../templates/master.html.php';
} 
