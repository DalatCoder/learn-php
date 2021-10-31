<?php

namespace Milkshop\Admin\Entity;

class KhachHang
{
    const CLASS_NAME = '\Milkshop\Admin\Entity\KhachHang';
    
    public $id;
    public $ten;
    public $gioi_tinh;
    public $dia_chi;
    public $dien_thoai;
    public $ten_dang_nhap;
    public $mat_khau;
    public $email;
    public $kieu;
    
    public function __construct()
    {
    }
}
