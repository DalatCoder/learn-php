<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <h1 class="h2 my-5 text-center">Thêm tài khoản</h1>

    <div class="row justify-content-center">
        <div class="col-md-8 col-xl-7">
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Tên</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Tên" name="khach-hang[ten]"
                           autocomplete="off" required>
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
                    <textarea class="form-control" id="exampleFormControlTextarea2" rows="3" name="khach-hang[dia_chi]"></textarea>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput2" class="form-label">Số điện thoại</label>
                    <input type="text" class="form-control" id="exampleFormControlInput2" placeholder="Số điện thoại"
                           name="khach-hang[dien_thoai]" autocomplete="off" required>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput" class="form-label">Email</label>
                    <input type="email" class="form-control" id="exampleFormControlInput" placeholder="Email"
                           name="khach-hang[email]" autocomplete="off" required>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput3" class="form-label">Tên đăng nhập</label>
                    <input type="text" class="form-control" id="exampleFormControlInput3" placeholder="Tên đăng nhập"
                           name="khach-hang[ten_dang_nhap]" autocomplete="off" required>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput3" class="form-label">Mật khẩu</label>
                    <input type="password" class="form-control" id="exampleFormControlInput3" placeholder="Mật khẩu"
                           name="khach-hang[mat_khau]" autocomplete="off" required>
                </div>
                <div class="mb-3">
                    <label for="select4" class="form-label">Loại tài khoản</label>
                    <select class="form-select" id="select4" name="khach-hang[kieu]" required>
                        <option value="user" selected>Người dùng bình thường</option>
                        <option value="admin">Quản trị viên</option>
                    </select>
                </div>

                <div class="mb-3">
                    <input type="submit" value="Thêm" class="btn btn-primary" name="submit">
                </div>
            </form>
        </div>
    </div>
</main>
