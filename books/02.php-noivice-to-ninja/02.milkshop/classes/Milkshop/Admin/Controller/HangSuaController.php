<?php

namespace Milkshop\Admin\Controller;

use Ninja\DatabaseTable;
use Ninja\IController;

class HangSuaController implements IController
{
    private $hangSuaTable;

    public function __construct(DatabaseTable $hangSuaTable)
    {
        $this->hangSuaTable = $hangSuaTable;
    }

    public function index(): array
    {
        $hang_sua = $this->hangSuaTable->findAll();

        return [
            'master' => 'admin/master.html.php',
            'template' => 'admin/hang-sua/index.html.php',
            'title' => 'Admin | Hãng sữa',
            'variables' => [
                'hang_suas' => $hang_sua
            ]
        ];
    }

    public function show(): array
    {
        return [];
    }

    public function create(): array
    {
        return [
            'master' => 'admin/master.html.php',
            'template' => 'admin/hang-sua/create.html.php',
            'title' => 'Admin | Thêm hãng sữa'
        ];
    }

    public function store(): void
    {
        $new_hang_sua = $_POST['hang-sua'];

        $this->hangSuaTable->save($new_hang_sua);

        header('location: /admin/hang-sua');
        exit();
    }

    public function edit(): array
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            header('location: /admin/hang-sua');
            exit();
        }

        $hang_sua = $this->hangSuaTable->findById($id);

        return [
            'master' => 'admin/master.html.php',
            'template' => 'admin/hang-sua/edit.html.php',
            'title' => 'Admin | Cập nhật hãng sữa',
            'variables' => [
                'hang_sua' => $hang_sua
            ]
        ];
    }

    public function update(): void
    {
        $updated_hang_sua = $_POST['hang-sua'];

        $this->hangSuaTable->save($updated_hang_sua);

        header('location: /admin/hang-sua');
        exit();
    }

    public function destroy(): void
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            header('location: /admin/hang-sua');
            exit();
        }

        $this->hangSuaTable->delete($id);

        header('location: /admin/hang-sua');
        exit();
    }

}
