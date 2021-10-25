<?php

namespace Ijdb;

class IjdbRoutes
{
    public function callAction($route)
    {
        include __DIR__ . '/../../includes/DatabaseConnection.php';

        $jokesTable = new \Ninja\DatabaseTable($pdo, 'joke', 'id');
        $authorsTable = new \Ninja\DatabaseTable($pdo, 'author', 'id');

        if ($route === 'joke/list') {
            include __DIR__ . '/../controllers/JokeController.php';
            $controller = new JokeController($authorsTable, $jokesTable);
            $page = $controller->list();
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
        } else {
            include __DIR__ . '/../controllers/JokeController.php';
            $controller = new JokeController($authorsTable, $jokesTable);
            $page = $controller->home();
        }

        return $page;
    }
}
