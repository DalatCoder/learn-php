<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <h1 class="h2 my-5">Quản lý danh sách tài khoản</h1>

    <div class="row mb-3">
        <div class="col d-flex justify-content-end">
            <a href="/admin/khach-hang/create" class="btn btn-primary">Thêm mới</a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Tên</th>
                <th scope="col">Giới tính</th>
                <th scope="col">Kiểu</th>
                <th scope="col">Email</th>
                <th scope="col">Số điện thoại</th>
                <th scope="col">Địa chỉ</th>
                <th scope="col">Số đơn hàng</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>

            <?php foreach ($khach_hangs as $khach_hang): ?>
                <tr>
                    <td><?= $khach_hang->id ?></td>
                    <td><?= $khach_hang->ten ?></td>
                    <td><?= $khach_hang->gioi_tinh ?></td>
                    <td><?= $khach_hang->dia_chi ?></td>
                    <td><?= $khach_hang->email ?></td>
                    <td><?= $khach_hang->dien_thoai ?></td>
                    <td><?= $khach_hang->dia_chi ?></td>
                    <td>0</td>
                    <td>
                        <a class="d-inline-block me-2" href="javascript:0">
                            <span data-feather="info"></span>
                        </a>
                        <a class="d-inline-block me-2" href="/admin/khach-hang/edit?id=<?= $khach_hang->id ?>">
                            <span data-feather="edit"></span>
                        </a>
                        <a class="d-inline-block" href="/admin/khach-hang/delete?id=<?= $khach_hang->id ?>">
                            <span data-feather="trash"></span>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>
