<?php

namespace Milkshop;

use Milkshop\Admin\Controller\DonHangController;
use Milkshop\Admin\Controller\HangSuaController;
use Milkshop\Admin\Controller\KhachHangController;
use Milkshop\Admin\Controller\LoaiSuaController;
use Milkshop\Admin\Controller\SanPhamController;
use Milkshop\Admin\Entity\ChiTietDonHang;
use Milkshop\Admin\Entity\DonHang;
use Milkshop\Admin\Entity\HangSua;
use Milkshop\Admin\Entity\KhachHang;
use Milkshop\Admin\Entity\LoaiSua;
use Milkshop\Admin\Entity\SanPham;
use Milkshop\Client\Controller\BaoMatController;
use Milkshop\Client\HomeController;
use Ninja\Authentication;
use Ninja\DatabaseTable;
use Ninja\IRoutes;

class MilkshopIRoutes implements IRoutes
{
    private $adminHangSuaTable;
    private $adminLoaiSuaTable;
    private $adminSanPhamTable;
    private $adminKhachHangTable;
    private $adminDonHangTable;
    private $adminChiTietDonHangTable;
    
    private $baoMatHelper;

    public function __construct()
    {
        $this->adminHangSuaTable = new DatabaseTable('hang-sua', 'id', HangSua::CLASS_NAME, [
            &$this->adminSanPhamTable
        ]);
        $this->adminLoaiSuaTable = new DatabaseTable('loai-sua', 'id', LoaiSua::CLASS_NAME, [
            &$this->adminSanPhamTable
        ]);
        $this->adminSanPhamTable = new DatabaseTable('san-pham-sua', 'id', SanPham::CLASS_NAME, [
            &$this->adminHangSuaTable,
            &$this->adminLoaiSuaTable
        ]);
        $this->adminKhachHangTable = new DatabaseTable('khach_hang', 'id', KhachHang::CLASS_NAME);
        $this->adminDonHangTable = new DatabaseTable('don-hang', 'id', DonHang::CLASS_NAME, [
            &$this->adminKhachHangTable,
            &$this->adminChiTietDonHangTable
        ]);
        $this->adminChiTietDonHangTable = new DatabaseTable('chi-tiet-don-hang', 'id', ChiTietDonHang::CLASS_NAME, [
            &$this->adminDonHangTable,
            &$this->adminSanPhamTable
        ]);
        
        $this->baoMatHelper = new Authentication($this->adminKhachHangTable, 'ten_dang_nhap', 'mat_khau');
    }

