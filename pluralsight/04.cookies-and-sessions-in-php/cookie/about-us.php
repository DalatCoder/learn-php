<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['subscribe'])) {
    if (isset($_POST['name']) & !empty($_POST['name'])) {
      $username = htmlspecialchars($_POST['name'], ENT_QUOTES);
      $options['expires'] = time() + 3600;
      setcookie('name', $username, $options);
      header('Location: index.php');
    }
  }
}
?>

<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="utf-8">
  <title>PHP Predefined Variables</title>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link href="assets/css/styles.css" rel="stylesheet" type="text/css" />
</head>

<body class="background">
  <div class="container col-md-8">
    <div class="navbar-area text-center">
      <a class="page-scroll" href="index.php">HOME</a>
      <a class="page-scroll" href="about-us.php">ABOUT US</a>
    </div>

    <div class="section-text text-center">
      <h3 class="title">We can help!</h3>
      <p class="text">Stop wasting time and money designing and managing a website that doesn’t get results.
        Happiness guaranteed!</p>

      <?php if (isset($_COOKIE['name'])) : ?>
        <h5 class="title">
          Thank you <?php echo $_COOKIE['name'] ?>, for subscribing to our services
        </h5>
      <?php endif; ?>
    </div>
  </div>
</body>

</html>
