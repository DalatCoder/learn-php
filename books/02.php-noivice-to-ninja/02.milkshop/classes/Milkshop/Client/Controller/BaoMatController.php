<?php

namespace Milkshop\Client\Controller;

use Ninja\Authentication;
use Ninja\DatabaseTable;

class BaoMatController
{
    private $adminKhachHangTable;
    private $baoMatHelper;
    
    public function __construct(DatabaseTable $adminKhachHangTable, Authentication $baoMatHelper)
    {
        $this->adminKhachHangTable = $adminKhachHangTable;
        $this->baoMatHelper = $baoMatHelper;
    }

    public function show_login_form()
    {
        return [
            'template' => 'client/bao-mat/login.html.php',
            'master' => 'client/master.html.php',
            'title' => 'Đăng nhập'
        ];
    }
    
    public function show_register_form()
    {
        return [
            'template' => 'client/bao-mat/register.html.php',
            'master' => 'client/master.html.php',
            'title' => 'Tạo tài khoản'
        ];
    }
    
    public function process_login()
    {
        $ten_dang_nhap = $_POST['tendangnhap'];
        $mat_khau = $_POST['matkhau'];
        
        $success = $this->baoMatHelper->login($ten_dang_nhap, $mat_khau);
        
        if ($success) {
            header('location: /');
        }
        else {
            header('location: /bao-mat/login');
        }
        
        exit();
    }
    
    public function process_register()
    {
        $ten_dang_nhap = $_POST['khach-hang']['ten_dang_nhap'];
        
        $existing = $this->adminKhachHangTable->find('ten_dang_nhap', $ten_dang_nhap);
        
        if (count($existing) > 0) {
            header('location: /bao-mat/register');
            exit();
        }
        
        $new_khach_hang = $_POST['khach-hang'];
        $this->adminKhachHangTable->save($new_khach_hang);
        
        header('location: /bao-mat/login');
        exit();
    }
}
