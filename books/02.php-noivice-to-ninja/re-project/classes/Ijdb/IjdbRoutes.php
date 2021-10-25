<?php

namespace Ijdb;

use Ninja\DatabaseTable;
use Ijdb\Controllers\Joke;
use Ijdb\Controllers\Register;

class IjdbRoutes
{
    public function callAction($route)
    {
        include __DIR__ . '/../../includes/DatabaseConnection.php';

        $jokesTable = new DatabaseTable($pdo, 'joke', 'id');
        $authorsTable = new DatabaseTable($pdo, 'author', 'id');

        if ($route === 'joke/list') {
            $controller = new Joke($authorsTable, $jokesTable);
            $page = $controller->list();
        } else if ($route === 'joke/edit') {
            $controller = new Joke($authorsTable, $jokesTable);
            $page = $controller->edit();
        } else if ($route === 'joke/delete') {
            $controller = new Joke($authorsTable, $jokesTable);
            $page = $controller->delete();
        } else if ($route === 'register') {
            $controller = new Register($authorsTable);
            $page = $controller->showForm();
        } else {
            $controller = new Joke($authorsTable, $jokesTable);
            $page = $controller->home();
        }

        return $page;
    }
}
