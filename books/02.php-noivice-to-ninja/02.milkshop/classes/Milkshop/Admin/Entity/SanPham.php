<?php

namespace Milkshop\Admin\Entity;

use Ninja\DatabaseTable;

class SanPham
{
    const CLASS_NAME = '\Milkshop\Admin\Entity\SanPham';
    
    public $id;
    public $ten;
    public $hang_sua;
    public $loai_sua;
    public $trong_luong;
    public $don_gia;
    public $thanh_phan;
    public $loi_ich;
    public $ten_hinh_anh_goc;
    public $ten_hinh_anh_server;
    public $unit;
    public $ku;
    
    private $adminHangSuaTable;
    private $adminLoaiSuaTable;
    
    private $hang_sua_entity;
    private $loai_sua_entity;
    
    public function __construct(DatabaseTable $adminHangSuaTable, DatabaseTable $adminLoaiSuaTable)
    {
        $this->adminHangSuaTable = $adminHangSuaTable;
        $this->adminLoaiSuaTable = $adminLoaiSuaTable;
    }
    
    public function get_hang_sua()
    {
        if (!$this->hang_sua_entity) {
            $this->hang_sua_entity = $this->adminHangSuaTable->findById($this->hang_sua);
        }
        
        return $this->hang_sua_entity;
    }
    
    public function get_loai_sua()
    {
        if (!$this->loai_sua_entity) {
            $this->loai_sua_entity = $this->adminLoaiSuaTable->findById($this->loai_sua);
        }
        
        return $this->loai_sua_entity;
    }
    
    public function get_trong_luong()
    {
        return $this->trong_luong . ' ' . $this->unit;
    }
    
    public function get_don_gia()
    {
        $formatter = new \NumberFormatter('vi_VN', \NumberFormatter::CURRENCY);
        return $formatter->formatCurrency($this->don_gia, 'VND');
    }
}
