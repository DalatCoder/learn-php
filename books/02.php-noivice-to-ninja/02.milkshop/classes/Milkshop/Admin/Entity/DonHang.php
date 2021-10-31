<?php

namespace Milkshop\Admin\Entity;

use Ninja\DatabaseTable;

class DonHang
{
    const CLASS_NAME = '\Milkshop\Admin\Entity\DonHang';
    
    public $id;
    public $khach_hang;
    public $ngay_mua;
    public $tong_tien;
    
    private $adminKhachHangTable;
    private $adminChiTietDonHangTable;
    
    private $khach_hang_entity;
    private $chi_tiet_don_hang_entity;
    
    public function __construct(DatabaseTable $adminKhachHangTable, DatabaseTable $adminChiTietDonHangTable)
    {
        $this->adminKhachHangTable = $adminKhachHangTable;
        $this->adminChiTietDonHangTable = $adminChiTietDonHangTable;
    }
    
    public function get_ngay_mua_dmy()
    {
        $date = new \DateTime($this->ngay_mua);
        if (!$date)
            return 'N/A';
        
        return $date->format('d-m-Y H:i:s');
    }
    
    public function get_khach_hang()
    {
        if (!$this->khach_hang_entity) {
            $this->khach_hang_entity = $this->adminKhachHangTable->findById($this->khach_hang);
        }
        
        return $this->khach_hang_entity;
    }
    
    public function get_tong_tien()
    {
        $formatter = new \NumberFormatter('vi_VN', \NumberFormatter::CURRENCY);
        return $formatter->formatCurrency($this->tong_tien, 'VND');
    }
    
    public function get_chi_tiet_don_hang()
    {
        if (!$this->chi_tiet_don_hang_entity) {
            $this->chi_tiet_don_hang_entity = $this->adminChiTietDonHangTable->find('don_hang', $this->id);
        }
        
        return $this->chi_tiet_don_hang_entity;
    }
    
    public function get_so_loai()
    {
        if (!$this->chi_tiet_don_hang_entity) {
            $this->get_chi_tiet_don_hang();
        }
        
        return count($this->chi_tiet_don_hang_entity);
    }
    
    public function get_so_luong()
    {
        if (!$this->chi_tiet_don_hang_entity) {
            $this->get_chi_tiet_don_hang();
        }
        
        $total = 0;
        foreach ($this->chi_tiet_don_hang_entity as $item) {
            $total += $item->so_luong;
        }
        
        return $total;
    }
}
