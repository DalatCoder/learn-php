<div class="container marketing mt-5">

    <div class="row mb-3">
        <div class="col">
            <div class="card mb-3">
                <div class="row g-3 align-items-start p-3 justify-content-center">
                    <div class="col-md-4 col-lg-2">
                        <img src="<?= $san_pham->ten_hinh_anh_server ?>"
                             class="img-fluid rounded-start ratio ratio-1x1" alt="...">
                    </div>
                    <div class="col-md-8 col-lg-7">
                        <div class="card-body p-0">
                            <h5 class="card-title"><?= $san_pham->ten ?></h5>
                            <p class="card-text mt-1">Hãng: <?= $san_pham->get_hang_sua()->ten_hang ?></p>
                            <p class="card-text">Loại: <?= $san_pham->get_loai_sua()->ten_loai ?></p>
                            <p class="card-text">
                                Trọng
                                lượng: <?= $san_pham->get_trong_luong() ?> </p>
                            <p class="card-text">
                                Dinh dưỡng: <?= $san_pham->thanh_phan ?> </p>
                            <p class="card-text">
                                Lợi ích: <?= $san_pham->loi_ich ?> </p>
                        </div>
                    </div>
                    <div class="col-md-8 col-lg-3">
                        <form action="/gio-hang/c-add-product.php" method="POST">
                            <input type="hidden" name="product_id"
                                   value="8">
                            <div class="mb-2">
                                <label for="exampleFormControlInput1" class="form-label">Số lượng</label>
                                <input min="0"
                                       value="1"
                                       type="number"
                                       class="form-control" id="exampleFormControlInput1"
                                       placeholder="Số lượng" name="soluong" autocomplete="off" required>
                            </div>
                            <div class="mb-2">
                                <label for="exampleFormControlInput3" class="form-label">Đơn giá</label>
                                <input value="<?= $san_pham->get_don_gia() ?>" type="text"
                                       class="form-control" readonly id="exampleFormControlInput3">
                            </div>
                            <hr>
                            <div class="d-flex">
                                <input type="submit" value="Thêm vào giỏ hàng" class="btn btn-primary me-auto">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if (count($san_pham->get_hang_sua()->get_san_phams()) > 0): ?>
        <hr class="featurette-divider">

        <h2><?= $san_pham->get_hang_sua()->ten_hang ?></h2>

        <div class="row featurette row-cols-1 row-cols-md-2 row-cols-lg-3 align-items-stretch g-4 py-5">

            <?php foreach ($san_pham->get_hang_sua()->get_san_phams() as $item): ?>
                <?php if ($item->id === $san_pham->id) continue; ?>
                <div class="col">
                    <div class="card card-cover h-100 overflow-hidden text-white bg-dark rounded-5 shadow-lg"
                         style="background-image: url('<?= $item->ten_hinh_anh_server ?>'); position: relative">

                        <div
                            style="position:absolute; top: 0; bottom: 0; left: 0; right: 0; background-color: rgba(0,0,0,0.3); z-index: 0;"></div>

                        <div class="d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1" style="z-index: 1">
                            <p class="lead pt-5 mt-5 mb-4 lh-1 fw-bold"><?= $item->ten ?></p>
                            <ul class="d-flex list-unstyled mt-auto">
                                <li class="me-auto">
                                    <span data-feather="dollar-sign"></span>
                                    <small><?= $item->get_don_gia() ?></small>
                                </li>
                                <li class="d-flex align-items-center me-3">
                                    <a class="nav-link p-0 text-white fw-bold"
                                       href="/san-pham/show?id=<?= $item->id ?>">
                                        <span data-feather="eye"></span>
                                    </a>
                                </li>
                                <li class="d-flex align-items-center">
                                    <form action="" method="post">
                                        <input type="hidden" name="product_id"
                                               value="8">
                                        <button type="submit"
                                                class="nav-link p-0 me-1 border-0 bg-transparent text-white fw-bold">
                                            <span data-feather="shopping-cart"></span>
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>

    <?php endif; ?>

    <?php if (count($san_pham->get_loai_sua()->get_san_phams()) > 0): ?>
        <hr class="featurette-divider">

        <h2><?= $san_pham->get_loai_sua()->ten_loai ?></h2>

        <div class="row featurette row-cols-1 row-cols-md-2 row-cols-lg-3 align-items-stretch g-4 py-5">

            <?php foreach ($san_pham->get_loai_sua()->get_san_phams() as $item): ?>
                <?php if ($item->id === $san_pham->id) continue; ?>
                <div class="col">
                    <div class="card card-cover h-100 overflow-hidden text-white bg-dark rounded-5 shadow-lg"
                         style="background-image: url('<?= $item->ten_hinh_anh_server ?>'); position: relative">

                        <div
                            style="position:absolute; top: 0; bottom: 0; left: 0; right: 0; background-color: rgba(0,0,0,0.3); z-index: 0;"></div>

                        <div class="d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1" style="z-index: 1">
                            <p class="lead pt-5 mt-5 mb-4 lh-1 fw-bold"><?= $item->ten ?></p>
                            <ul class="d-flex list-unstyled mt-auto">
                                <li class="me-auto">
                                    <span data-feather="dollar-sign"></span>
                                    <small><?= $item->get_don_gia() ?></small>
                                </li>
                                <li class="d-flex align-items-center me-3">
                                    <a class="nav-link p-0 text-white fw-bold"
                                       href="/san-pham/show?id=<?= $item->id ?>">
                                        <span data-feather="eye"></span>
                                    </a>
                                </li>
                                <li class="d-flex align-items-center">
                                    <form action="" method="post">
                                        <input type="hidden" name="product_id"
                                               value="8">
                                        <button type="submit"
                                                class="nav-link p-0 me-1 border-0 bg-transparent text-white fw-bold">
                                            <span data-feather="shopping-cart"></span>
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    <?php endif; ?>


</div><!-- /.container -->
