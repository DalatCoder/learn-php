<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">

    <title><?= $title ?></title>

    <?php foreach ($custom_styles as $style): ?>
        <link rel="stylesheet" href="<?= $style ?>">
    <?php endforeach; ?>
</head>

<body class="min-vh-100">

<div class="d-flex flex-column justify-content-start min-vh-100">
    
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="/">NTH Todos</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/todos">Danh sách</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/about">Giới thiệu</a>
                    </li>
                </ul>
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="/auth/register">Tạo tài khoản</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/auth/login">Đăng nhập</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <?= $content ?>

    <footer class="mt-auto">
        <div class="mt-3 pt-4 pb-3 bg-light">
            <p class="text-center">&copy;2021 - Nguyen Trong Hieu - All rights reserved.</p>
        </div>
    </footer>
</div>

<script src="/assets/js/bootstrap.bundle.min.js"></script>

<?php foreach ($custom_scripts as $script): ?>
    <script src="<?= $script ?>"></script>
<?php endforeach; ?>
</body>

</html>
