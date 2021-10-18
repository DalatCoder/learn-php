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
    include __DIR__ . '/../controllers/JokeController.php';

    $jokesTable = new DatabaseTable($pdo, 'joke', 'id');
    $authorsTable = new DatabaseTable($pdo, 'author', 'id');

    $jokeController = new JokeController($authorsTable, $jokesTable);

    $action = $_GET['action'] ?? 'home';

    if ($action == strtolower($action)) {
        $page = $jokeController->$action();
    } else {
        http_response_code(301);
        header('Location: index.php?action=' . strtolower($action));
        exit();
    }

    $title = $page['title'];
    $template = $page['template'];

    if (isset($page['variables'])) {
        $output = loadTemplate($template, $page['variables']);
    } else {
        $output = loadTemplate($template);
    }
} catch (PDOException $e) {
    $title = 'An error has occurred';

    $output = 'Database error: ' . $e->getMessage() . ' in ' . $e->getFile() . ': ' . $e->getLine();
}

include __DIR__ . '/../templates/layout.html.php';
