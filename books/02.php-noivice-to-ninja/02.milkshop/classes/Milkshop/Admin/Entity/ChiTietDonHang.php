<?php

namespace Milkshop\Admin\Entity;

use Ninja\DatabaseTable;

class ChiTietDonHang
{
    const CLASS_NAME = '\Milkshop\Admin\Entity\ChiTietDonHang';
    
    public $id;
    public $don_hang;
    public $san_pham;
    public $so_luong;
    public $gia_mua;
    
    private $adminSanPhamTable;
    private $adminDonHangTable;
    
    private $san_pham_entity;
    private $don_hang_entity;
    
    public function __construct(DatabaseTable $adminDonHangTable, DatabaseTable $adminSanPhamTable)
    {
        $this->adminSanPhamTable = $adminSanPhamTable;
        $this->adminDonHangTable = $adminDonHangTable;
    }
    
    public function get_san_pham()
    {
        if (!$this->san_pham_entity) {
            $this->san_pham_entity = $this->adminSanPhamTable->findById($this->san_pham);
        }
        
        return $this->san_pham_entity;
    }
    
    public function get_don_hang()
    {
        if (!$this->don_hang_entity) {
            $this->don_hang_entity = $this->adminDonHangTable->findById($this->don_hang);
        }
        
        return $this->don_hang_entity;
    }
    
    public function get_gia_mua()
    {
        $formatter = new \NumberFormatter('vi_VN', \NumberFormatter::CURRENCY);
        return $formatter->formatCurrency($this->gia_mua, 'VND');
    }
    
    public function get_tong_tien()
    {
        $total = $this->gia_mua * $this->so_luong;

        $formatter = new \NumberFormatter('vi_VN', \NumberFormatter::CURRENCY);
        return $formatter->formatCurrency($total, 'VND');
    }
    
}
