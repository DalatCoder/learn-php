<?php

namespace Milkshop\Client\Entity;

use Ninja\DatabaseTable;

class CartItem
{
    public $san_pham;
    public $so_luong;
    public $gia_mua;
    
    private $adminSanPhamTalbe;
    private $sanPhamEntity;
    
    public function __construct(DatabaseTable $adminSanPhamTalbe)
    {
        $this->adminSanPhamTalbe = $adminSanPhamTalbe;
    }
    
    public function get_san_pham()
    {
        if (!$this->sanPhamEntity) 
            $this->sanPhamEntity = $this->adminSanPhamTalbe->findById($this->san_pham);
        
        return $this->sanPhamEntity;
    }
    
    public function get_gia_mua()
    {
        $formatter = new \NumberFormatter('vi_VN', \NumberFormatter::CURRENCY);
        return $formatter->formatCurrency($this->gia_mua, 'VND');
    }
}
