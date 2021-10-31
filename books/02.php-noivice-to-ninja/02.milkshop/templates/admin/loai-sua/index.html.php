<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <h1 class="h2 my-5">Quản lý loại sữa</h1>

    <div class="row mb-3">
        <div class="col d-flex justify-content-end">
            <a href="/admin/loai-sua/create" class="btn btn-primary">Thêm mới</a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Tên loại</th>
                <th scope="col">Mô tả</th>
                <th scope="col">Số sản phẩm</th>
                <th scope="col">Thao tác</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($loai_suas as $loai_sua): ?>
                <tr>
                    <td><?= $loai_sua->id ?></td>
                    <td><?= $loai_sua->ten_loai ?></td>
                    <td><?= $loai_sua->mo_ta ?></td>
                    <td><?= 0 ?></td>
                    <td>
                        <a class="d-inline-block me-2" href="javascript:0">
                            <span data-feather="info"></span>
                        </a>
                        <a class="d-inline-block me-2" href="/admin/loai-sua/edit?id=<?= $loai_sua->id ?>">
                            <span data-feather="edit"></span>
                        </a>
                        <a class="d-inline-block" href="/admin/loai-sua/delete?id=<?= $loai_sua->id ?>">
                            <span data-feather="trash"></span>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>
