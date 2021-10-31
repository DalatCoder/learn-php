<?php

namespace Milkshop\Admin\Controller;

use Ninja\DatabaseTable;

class DonHangController implements \Ninja\IController
{
    private $adminDonHangTable;
    
    public function __construct(DatabaseTable $adminDonHangTable)
    {
        $this->adminDonHangTable = $adminDonHangTable;
    }

    public function index(): array
    {
        $don_hangs = $this->adminDonHangTable->findAll();
        
        return [
            'template' => 'admin/don-hang/index.html.php',
            'master' => 'admin/master.html.php',
            'title' => 'Admin | Đơn hàng',
            'variables' => [
                'don_hangs' => $don_hangs
            ]
        ];
    }

    public function show(): array
    {
        $id = $_GET['id'] ?? null;
        
        if (!$id) {
            header('location: /admin/don-hang');
            exit();
        }
        
        $don_hang = $this->adminDonHangTable->findById($id);
        
        return [
            'template' => 'admin/don-hang/show.html.php',
            'title' => 'Admin | Chi tiết đơn hàng',
            'master' => 'admin/master.html.php',
            'variables' => [
                'don_hang' => $don_hang
            ]
        ];
    }

    public function create(): array
    {
        return [];
    }

    public function store(): void
    {
    }

    public function edit(): array
    {
        return [];
    }

    public function update(): void
    {
    }

    public function destroy(): void
    {
    }
}
