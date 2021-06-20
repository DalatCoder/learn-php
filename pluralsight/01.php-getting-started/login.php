<?php session_start(); ?>

<?php

require 'config.inc.php';

$name = '';
$password = '';
$message = '';
$isLoggedInSuccess = false;

function getValue($key)
{
  if (isset($_POST[$key])) {

    $value = $_POST[$key];

    if (is_array($value) && count($value) > 0) {
      return $value;
    }

    return htmlspecialchars($value, ENT_QUOTES);
  }

  return NULL;
}

if (isset($_POST['submit'])) {

  $ok = true;

  $name = getValue('name');
  $password = getValue('password');

  if (!$name || !$password) {
    $ok = false;
  }

  if ($ok) {
    $db = new mysqli(
      MYSQL_HOST,
      MYSQL_USER,
      MYSQL_PASSWORD,
      MYSQL_DATABASE
    );

    $sql = sprintf(
      "SELECT * FROM users WHERE name='%s'",
      htmlspecialchars($name, ENT_QUOTES)
    );

    $result = $db->query($sql);

    $row = $result->fetch_object();

    if ($row != null) {
      $passwordHashed = $row->password;

      if (password_verify($password, $passwordHashed)) {
        $isLoggedInSuccess = true;
        $message = 'Login success';

        $_SESSION['username'] = $row->name;
        $_SESSION['isAdmin'] = $row->isAdmin;
      } else {
        $message = 'Login failed';
      }
    } else {
      $message = 'Login failed';
    }

    $db->close();
  }
}

?>

<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
  <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"></script>
  <title>PHP Getting Started</title>
</head>

<body class="container py-5">
  <div class="row justify-content-center">
    <h1 class="text-primary text-center mb-5">Login</h1>

    <form class="col-6" action="" method="post">
      <?php if ($isLoggedInSuccess) : ?>
        <div class="alert alert-success" role="alert">
          <?php echo $message; ?>
        </div>
        <script>
          setTimeout(() => {
            document.querySelector('.alert').hidden = true;
          }, 3000);
        </script>
      <?php else : ?>
        <div class="alert alert-danger" role="alert">
          <?php echo $message; ?>
        </div>
        <script>
          setTimeout(() => {
            document.querySelector('.alert').hidden = true;
          }, 3000);
        </script>
      <?php endif; ?>

      <div class="form-group mb-3">
        <label class="form-label" for="">User Name</label>
        <input class="form-control" type="text" name="name" value="<?php echo htmlspecialchars($name, ENT_QUOTES); ?>" autocomplete="off">
      </div>

      <div class="form-group mb-3">
        <label class="form-label" for="">Password</label>
        <input class="form-control" type="password" name="password"">
      </div>

      <div class=" form-group mb-3">
        <input class="btn btn-primary" type="submit" value="Submit" name="submit">
      </div>
    </form>
  </div>
</body>
