<?php

namespace Milkshop\Admin\Controller;

use Ninja\DatabaseTable;

class SanPhamController implements \Ninja\IController
{
    private $adminSanPhamTable;
    private $adminHangSuaTable;
    private $adminLoaiSuaTable;
    
    public function __construct(DatabaseTable $adminSanPhamTable, DatabaseTable $adminHangSuaTable, DatabaseTable $adminLoaiSuaTable)
    {
        $this->adminSanPhamTable = $adminSanPhamTable;
        $this->adminHangSuaTable = $adminHangSuaTable;
        $this->adminLoaiSuaTable = $adminLoaiSuaTable;
    }

    public function index(): array
    {
        $san_phams = $this->adminSanPhamTable->findAll();
        
        return [
            'template' => 'admin/san-pham/index.html.php',
            'master' => 'admin/master.html.php',
            'title' => 'Admin | sản phẩm',
            'variables' => [
                'san_phams' => $san_phams
            ]
        ];
    }

    public function show(): array
    {
        return [];
    }

    public function create(): array
    {
        $hang_suas = $this->adminHangSuaTable->findAll();
        $loai_suas = $this->adminLoaiSuaTable->findAll();
        
        return [
            'template' => 'admin/san-pham/create.html.php',
            'master' => 'admin/master.html.php',
            'title' => 'Admin | Thêm sản phẩm',
            'variables' => [
                'hang_suas' => $hang_suas,
                'loai_suas' => $loai_suas
            ]
        ];
    }

    public function store(): void
    {
        $new_san_pham = $_POST['san-pham'];
        
        $valid_types = ['image'];
        $type = $_FILES['anh']['type'];
        
        foreach ($valid_types as $valid_type) {
            if (strpos($type, $valid_type) < 0) {
                throw new \Exception('Tập tin không hợp lệ');
            }
        }
        
        if ($_FILES['anh']['error'] != 0) 
            throw new \Exception('Lỗi xảy ra khi tải tập tin lên server');
        
        $ten_anh_goc = $_FILES['anh']['name'];
        $duong_dan_tam_thoi = $_FILES['anh']['tmp_name'];
        
        $ten_anh_random = uniqid() . $ten_anh_goc;
        
        $duong_dan_uploads = __DIR__ . '/../../../../public/uploads/' . $ten_anh_random;
        
        $success = move_uploaded_file($duong_dan_tam_thoi, $duong_dan_uploads);
        if (!$success) 
            throw new \Exception('Lỗi xảy ra khi tải tập tin lên server');
        
        $ten_hinh_anh_server = '/uploads/' . $ten_anh_random;
        
        $new_san_pham['ten_hinh_anh_goc'] = $ten_anh_goc;
        $new_san_pham['ten_hinh_anh_server'] = $ten_hinh_anh_server;
        
        $this->adminSanPhamTable->save($new_san_pham);
        
        header('location: /admin/san-pham');
        exit();
    }

    public function edit(): array
    {
        $id = $_GET['id'] ?? null;
        
        if (!$id) {
            header('location: /admin/san-pham');
            exit();
        }
        
        $san_pham = $this->adminSanPhamTable->findById($id);
        $hang_suas = $this->adminHangSuaTable->findAll();
        $loai_suas = $this->adminLoaiSuaTable->findAll();

        return [
            'template' => 'admin/san-pham/edit.html.php',
            'master' => 'admin/master.html.php',
            'title' => 'Admin | Thêm sản phẩm',
            'variables' => [
                'hang_suas' => $hang_suas,
                'loai_suas' => $loai_suas,
                'san_pham' => $san_pham
            ]
        ];
    }

    public function update(): void
    {
        $updated_san_pham = $_POST['san-pham'];

        if (isset($_FILES['anh']) && !empty($_FILES['anh']['name'])) {
            $valid_types = ['image'];
            $type = $_FILES['anh']['type'];

            foreach ($valid_types as $valid_type) {
                if (strpos($type, $valid_type) < 0) {
                    throw new \Exception('Tập tin không hợp lệ');
                }
            }

            if ($_FILES['anh']['error'] != 0)
                throw new \Exception('Lỗi xảy ra khi tải tập tin lên server');

            $ten_anh_goc = $_FILES['anh']['name'];
            $duong_dan_tam_thoi = $_FILES['anh']['tmp_name'];

            $ten_anh_random = uniqid() . $ten_anh_goc;

            $duong_dan_uploads = __DIR__ . '/../../../../public/uploads/' . $ten_anh_random;

            $success = move_uploaded_file($duong_dan_tam_thoi, $duong_dan_uploads);
            if (!$success)
                throw new \Exception('Lỗi xảy ra khi tải tập tin lên server');

            $ten_hinh_anh_server = '/uploads/' . $ten_anh_random;

            $updated_san_pham['ten_hinh_anh_goc'] = $ten_anh_goc;
            $updated_san_pham['ten_hinh_anh_server'] = $ten_hinh_anh_server;
        }

        $this->adminSanPhamTable->save($updated_san_pham);

        header('location: /admin/san-pham');
        exit();
    }

    public function destroy(): void
    {
        $id = $_GET['id'] ?? null;
        
        if (!$id) {
            header('location: /admin/san-pham');
            exit();
        }
        
        $this->adminSanPhamTable->delete($id);
        header('location: /admin/san-pham');
        exit();
    }
}
