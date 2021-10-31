<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <h1 class="h2 my-5 text-center">Thêm loại sữa</h1>

    <div class="row justify-content-center">
        <div class="col-md-8 col-xl-7">
            <form action="" method="POST">
                <input type="hidden" name="loai-sua[id]" value="<?= $loai_sua->id ?>">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Tên loại</label>
                    <input value="<?= $loai_sua->ten_loai ?>" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Tên loại sữa"
                           name="loai-sua[ten_loai]" autocomplete="off" required>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Mô tả</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="loai-sua[mo_ta]"><?= $loai_sua->mo_ta ?></textarea>
                </div>
                <div class="mb-3">
                    <input type="submit" value="Cập nhật" class="btn btn-primary" name="submit">
                </div>
            </form>
        </div>
    </div>
</main>
