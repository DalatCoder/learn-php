<div class="container marketing mt-5">

    <h1 class="text-center mb-5">Giỏ hàng</h1>

    <div class="row mb-3">
        <div class="col d-flex justify-content-center justify-content-md-end">
            <a href="/index.php" class="btn btn-primary ms-md-auto me-3">Tiếp tục mua hàng</a>
            <a href="/thanh-toan/index.php" class="btn btn-primary">Thanh toán</a>
        </div>
    </div>


    <div class="row mb-3">
        <div class="col">
            <div class="card mb-3">
                <div class="row g-3 align-items-start p-3 justify-content-center">
                    <div class="col-md-4 col-lg-2">
                        <img src="/admin/uploads/6173568dcd6edlon_gold_380g.png"
                             class="img-fluid rounded-start ratio ratio-1x1" alt="...">
                    </div>
                    <div class="col-md-8 col-lg-7">
                        <div class="card-body p-0">
                            <h5 class="card-title">Sữa đặc có đường cao cấp</h5>
                            <p class="card-text mt-1">
                                Hãng: Dutch Lady </p>
                            <p class="card-text">
                                Loại: Sữa đặc </p>
                            <p class="card-text">
                                Trọng
                                lượng: 380 gram </p>
                            <p class="card-text">
                                Dinh dưỡng: NĂNG LƯỢNG
                                326.33 kcal
                                CHẤT BÉO
                                8.05 g
                                CHẤT BÉO BÃO HOÀ
                                5.40 g
                                CARBONHYDRAT
                                56.50 g
                                ĐƯỜNG
                                54.20 g
                                CHẤT ĐẠM
                                6.97 g </p>
                            <p class="card-text">
                                Lợi ích: Sữa đặc có đường nguyên kem Dutch Lady Cao Cấp có hàm lượng kem sữa cao, chứa
                                nhiều vitamin B2, B12, Canxi và nhiều chất đạm hơn sẽ mang đến cho bạn và gia đình những
                                món ăn thơm béo, vị hài hòa từ các món mặn đến món ngọt. </p>
                            <a href="/san-pham/index.php?id=15" class="card-text"><small class="text-muted">Xem chi
                                    tiết</small></a>
                        </div>
                    </div>
                    <div class="col-md-8 col-lg-3">
                        <form action="c-update-product.php" method="POST">
                            <input type="hidden" name="product_id" value="15">
                            <div class="mb-2">
                                <label for="exampleFormControlInput1" class="form-label">Số lượng</label>
                                <input min="0" value="1" type="number"
                                       class="form-control" id="exampleFormControlInput1"
                                       placeholder="Số lượng" name="soluong" autocomplete="off" required>
                            </div>
                            <div class="mb-2">
                                <label for="exampleFormControlInput3" class="form-label">Đơn giá</label>
                                <input value="120000 VNĐ" disabled
                                       type="text" class="form-control" id="exampleFormControlInput3">
                            </div>
                            <div class="mb-2">
                                <label for="exampleFormControlInput4" class="form-label">Thành tiền</label>
                                <input value="120000 VNĐ"
                                       disabled type="text" class="form-control"
                                       id="exampleFormControlInput4">
                            </div>
                            <hr>
                            <div class="d-flex">
                                <input type="submit" value="Cập nhật" class="btn btn-primary me-auto">
                                <a href="c-delete-product.php?product_id=15"
                                   class="btn btn-danger">Xóa</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div><!-- /.container -->
