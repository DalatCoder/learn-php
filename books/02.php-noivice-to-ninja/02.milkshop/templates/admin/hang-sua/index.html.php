<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <h1 class="h2 my-5">Quản lý hãng sữa</h1>

    <div class="row mb-3">
        <div class="col d-flex justify-content-end">
            <a href="/admin/hang-sua/create" class="btn btn-primary">Thêm mới</a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">SKU</th>
                <th scope="col">Tên hãng</th>
                <th scope="col">Email</th>
                <th scope="col">Địa chỉ</th>
                <th scope="col">Số điện thoại</th>
                <th scope="col">Số sản phẩm</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>

            <?php foreach ($hang_suas as $hang_sua): ?>
                <tr>
                    <td><?= $hang_sua->id ?></td>
                    <td><?= $hang_sua->sku ?></td>
                    <td><?= $hang_sua->ten_hang ?></td>
                    <td><?= $hang_sua->email ?></td>
                    <td><?= $hang_sua->dia_chi ?></td>
                    <td><?= $hang_sua->dien_thoai ?></td>
                    <td><?= 0 ?></td>
                    <td>
                        <a class="d-inline-block me-2" href="javascript:0">
                            <span data-feather="info"></span>
                        </a>
                        <a class="d-inline-block me-2" href="/admin/hang-sua/edit?id=<?= $hang_sua->id ?>">
                            <span data-feather="edit"></span>
                        </a>
                        <a class="d-inline-block" href="/admin/hang-sua/delete?id=<?= $hang_sua->id ?>">
                            <span data-feather="trash"></span>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>

            </tbody>
        </table>
    </div>
</main>
