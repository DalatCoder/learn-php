<?php

namespace Milkshop\Admin\Controller;

use Ninja\DatabaseTable;
use Ninja\IController;

class LoaiSuaController implements IController
{
    private $loaiSuaTable;

    public function __construct(DatabaseTable $loaiSuaTable)
    {
        $this->loaiSuaTable = $loaiSuaTable;
    }

    public function index(): array
    {
        $loai_suas = $this->loaiSuaTable->findAll();
        
        return [
            'master' => 'admin/master.html.php',
            'template' => 'admin/loai-sua/index.html.php',
            'title' => 'Admin | Loại sữa',
            'variables' => [
                'loai_suas' => $loai_suas
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
            'template' => 'admin/loai-sua/create.html.php',
            'title' => 'Admin | Thêm loại sữa',
        ];
    }

    public function store(): void
    {
        $new_loai_sua = $_POST['loai-sua'];
        
        $this->loaiSuaTable->save($new_loai_sua);
        
        header('location: /admin/loai-sua');
        exit();
    }

    public function edit(): array
    {
        $id = $_GET['id'] ?? null;
        
        if (!$id) {
            header('location: /admin/loai-sua');
            exit();
        }
        
        $loai_sua = $this->loaiSuaTable->findById($id);
        
        return [
            'template' => 'admin/loai-sua/edit.html.php',
            'master' => 'admin/master.html.php',
            'title' => 'Admin | Cập nhật loại sữa',
            'variables' => [
                'loai_sua' => $loai_sua
            ]
        ];
    }

    public function update(): void
    {
        $updated_loai_sua = $_POST['loai-sua'];
        
        $this->loaiSuaTable->save($updated_loai_sua);
        
        header('location: /admin/loai-sua');
        exit();
    }

    public function destroy(): void
    {
        $id = $_GET['id'] ?? null;
        
        if (!$id) {
            header('location: /admin/loai-sua');
            exit();
        }
        
        $this->loaiSuaTable->delete($id);
        
        header('location: /admin/loai-sua');
        exit();
    }
}
