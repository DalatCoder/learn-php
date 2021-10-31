<?php

namespace Milkshop\Admin\Controller;

use Ninja\DatabaseTable;

class ChiTietDonHangController implements \Ninja\IController
{
    private $adminChiTietDonHangTable;
    
    public function __construct(DatabaseTable $adminChiTietDonHangTable)
    {
        $this->adminChiTietDonHangTable = $adminChiTietDonHangTable;
    }

    public function index(): array
    {
        return [];
    }

    public function show(): array
    {
        return [];
    }

    public function create(): array
    {
        return [];
    }
    
    public function store(): void
    {
    }

    public function edit(): array
    {
        return [];
    }

    public function update(): void
    {
    }

    public function destroy(): void
    {
    }
}
