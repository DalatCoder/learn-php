<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <h1 class="h2 my-5">Quản lý sản phẩm sữa</h1>

    <div class="row mb-3">
        <div class="col d-flex justify-content-end">
            <a href="/admin/san-pham/create" class="btn btn-primary">Thêm mới</a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">SKU</th>
                <th scope="col">Tên</th>
                <th scope="col">Hãng</th>
                <th scope="col">Loại</th>
                <th scope="col">Trọng lượng</th>
                <th scope="col">Đơn giá</th>
                <th scope="col">Ảnh</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($san_phams as $san_pham): ?>
                <tr>
                    <td><?= $san_pham->id ?></td>
                    <td><?= $san_pham->sku ?></td>
                    <td><?= $san_pham->ten ?></td>
                    <td><?= $san_pham->get_hang_sua()->ten_hang ?></td>
                    <td><?= $san_pham->get_loai_sua()->ten_loai ?></td>
                    <td><?= $san_pham->get_trong_luong() ?></td>
                    <td><?= $san_pham->get_don_gia() ?></td>
                    <td>
                        <img height="50px" class="rounded-3" src="<?= $san_pham->ten_hinh_anh_server ?>" alt="">
                    </td>
                    <td>
                        <a class="d-inline-block me-2" href="/admin/san-pham/edit?id=<?= $san_pham->id ?>">
                            <span data-feather="edit"></span>
                        </a>
                        <a class="d-inline-block" href="/admin/san-pham/delete?id=<?= $san_pham->id ?>">
                            <span data-feather="trash"></span>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>
