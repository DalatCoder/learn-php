<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <h1 class="h2 my-5 text-center">Chỉnh sửa hãng sữa</h1>

    <div class="row justify-content-center">
        <div class="col-md-8 col-xl-7">
            <form action="" method="POST">
                <input type="hidden" name="hang-sua[id]" value="<?= $hang_sua->id ?>">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Mã SKU</label>
                    <input value="<?= $hang_sua->sku ?>" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Mã SKU" name="hang-sua[sku]" autocomplete="off" required>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput2" class="form-label">Tên hãng</label>
                    <input value="<?= $hang_sua->ten_hang ?>" type="text" class="form-control" id="exampleFormControlInput2" placeholder="Tên hãng sữa" name="hang-sua[ten_hang]" autocomplete="off" required>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput3" class="form-label">Email</label>
                    <input value="<?= $hang_sua->email ?>" type="email" class="form-control" id="exampleFormControlInput3" placeholder="Email" name="hang-sua[email]" autocomplete="off" required>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput4" class="form-label">Số ĐT</label>
                    <input value="<?= $hang_sua->dien_thoai ?>" type="text" class="form-control" id="exampleFormControlInput4" placeholder="Số điện thoại" name="hang-sua[dien_thoai]" autocomplete="off" required>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Địa chỉ</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="hang-sua[dia_chi]"><?= $hang_sua->dia_chi ?></textarea>
                </div>
                <div class="mb-3">
                    <input type="submit" value="Cập nhật" class="btn btn-primary" name="submit">
                </div>
            </form>
        </div>
    </div>
</main>