    public function getRoutes(): array
    {
        /**
         * Admin Controllers
         */
        $hangSuaController = new HangSuaController($this->adminHangSuaTable);
        $loaiSuaController = new LoaiSuaController($this->adminLoaiSuaTable);
        $sanPhamController = new SanPhamController($this->adminSanPhamTable, $this->adminHangSuaTable, $this->adminLoaiSuaTable);
        $khachHangController = new KhachHangController($this->adminKhachHangTable);
        $donHangController = new DonHangController($this->adminDonHangTable);

        $admin_routes = [
            #region Admin Hang Sua
            '/admin/hang-sua' => [
                'GET' => [
                    'controller' => $hangSuaController,
                    'action' => 'index'
                ]
            ],
            '/admin/hang-sua/create' => [
                'GET' => [
                    'controller' => $hangSuaController,
                    'action' => 'create'
                ],
                'POST' => [
                    'controller' => $hangSuaController,
                    'action' => 'store'
                ]
            ],
            '/admin/hang-sua/edit' => [
                'GET' => [
                    'controller' => $hangSuaController,
                    'action' => 'edit'
                ],
                'POST' => [
                    'controller' => $hangSuaController,
                    'action' => 'update'
                ]
            ],
            '/admin/hang-sua/delete' => [
                'GET' => [
                    'controller' => $hangSuaController,
                    'action' => 'destroy'
                ]
            ],
            #endregion

            #region Admin Loai Sua
            '/admin/loai-sua' => [
                'GET' => [
                    'controller' => $loaiSuaController,
                    'action' => 'index'
                ]
            ],
            '/admin/loai-sua/create' => [
                'GET' => [
                    'controller' => $loaiSuaController,
                    'action' => 'create'
                ],
                'POST' => [
                    'controller' => $loaiSuaController,
                    'action' => 'store'
                ]
            ],
            '/admin/loai-sua/edit' => [
                'GET' => [
                    'controller' => $loaiSuaController,
                    'action' => 'edit'
                ],
                'POST' => [
                    'controller' => $loaiSuaController,
                    'action' => 'update'
                ]
            ],
            '/admin/loai-sua/delete' => [
                'GET' => [
                    'controller' => $loaiSuaController,
                    'action' => 'destroy'
                ]
            ],
            #endregion

            #region Admin San Pham
            '/admin/san-pham' => [
                'GET' => [
                    'controller' => $sanPhamController,
                    'action' => 'index'
                ]
            ],
            '/admin/san-pham/create' => [
                'GET' => [
                    'controller' => $sanPhamController,
                    'action' => 'create'
                ],
                'POST' => [
                    'controller' => $sanPhamController,
                    'action' => 'store'
                ]
            ],
            '/admin/san-pham/edit' => [
                'GET' => [
                    'controller' => $sanPhamController,
                    'action' => 'edit'
                ],
                'POST' => [
                    'controller' => $sanPhamController,
                    'action' => 'update'
                ]
            ],
            '/admin/san-pham/delete' => [
                'GET' => [
                    'controller' => $sanPhamController,
                    'action' => 'destroy'
                ]
            ],
            #endregion

            #region Admin Khach Hang
            '/admin/khach-hang' => [
                'GET' => [
                    'controller' => $khachHangController,
                    'action' => 'index'
                ]
            ],
            '/admin/khach-hang/create' => [
                'GET' => [
                    'controller' => $khachHangController,
                    'action' => 'create'
                ],
                'POST' => [
                    'controller' => $khachHangController,
                    'action' => 'store'
                ]
            ],
            '/admin/khach-hang/edit' => [
                'GET' => [
                    'controller' => $khachHangController,
                    'action' => 'edit'
                ],
                'POST' => [
                    'controller' => $khachHangController,
                    'action' => 'update'
                ]
            ],
            '/admin/khach-hang/delete' => [
                'GET' => [
                    'controller' => $khachHangController,
                    'action' => 'destroy'
                ]
            ],
            #endregion

            #region Admin Don Hang
            '/admin/don-hang' => [
                'GET' => [
                    'controller' => $donHangController,
                    'action' => 'index'
                ]
            ],
            '/admin/don-hang/show' => [
                'GET' => [
                    'controller' => $donHangController,
                    'action' => 'show'
                ]
            ]
            #endregion
        ];

        /**
         * Client Controller
         */
        $homeController = new HomeController($this->adminSanPhamTable, $this->adminHangSuaTable, $this->adminLoaiSuaTable);
        $baoMatController = new BaoMatController($this->adminKhachHangTable, $this->baoMatHelper);
        $clientSanPhamController = new \Milkshop\Client\Controller\SanPhamController($this->adminSanPhamTable);

        $client_routes = [
            '/' => [
                'GET' => [
                    'controller' => $homeController,
                    'action' => 'home'
                ]
            ],
            '/bao-mat/login' => [
                'GET' => [
                    'controller' => $baoMatController,
                    'action' => 'show_login_form'
                ],
                'POST' => [
                    'controller' => $baoMatController,
                    'action' => 'process_login'
                ]
            ],
            '/bao-mat/register' => [
                'GET' => [
                    'controller' => $baoMatController,
                    'action' => 'show_register_form'
                ],
                'POST' => [
                    'controller' => $baoMatController,
                    'action' => 'process_register'
                ]
            ],
            '/san-pham/show' => [
                'GET' => [
                    'controller'  => $clientSanPhamController,
                    'action' => 'show'
                ]
            ]
        ];

        /**
         * Combine Controllers
         */
        return $admin_routes + $client_routes;
    }

    public function getAuthentication(): ?Authentication
    {
        return $this->baoMatHelper;
    }

    public function checkPermission($permission): ?bool
    {
        return null;
    }
}
