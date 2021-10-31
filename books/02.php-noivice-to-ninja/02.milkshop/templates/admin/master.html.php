<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title><?= $shop_name ?> | <?= $title ?></title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">

    <script src="/static/admin/js/feather.min.js"></script>

    <!-- Favicons -->
    <meta name="theme-color" content="#7952b3">

    <!-- Custom styles for this template -->
    <link href="/static/admin/css/main.css" rel="stylesheet">

    <?php foreach ($custom_styles as $style): ?>
        <link rel="stylesheet" href="<?= $style ?>">
    <?php endforeach; ?>
</head>
<body>

<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="/">Milk Shop</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <input class="form-control form-control-dark w-100" type="text" placeholder="Tìm kiếm" aria-label="Search">
    <div class="navbar-nav">
        <div class="nav-item text-nowrap">
            <a class="nav-link px-3" href="/khach-hang/c-logout.php">Đăng xuất</a>
        </div>
    </div>
</header>

<div class="container-fluid">
    <div class="row">

        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="position-sticky pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link  <?= $route === "/admin" ? 'active' : '' ?>" href="/admin">
                            <span data-feather="home"></span>
                            Tổng quan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= strpos($route, "/admin/hang-sua") !== false ? 'active' : '' ?>" href="/admin/hang-sua">
                            <span data-feather="file"></span>
                            Hãng sữa
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  <?= strpos($route, "/admin/loai-sua") !== false ? 'active' : '' ?>" href="/admin/loai-sua">
                            <span data-feather="hexagon"></span>
                            Loại sữa
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  <?= strpos($route, "/admin/san-pham") !== false ? 'active' : '' ?>" href="/admin/san-pham">
                            <span data-feather="shopping-cart"></span>
                            Sản phẩm
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  <?= strpos($route, "/admin/khach-hang") !== false ? 'active' : '' ?>" href="/admin/khach-hang">
                            <span data-feather="users"></span>
                            Khách hàng
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  <?= strpos($route, "/admin/don-hang") !== false ? 'active' : '' ?>" href="/admin/don-hang">
                            <span data-feather="layers"></span>
                            Đơn hàng
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= strpos($route, "/admin/thong-ke" ) !== false ? 'active' : '' ?>" href="/admin/thong-ke">
                            <span data-feather="bar-chart-2"></span>
                            Thống kê
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:0">
                            <span data-feather="user"></span>
                            Nguyễn Trọng Hiếu </a>
                    </li>
                </ul>
            </div>
        </nav>
        
        <?= $content ?>
        
    </div>
</div>

<script src="/static/admin/js/bootstrap.bundle.min.js"></script>

<script>
    window.feather.replace();
</script>

<?php foreach ($custom_scripts as $script): ?>
    <script src="<?= $script ?>"></script>
<?php endforeach; ?>

</body>
</html>
