<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title><?= $shop_name ?> | <?= $title ?></title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="/static/client/css/bootstrap.min.css">
    <script src="/static/client/js/feather.min.js"></script>

    <!-- Favicons -->
    <meta name="theme-color" content="#7952b3">

    <!-- Custom styles for this template -->
    <link href="/static/client/css/carousel.css" rel="stylesheet">
    <link href="/static/client/css/feature.css" rel="stylesheet">

    <?php foreach ($custom_styles as $style): ?>
        <link rel="stylesheet" href="<?= $style ?>">
    <?php endforeach; ?>
</head>
<body>

<header>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="/"><?= $shop_name?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                    aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link <?= $route === '/' ? 'active' : '' ?>"
                           href="/">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= strpos($route, "/admin") !== false ? 'active' : '' ?>" href="/admin">Admin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  <?= strpos($route, "/san-pham") !== false ? 'active' : '' ?>"
                           href="#">Sản phẩm</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  <?= strpos($route, "/hang-sua") !== false ? 'active' : '' ?>"
                           href="#">Hãng sữa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  <?= strpos($route, "/loai-sua") !== false ? 'active' : '' ?>"
                           href="#">Loại sữa</a>
                    </li>
                </ul>
                <ul class="navbar-nav mb-2 mb-md-0 me-0 me-md-2">
                    <li class="nav-item">
                        <a class="nav-link  <?= strpos($route, "/gio-hang") !== false ? 'active' : '' ?>"
                           href="/gio-hang">
                            <span data-feather="shopping-cart"></span>
                            Giỏ hàng
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  <?= strpos($route, "/khach-hang") !== false ? 'active' : '' ?>"
                           href="/khach-hang/profile">Xin
                            chào Nguyễn Trọng Hiếu</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Tìm kiếm">
                    <button class="btn btn-outline-success" type="submit">Tìm</button>
                </form>
            </div>
        </div>
    </nav>
</header>

<main>

    <?= $content ?>
    
    <!-- FOOTER -->
    <footer class="container  mt-5">
        <p class="float-end"><a href="#">Lên đầu trang</a></p>
        <p>&copy; 2021 <?= $shop_name ?>, Inc. &middot; <a href="#">Chính sách riêng tư</a> &middot; <a href="#">Điều khoản</a></p>
    </footer>
</main>

<script src="/static/client/js/bootstrap.bundle.min.js"></script>

<script>
    window.feather.replace();
</script>

<?php foreach ($custom_scripts as $script): ?>
    <script src="<?= $script ?>"></script>
<?php endforeach; ?>

</body>
</html>
