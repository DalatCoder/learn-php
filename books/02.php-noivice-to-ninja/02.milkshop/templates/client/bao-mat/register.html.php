<div class="container marketing mt-5" style="min-height: 100vh">

    <h1 class="text-center">Tạo tài khoản ngay hôm nay</h1>

    <div class="row justify-content-center mt-3">
        <div class="col-sm-10 col-md-6">
            <form action="" method="post">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Tên</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Tên đầy đủ"
                           name="khach-hang[ten]" autocomplete="off" required>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput5" class="form-label">Email</label>
                    <input type="email" class="form-control" id="exampleFormControlInput5" placeholder="Email"
                           name="khach-hang[email]" autocomplete="off" required>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput6" class="form-label">Điện thoại</label>
                    <input type="text" class="form-control" id="exampleFormControlInput6" placeholder="Điện thoại"
                           name="khach-hang[dien_thoai]" autocomplete="off" required>
                </div>
                <div class="mb-3">
                    <label for="select3" class="form-label">Giới tính</label>
                    <select class="form-select" id="select3" name="khach-hang[gioi_tinh]" required>
                        <option value="" selected>Chọn giới tính</option>
                        <option value="Nam">Nam</option>
                        <option value="Nữ">Nữ</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea2" class="form-label">Địa chỉ</label>
                    <textarea class="form-control" id="exampleFormControlTextarea2" rows="3"
                              name="khach-hang[dia_chi]"></textarea>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput2" class="form-label">Tên đăng nhập</label>
                    <input type="text" class="form-control" id="exampleFormControlInput2"
                           placeholder="Tên đăng nhập" name="khach-hang[ten_dang_nhap]" autocomplete="off" required>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput3" class="form-label">Mật khẩu</label>
                    <input type="password" class="form-control" id="exampleFormControlInput3" placeholder="Mật khẩu"
                           name="khach-hang[mat_khau]" autocomplete="off" required>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput4" class="form-label">Nhập lại mật khẩu</label>
                    <input type="password" class="form-control" id="exampleFormControlInput4"
                           placeholder="Nhập lại mật khẩu" name="nhaplaimatkhau" autocomplete="off" required>
                </div>

                <div class="mb-4"></div>

                <input type="submit" value="Tạo tài khoản ngay" class="btn btn-primary mb-5">

            </form>
        </div>
    </div>

</div>
