<?php

namespace Todos;

use Ninja\Authentication;
use Ninja\DatabaseTable;
use Ninja\Routes;
use Todos\Controller\TodoController;
use Todos\Entity\Todo;

class TodoRoutes implements Routes
{
    private $todo_table;
    
    public function __construct()
    {
        $this->todo_table = new DatabaseTable('todo', 'id', Todo::CLASS_NAME, []);
    }

    public function getAuthentication(): ?Authentication
    {
        return null;
    }

    public function checkPermission($permission): ?bool
    {
        return null;
    }

    public function getRoutes(): array
    {
        $todoController = new TodoController($this->todo_table);

        return [
            '/' => [
                'REDIRECT' => '/todos'
            ],
            #region Todo Handler
            '/todos' => [
                'GET' => [
                    'controller' => $todoController,
                    'action' => 'index'
                ],
                'POST' => [
                    'controller' => $todoController,
                    'action' => 'store'
                ]
            ],
            '/todos/edit' => [
                'GET' => [
                    'controller' => $todoController,
                    'action' => 'edit'
                ],
                'POST' => [
                    'controller' => $todoController,
                    'action' => 'update'
                ]
            ],
            '/todos/delete' => [
                'POST' => [
                    'controller' => $todoController,
                    'action' => 'destroy'
                ]
            ],
            '/todos/complete' => [
                'POST' => [
                    'controller' => $todoController,
                    'action' => 'make_complete'
                ]
            ],
            '/todos/doing' => [
                'POST' => [
                    'controller' => $todoController,
                    'action' => 'make_doing'
                ]
            ]
            #endregion
        ];
    }
}
