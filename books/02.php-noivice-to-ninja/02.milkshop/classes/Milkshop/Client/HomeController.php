<?php

namespace Milkshop\Client;

class HomeController
{
    public function home()
    {
        return [
            'template' => 'home.html.php',
            'master' => 'master.html.php',
            'title' => 'Trang chủ'
        ];
    }
}
