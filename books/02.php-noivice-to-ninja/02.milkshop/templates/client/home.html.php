<div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true"
                aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg"
                 aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                <rect width="100%" height="100%" fill="#777"/>
            </svg>
            <img src="/uploads/banner01.jpg" class="img-fluid" alt="">
        </div>
        <div class="carousel-item">
            <img src="/uploads/banner02.jpg" class="img-fluid" alt="">
        </div>
        <div class="carousel-item">
            <img src="/uploads/banner03.jpg" class="img-fluid" alt="">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<div class="container marketing">

    <div class="row">
        <div class="col-lg-4">
            <img width="128" src="/uploads/superhero.png" class="img-fluid" alt="">

            <h2>Mạnh khỏe</h2>
            <p>Nguồn dinh dưỡng mỗi ngày giúp các bé mạnh khỏe</p>
            <p><a class="btn btn-secondary" href="javascript:0;">Xem chi tiết &raquo;</a></p>
        </div>

        <div class="col-lg-4">
            <img width="128" src="/uploads/shield.png" class="img-fluid" alt="">

            <h2>An toàn</h2>
            <p>Sữa chất lượng, rõ nguồn gốc xuất xứ, an toàn cho cả nhà</p>
            <p><a class="btn btn-secondary" href="javascript:0;">Xem chi tiết &raquo;</a></p>
        </div>

        <div class="col-lg-4">
            <img width="128" src="/uploads/loss.png" alt="">

            <h2>Tiết kiệm</h2>
            <p>Tiết kiệm nhiều hơn với các ưu đãi từ cửa hàng</p>
            <p><a class="btn btn-secondary" href="javascript:0;">Xem chi tiết &raquo;</a></p>
        </div>
    </div>

    <hr class="featurette-divider">
    
    <?php foreach ($hang_suas as $hang_sua): ?>
    <h2><?= $hang_sua->ten_hang ?></h2>
    
    <div class="row featurette row-cols-1 row-cols-md-2 row-cols-lg-3 align-items-stretch g-4 py-5">
        
        <?php foreach ($hang_sua->get_san_phams() as $san_pham): ?>

        <div class="col">
            <div class="card card-cover h-100 overflow-hidden text-white bg-dark rounded-5 shadow-lg"
                 style="background-image: url('<?= $san_pham->ten_hinh_anh_server ?>'); position: relative">

                <div style="position:absolute; top: 0; bottom: 0; left: 0; right: 0; background-color: rgba(0,0,0,0.3); z-index: 0;"></div>

                <div class="d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1" style="z-index: 1">
                    <p class="lead pt-5 mt-5 mb-4 lh-1 fw-bold"><?= $san_pham->ten ?></p>
                    <ul class="d-flex list-unstyled mt-auto">
                        <li class="me-auto">
                            <span data-feather="dollar-sign"></span>
                            <small><?= $san_pham->get_don_gia() ?></small>
                        </li>
                        <li class="d-flex align-items-center me-3">
                            <a class="nav-link p-0 text-white fw-bold"
                               href="/san-pham/show?id=<?= $san_pham->id ?>">
                                <span data-feather="eye"></span>
                            </a>
                        </li>
                        <li class="d-flex align-items-center">
                            <form action="/gio-hang" method="post">
                                <input type="hidden" name="product_id"
                                       value="8">
                                <button type="submit" class="nav-link p-0 me-1 border-0 bg-transparent text-white fw-bold">
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
    <hr class="featurette-divider">
    <?php endforeach; ?>
    
    <?php foreach ($loai_suas as $loai_sua): ?>
    <h2><?= $loai_sua->ten_loai ?></h2>

    <div class="row featurette row-cols-1 row-cols-md-2 row-cols-lg-3 align-items-stretch g-4 py-5">
        
        <?php foreach ($loai_sua->get_san_phams() as $san_pham): ?>
        <div class="col">
            <div class="card card-cover h-100 overflow-hidden text-white bg-dark rounded-5 shadow-lg"
                 style="background-image: url('<?= $san_pham->ten_hinh_anh_server ?>'); position: relative">

                <div style="position:absolute; top: 0; bottom: 0; left: 0; right: 0; background-color: rgba(0,0,0,0.3); z-index: 0;"></div>

                <div class="d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1" style="z-index: 1">
                    <p class="lead pt-5 mt-5 mb-4 lh-1 fw-bold"><?= $san_pham->ten ?></p>
                    <ul class="d-flex list-unstyled mt-auto">
                        <li class="me-auto">
                            <span data-feather="dollar-sign"></span>
                            <small><?= $san_pham->get_don_gia() ?></small>
                        </li>
                        <li class="d-flex align-items-center me-3">
                            <a class="nav-link p-0 text-white fw-bold"
                               href="">
                                <span data-feather="eye"></span>
                            </a>
                        </li>
                        <li class="d-flex align-items-center">
                            <form action="/gio_hang" method="post">
                                <input type="hidden" name="product_id"
                                       value="10">
                                <button type="submit" class="nav-link p-0 me-1 border-0 bg-transparent text-white fw-bold">
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
    <hr class="featurette-divider">
    <?php endforeach; ?>
    
</div><!-- /.container -->
