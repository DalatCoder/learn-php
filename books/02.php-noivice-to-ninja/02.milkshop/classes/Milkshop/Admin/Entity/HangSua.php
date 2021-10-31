<?php

namespace Milkshop\Admin\Entity;

class HangSua
{
    const CLASS_NAME = '\Milkshop\Admin\Entity\HangSua';
    
    public $id;
    public $sku;
    public $ten_hang;
    public $dia_chi;
    public $dien_thoai;
    public $email;
    
    public function __construct()
    {
    }
}
