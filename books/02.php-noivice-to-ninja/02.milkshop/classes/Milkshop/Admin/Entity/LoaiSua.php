<?php

namespace Milkshop\Admin\Entity;

use Ninja\DatabaseTable;

class LoaiSua
{
    const CLASS_NAME = '\Milkshop\Admin\Entity\LoaiSua';
    
    public $id;
    public $ten_loai;
    public $mo_ta;
    
    private $adminSanPhamTable;
    
    private $san_pham_entities;
    
    public function __construct(DatabaseTable $adminSanPhamTable)
    {
        $this->adminSanPhamTable = $adminSanPhamTable;
    }
    
    public function get_san_phams()
    {
        if (!$this->san_pham_entities) 
            $this->san_pham_entities = $this->adminSanPhamTable->find('loai_sua', $this->id);
        
        return $this->san_pham_entities;
    }
    
    public function get_so_luong_san_pham()
    {
        return count($this->get_san_phams());
    }
}
