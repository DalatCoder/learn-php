<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <h1 class="h2 my-5">Quản lý đơn hàng</h1>

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
                <th scope="col">Khách hàng</th>
                <th scope="col">Ngày mua</th>
                <th scope="col">Tổng tiền</th>
                <th scope="col">Số loại</th>
                <th scope="col">Số lượng</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($don_hangs as $don_hang): ?>
                <tr>
                    <td><?= $don_hang->id ?></td>
                    <td><?= $don_hang->get_khach_hang()->ten ?></td>
                    <td><?= $don_hang->get_ngay_mua_dmy() ?></td>
                    <td><?= $don_hang->get_tong_tien() ?></td>
                    <td><?= $don_hang->get_so_loai() ?></td>
                    <td><?= $don_hang->get_so_luong() ?></td>
                    <td>
                        <a class="d-inline-block me-2" href="/admin/don-hang/show?id=<?= $don_hang->id ?>">
                            <span data-feather="info"></span>
                        </a>
                        <a class="d-inline-block me-2" href="/admin/don-hang/edit?id=<?= $don_hang->id ?>">
                            <span data-feather="edit"></span>
                        </a>
                        <a class="d-inline-block" href="/admin/don-hang/delete?id=<?= $don_hang->id ?>">
                            <span data-feather="trash"></span>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>
