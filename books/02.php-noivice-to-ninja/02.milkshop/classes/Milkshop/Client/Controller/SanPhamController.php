<?php

namespace Milkshop\Client\Controller;

use Ninja\DatabaseTable;

class SanPhamController
{
    private $adminSanPhamTable;
    
    public function __construct(DatabaseTable $adminSanPhamTable)
    {
        $this->adminSanPhamTable = $adminSanPhamTable;
    }

    public function show()
    {
        $id = $_GET['id'] ?? null;
        
        if (!$id) {
            header('location: /');
            exit();
        }
        
        $san_pham = $this->adminSanPhamTable->findById($id);
        
        return [
            'template' => 'client/san-pham/show.html.php',
            'master' => 'client/master.html.php',
            'title' => 'Chi tiết sản phẩm',
            'variables' => [
                'san_pham' => $san_pham,
            ]
        ];
    }
}
