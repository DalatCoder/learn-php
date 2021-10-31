<?php

namespace Milkshop\Admin\Controller;

use Ninja\DatabaseTable;
use Ninja\IController;

class KhachHangController implements IController
{
    private $adminKhachHangTable;
    
    public function __construct(DatabaseTable $adminKhachHangTable)
    {
        $this->adminKhachHangTable = $adminKhachHangTable;
    }

    public function index(): array
    {
        $khach_hangs = $this->adminKhachHangTable->findAll();
        
        return [
            'template' => 'admin/khach-hang/index.html.php',
            'master' => 'admin/master.html.php',
            'title' => 'Admin | Khách hàng',
            'variables' => [
                'khach_hangs' => $khach_hangs
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
            'template' => 'admin/khach-hang/create.html.php',
            'master' => 'admin/master.html.php',
            'title' => 'Admin | Khách hàng'
        ];
    }

    public function store(): void
    {
        $new_khach_hang = $_POST['khach-hang'];
        
        $this->adminKhachHangTable->save($new_khach_hang);
        
        header('location: /admin/khach-hang');
        exit();
    }

    public function edit(): array
    {
        $id = $_GET['id'] ?? null;
        
        if (!$id) {
            header('location: /admin/khach-hang');
            exit();
        }
        
        $khach_hang = $this->adminKhachHangTable->findById($id);
        
        return [
            'template' => 'admin/khach-hang/edit.html.php',
            'master' => 'admin/master.html.php',
            'title' => 'Admin | Chỉnh sửa thông tin khách hàng',
            'variables' => [
                'khach_hang' => $khach_hang
            ]
        ];
    }

    public function update(): void
    {
        $updated_khach_hang = $_POST['khach-hang'];
        
        $this->adminKhachHangTable->save($updated_khach_hang);
        
        header('location: /admin/khach-hang');
        exit();
    }

    public function destroy(): void
    {
        $id = $_GET['id'] ?? null;
        
        if (!$id) {
            header('location: /admin/khach-hang');
            exit();
        }
        
        $this->adminKhachHangTable->delete($id);
        
        header('location: /admin/khach-hang');
        exit();
    }
}
