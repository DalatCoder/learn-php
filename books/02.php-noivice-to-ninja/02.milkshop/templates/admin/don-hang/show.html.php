<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <h1 class="h2 my-5">Chi tiết đơn hàng #<?= $don_hang->id ?></h1>

    <div class="row mb-3">
        <div class="col d-flex justify-content-end">
            <a href="" class="btn btn-primary">Thêm mới</a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Ảnh</th>
                <th scope="col">Tên</th>
                <th scope="col">Số lượng</th>
                <th scope="col">Giá mua</th>
                <th scope="col">Thành tiền</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($don_hang->get_chi_tiet_don_hang() as $chi_tiet): ?>
                <tr>
                    <td><?= $chi_tiet->id ?></td>
                    <td>
                        <img height="50px" src="<?= $chi_tiet->get_san_pham()->ten_hinh_anh_server ?>" alt="">
                    </td>
                    <td><?= $chi_tiet->get_san_pham()->ten ?></td>
                    <td><?= $chi_tiet->so_luong ?></td>
                    <td><?= $chi_tiet->get_gia_mua() ?></td>
                    <td><?= $chi_tiet->get_tong_tien() ?></td>
                    <td>
                        <a class="d-inline-block me-2" href="">
                            <span data-feather="edit"></span>
                        </a>
                        <a class="d-inline-block" href="">
                            <span data-feather="trash"></span>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>
