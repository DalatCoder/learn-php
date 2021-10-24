<?php

function loadTemplate($templateFillName, $variables = [])
{
    extract($variables);

    ob_start();
    include __DIR__ . '/../templates/' . $templateFillName;

    return ob_get_clean();
}

try {

    include __DIR__ . '/../includes/DatabaseConnection.php';
    include __DIR__ . '/../classes/DatabaseTable.php';

    $jokesTable = new DatabaseTable($pdo, 'joke', 'id');
    $authorsTable = new DatabaseTable($pdo, 'author', 'id');

    // If no route variable is set, use 'joke/home'
    $route = $_GET['route'] ?? 'joke/home';

    if ($route != strtolower($route)) {
        http_response_code(301);
        header('location: index.php?route=' . strtolower($route));
        exit();
    }

    if ($route === 'joke/list') {
        include __DIR__ . '/../controllers/JokeController.php';
        $controller = new JokeController($authorsTable, $jokesTable);
        $page = $controller->list();
    } else if ($route === 'joke/home') {
        include __DIR__ . '/../controllers/JokeController.php';
        $controller = new JokeController($authorsTable, $jokesTable);
        $page = $controller->home();
    } else if ($route === 'joke/edit') {
        include __DIR__ . '/../controllers/JokeController.php';
        $controller = new JokeController($authorsTable, $jokesTable);
        $page = $controller->edit();
    } else if ($route === 'joke/delete') {
        include __DIR__ . '/../controllers/JokeController.php';
        $controller = new JokeController($authorsTable, $jokesTable);
        $page = $controller->delete();
    } else if ($route === 'register') {
        include __DIR__ . '/../controllers/RegisterController.php';
        $controller = new RegisterController($authorsTable);
        $page = $controller->showForm();
    }

    $title = $page['title'];

    if (isset($page['variables'])) {
        $output = loadTemplate($page['template'], $page['variables']);
    } else {
        $output = loadTemplate($page['template']);
    }
} catch (PDOException $e) {
    $title = 'An error has occurred';

    $output = 'Database error: ' . $e->getMessage() . ' in ' . $e->getFile() . ': ' . $e->getLine();
}

include __DIR__ . '/../templates/layout.html.php';
