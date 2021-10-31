<?php

namespace Milkshop\Client;

use Ninja\DatabaseTable;

class HomeController
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

    public function home()
    {
        $all_hang_sua = $this->adminHangSuaTable->findAll();
        $all_loai_sua = $this->adminLoaiSuaTable->findAll();
        
        $all_hang_sua_chuan = [];
        $all_loai_sua_chuan = [];
        
        foreach ($all_hang_sua as $item) {
            if ($item->get_so_luong_san_pham() >= 3) 
                $all_hang_sua_chuan[] = $item;
        }
        
        foreach ($all_loai_sua as $item) {
            if ($item->get_so_luong_san_pham() >= 3) 
                $all_loai_sua_chuan[] = $item;
        }
        
        return [
            'template' => 'client/home.html.php',
            'master' => 'client/master.html.php',
            'title' => 'Trang chủ',
            'variables' => [
                'hang_suas' => $all_hang_sua_chuan,
                'loai_suas' => $all_loai_sua_chuan
            ]
        ];
    }
}
