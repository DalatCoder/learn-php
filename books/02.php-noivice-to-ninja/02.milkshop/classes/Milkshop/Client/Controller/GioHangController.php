<?php

namespace Milkshop\Client\Controller;

use Milkshop\Client\Entity\GioHang;

class GioHangController
{
    private $gioHangEntity;
    
    public function __construct(GioHang $gioHangEntity)
    {
        $this->gioHangEntity = $gioHangEntity;
    }

    public function show_cart_page()
    {
        $san_phams = $this->gioHangEntity->get_all();
        
        return [
            'template' => 'client/gio-hang/index.html.php',
            'master' => 'client/master.html.php',
            'title' => 'Giỏ hàng',
            'variables' => [
                'san_pham' => $san_phams
            ]
        ];
    }
}
