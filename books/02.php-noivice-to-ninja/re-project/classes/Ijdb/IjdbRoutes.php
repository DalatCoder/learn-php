<?php

namespace Ijdb;

use Ninja\DatabaseTable;
use Ijdb\Controllers\Joke;
use Ijdb\Controllers\Register;
use Ninja\Authentication;
use Ninja\Routes;

class IjdbRoutes implements Routes
{
    private $authorsTable;
    private $jokesTable;
    private $authentication;

    public function __construct()
    {
        include __DIR__ . '/../../includes/DatabaseConnection.php';

        $this->jokesTable = new DatabaseTable($pdo, 'joke', 'id');
        $this->authorsTable = new DatabaseTable($pdo, 'author', 'id');
        $this->authentication = new Authentication($this->authorsTable, 'email', 'password');
    }

    public function getRoutes()
    {
        include __DIR__ . '/../../includes/DatabaseConnection.php';

        $jokeController = new Joke($this->authorsTable, $this->jokesTable);
        $authorController = new Register($this->authorsTable);

        $routes = [
            'joke/edit' => [
                'POST' => [
                    'controller' => $jokeController,
                    'action' => 'saveEdit'
                ],
                'GET' => [
                    'controller' => $jokeController,
                    'action' => 'edit'
                ],
                'login' => true
            ],
            'joke/delete' => [
                'POST' => [
                    'controller' => $jokeController,
                    'action' => 'delete',
                ],
                'login' => true
            ],
            'joke/list' => [
                'GET' => [
                    'controller' => $jokeController,
                    'action' => 'list'
                ]
            ],
            '' => [
                'GET' => [
                    'controller' => $jokeController,
                    'action' => 'home'
                ]
            ],
            'author/register' => [
                'GET' => [
                    'controller' => $authorController,
                    'action' => 'registrationForm'
                ],
                'POST' => [
                    'controller' => $authorController,
                    'action' => 'registerUser'
                ]
            ],
            'author/success' => [
                'GET' => [
                    'controller' => $authorController,
                    'action' => 'success'
                ]
            ]
        ];

        return $routes;
    }

    public function getAuthentication()
    {
        return $this->authentication;
    }
}
