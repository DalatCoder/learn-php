<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Authenticate;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $errors = Authenticate::login();

  if (empty($errors)) {
    $issuer = 'https://localdomain.dev';
    $key = 'nguyenthihatrongtronghieu';
    $now = new DateTimeImmutable();
    $expiry = $now->modify('+20 minutes')->getTimestamp();
    $payload = [
      'iss' => $issuer,
      'aud' => $issuer,
      'iat' => $now->getTimestamp(),
      'nbf' => $now->modify('+1 minute')->getTimestamp(),
      'sub' => Authenticate::getFormFieldValue('username'),
      'exp' => $expiry
    ];

    echo \Firebase\JWT\JWT::encode($payload, $key);
    exit;
  }
}
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <title>Hello, world!</title>
</head>

<body>
  <div class="container my-5 text-center">
    <h1>Login with your account</h1>
  </div>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">

        <?php if (!empty($errors)) : ?>
          <?php foreach ($errors as $error) : ?>
            <div class="alert alert-danger mb-3"><?php echo $error; ?></div>
          <?php endforeach; ?>
        <?php endif; ?>

        <form action="" method="post">
          <input type="hidden" name="__csrf" value="<?php echo $_SESSION['token']; ?>">
          <div class="form-group mb-3">
            <label for="username">Username</label>
            <input name="username" type="text" id="username" class="form-control" value="<?php echo Authenticate::getFormFieldValue('username') ?>" autocomplete="off" autofocus>
          </div>
          <div class="form-group mb-3">
            <label for="password">Password</label>
            <input name="password" type="password" id="password" class="form-control">
          </div>

          <div class="d-grid gap-2 d-md block">
            <button type="submit" class="btn btn-primary">Login</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>
