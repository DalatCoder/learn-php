<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <h1 class="h2 my-5 text-center">Cập nhật sản phẩm sữa</h1>

    <div class="row justify-content-center">
        <div class="col-md-8 col-xl-7">
            <form action="" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="san-pham[id]" value="<?= $san_pham->id ?>">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">SKU</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="SKU"
                           name="san-pham[sku]" autocomplete="off" value="<?= $san_pham->sku ?>" required>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput2" class="form-label">Tên sản phẩm</label>
                    <input type="text" class="form-control" id="exampleFormControlInput2"
                           placeholder="Tên sản phẩm" name="san-pham[ten]" autocomplete="off"
                           value="<?= $san_pham->ten ?>" required>
                </div>
                <div class="mb-3">
                    <label for="select1" class="form-label">Hãng sữa</label>
                    <select class="form-select" id="select1" required name="san-pham[hang_sua]">
                        <?php foreach ($hang_suas as $hang_sua): ?>
                            <option
                                value="<?= $hang_sua->id ?>" 
                                <?= $hang_sua->id === $san_pham->hang_sua ? 'selected' : '' ?>
                            ><?= $hang_sua->ten_hang ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="select2" class="form-label">Loại sữa</label>
                    <select class="form-select" id="select2" required name="san-pham[loai_sua]">
                        <option value="" selected>Chọn loại sữa</option>
                        <?php foreach ($loai_suas as $loai_sua): ?>
                            <option 
                                value="<?= $loai_sua->id ?>"
                                <?= $loai_sua->id === $san_pham->loai_sua ? 'selected' : '' ?>
                            ><?= $loai_sua->ten_loai ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput3" class="form-label">Trọng lượng</label>
                    <input type="number" class="form-control" id="exampleFormControlInput3"
                           placeholder="Trọng lượng" name="san-pham[trong_luong]" autocomplete="off" value="<?= $san_pham->trong_luong ?>" required>
                </div>
                <div class="mb-3">
                    <label for="select3" class="form-label">Đơn vị tính</label>
                    <select class="form-select" id="select3" name="san-pham[unit]" required>
                        <option value="gram" <?= $san_pham->unit === 'gram' ? 'selected' : '' ?>>Gram</option>
                        <option value="ml" <?= $san_pham->unit === 'ml' ? 'selected' : '' ?>>Milliliter</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput4" class="form-label">Đơn giá</label>
                    <input type="number" class="form-control" id="exampleFormControlInput4"
                           placeholder="Đơn giá" name="san-pham[don_gia]" autocomplete="off" value="<?= $san_pham->don_gia ?>" required>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Thành phần dinh dưỡng</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                              name="san-pham[thanh_phan]"><?= $san_pham->thanh_phan ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea2" class="form-label">Lợi ích</label>
                    <textarea class="form-control" id="exampleFormControlTextarea2" rows="3"
                              name="san-pham[loi_ich]"><?= $san_pham->loi_ich ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Chọn ảnh đại diện</label>
                    <input class="form-control" type="file" id="formFile" name="anh">
                </div>
                <div class="mb-3">
                    <input type="submit" value="Cập nhật" class="btn btn-primary" name="submit">
                </div>
            </form>
        </div>
    </div>
</main>
