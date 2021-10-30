<?php

namespace Todos\Controller;

use Ninja\DatabaseTable;
use Todos\Entity\Todo;

class TodoController
{
    private $todo_table;
    
    public function __construct(DatabaseTable $todo_table)
    {
        $this->todo_table = $todo_table;
    }

    /**
     * Show Home Page
     * 
     * GET /todos
     * 
     * @return array
     */
    public function index()
    {
        $today_todos = $this->todo_table->find(Todo::COL_DATE, new \DateTime());
        
        return [
            'template' => 'todos/index.html.php',
            'title' => 'Master Template',
            'variables' => [
                'today' => (new \DateTime())->format('Y-m-d'),
                'today_todos' => $today_todos
            ]
        ];
    }

    /**
     * Show Create Form
     * 
     * GET /todos/create
     */
    public function create()
    {
        
    }

    /**
     * Store New Record
     * 
     * POST /todos
     */
    public function store()
    {
        $new_todo = $_POST['todo'];
        $this->todo_table->save($new_todo);
        
        header('location: /todos');
        exit();
    }

    /**
     * Show Detail
     * 
     * GET /todos?id=1
     */
    public function show()
    {
        
    }

    /**
     * Show Edit Form
     * 
     * GET /todos/edit?id=1
     */
    public function edit()
    {
        $id = $_GET['id'] ?? null;
        
        if (!$id) {
            header('location: /todos');
            exit();
        }
        
        $todo = $this->todo_table->findById($id);
        
        return [
            'template' => 'todos/edit.html.php',
            'title' => 'Edit Todo',
            'variables' => [
                'todo' => $todo
            ]
        ];
    }

    /**
     * Store Updated Record
     * 
     * POST /todos/edit
     */
    public function update()
    {
        $updated_todo = $_POST['todo'];
        
        $this->todo_table->save($updated_todo);
        
        header('location: /todos');
        exit();
    }

    /**
     * Delete A Record
     * 
     * POST /todos/delete
     */
    public function destroy()
    {
        $todo_id = $_POST['id'] ?? null;
        
        if ($todo_id) {
            $this->todo_table->delete($todo_id);
        }
        
        header('location: /todos');
        exit();
    }
    
    public function make_complete()
    {
        $todo_id = $_POST['id'] ?? null;
        
        if ($todo_id) {
            $this->todo_table->save([
                Todo::COL_ID => $todo_id,
                Todo::COL_COMPLETED_AT => new \DateTime()
            ]);
        }
        
        header('location: /todos');
        exit();
    }
    
    public function make_doing()
    {
        $todo_id = $_POST['id'] ?? null;

        if ($todo_id) {
            $this->todo_table->save([
                Todo::COL_ID => $todo_id,
                Todo::COL_COMPLETED_AT => null
            ]);
        }

        header('location: /todos');
        exit();
    }
}
