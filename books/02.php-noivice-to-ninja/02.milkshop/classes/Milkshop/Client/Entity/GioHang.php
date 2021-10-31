<?php

use Milkshop\Admin\Entity\ChiTietDonHang;

class GioHang
{
    const S_KEY_PRODUCTS = 'products';
    private $adminSanPhamTable;
    
    public function __construct(\Ninja\DatabaseTable $adminSanPhamTable)
    {
        $this->adminSanPhamTable = $adminSanPhamTable;
        if (session_status() === PHP_SESSION_NONE)
            session_start();
    }
    
    public function add(ChiTietDonHang $chiTietDonHang)
    {
        if ($this->exists($chiTietDonHang)) {
            if ($chiTietDonHang->so_luong > 1) {
                $this->set_amount($chiTietDonHang, $chiTietDonHang->so_luong);
            }
            else {
                $this->increase($chiTietDonHang);
            }
        }
        else {
            $products = $this->get_all();
            $products[] = $chiTietDonHang;
            
            $this->save($products);
        }
    }
    
    public function save($products)
    {
        $_SESSION[self::S_KEY_PRODUCTS] = serialize($products);
    }
    
    public function get_all()
    {
        if (!isset($_SESSION[self::S_KEY_PRODUCTS]) || !is_array($_SESSION[self::S_KEY_PRODUCTS]))
            return [];
        
        $results = [];
        foreach ($_SESSION[self::S_KEY_PRODUCTS] as $item) {
            $serialized_item = unserialize(serialize($item));
            $results[] = $serialized_item;
        }
        
        return $results;
    }
    
    public function clear()
    {
        unset($_SESSION[self::S_KEY_PRODUCTS]);
    }
    
    public function exists(ChiTietDonHang $chiTietDonHang)
    {
        $products = $this->get_all();
        
        foreach ($products as $p) {
            if ($p->id === $chiTietDonHang->id) {
                return $p;
            }
        }
        
        return null;
    }
    
    public function increase(ChiTietDonHang $chiTietDonHang)
    {
        $products = $this->get_all();
        
        $mapped = [];

        foreach ($products as $product) {
            if ($product->id === $chiTietDonHang->id) {
                $product->so_luong += 1;
            }
            
            $mapped[] = $product;
        }
        
        $this->save($mapped);
    }
    
    public function decrease(ChiTietDonHang $chiTietDonHang)
    {
        $products = $this->get_all();

        $mapped = [];

        foreach ($products as $product) {
            if ($product->id === $chiTietDonHang->id) {
                if ($product->so_luong > 0) {
                    $product->so_luong -= 1;
                }
            }

            $mapped[] = $product;
        }

        $this->save($mapped);
    }

    public function set_amount(ChiTietDonHang $chiTietDonHang, $amount)
    {
        $products = $this->get_all();

        $mapped = [];

        foreach ($products as $product) {
            if ($product->id === $chiTietDonHang->id) {
                if ($amount < 0) $amount = 0;
                $product->so_luong = $amount;
            }

            $mapped[] = $product;
        }

        $this->save($mapped);
    }
    
    public function remove(int $product_id)
    {
        $products = $this->get_all();
        
        $filtered = [];

        foreach ($products as $product) {
            if ($product->id !== $product_id)
                $filtered[] = $product;
        }
        
        return $filtered;
    }
    
    public function get_product(ChiTietDonHang $chiTietDonHang)
    {
        return $this->adminSanPhamTable->findById($chiTietDonHang->san_pham);
    }
    
    public function get_product_by_id(int $id)
    {
        $all = $this->get_all();
        
        foreach ($all as $item) {
            if ($item->id === $id) {
                return $this->get_product($item);
            }
        }
        
        return null;
    }
    
    public function get_number_of_products_in_cart()
    {
        $total = 0;
        $products = $this->get_all();

        foreach ($products as $product) {
            $total += $product->so_luong;
        }
        
        return $total;
    }
}
