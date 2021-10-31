<?php

namespace Milkshop\Admin\Entity;

use Ninja\DatabaseTable;

class HangSua
{
    const CLASS_NAME = '\Milkshop\Admin\Entity\HangSua';

    public $id;
    public $sku;
    public $ten_hang;
    public $dia_chi;
    public $dien_thoai;
    public $email;

    private $adminSanPhamTable;

    private $san_pham_entities;

    public function __construct(DatabaseTable $adminSanPhamTable)
    {
        $this->adminSanPhamTable = $adminSanPhamTable;
    }

    public function get_san_phams()
    {
        if (!$this->san_pham_entities)
            $this->san_pham_entities = $this->adminSanPhamTable->find('hang_sua', $this->id);
        
        return $this->san_pham_entities;
    }
    
    public function get_so_luong_san_pham()
    {
        return count($this->get_san_phams());
    }
}
