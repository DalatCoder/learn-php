<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title><?= $title ?></title>

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

<main>

    <?= $content ?>
    
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
