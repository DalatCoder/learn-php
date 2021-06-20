<?php

require 'config.inc.php';

$name = '';
$password = '';
$gender = '';
$color = '';
$languages = [];
$comments = '';
$termAndCondition = '';

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
  $gender = getValue('gender');
  $color = getValue('color');
  $password = getValue('password');

  if (!$name || !$gender || !$color || !$password) {
    $ok = false;
  }

  if ($ok) {
    $db = new mysqli(
      MYSQL_HOST,
      MYSQL_USER,
      MYSQL_PASSWORD,
      MYSQL_DATABASE
    );

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $sql = sprintf(
      "INSERT INTO users (name, gender, color, password) VALUES ('%s', '%s', '%s', '%s')",
      $db->real_escape_string($name),
      $db->real_escape_string($gender),
      $db->real_escape_string($color),
      $db->real_escape_string($hash)
    );

    $result = $db->query($sql);

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
    <form class="col-6" action="" method="post">

      <div class="form-group mb-3">
        <label class="form-label" for="">User Name</label>
        <input class="form-control" type="text" name="name" value="<?php echo htmlspecialchars($name, ENT_QUOTES); ?>">
      </div>

      <div class="form-group mb-3">
        <label class="form-label" for="">Password</label>
        <input class="form-control" type="password" name="password"">
      </div>

      <div class=" form-group mb-3">
        <label for="" class="form-label">Gender</label>
        <div class="form-control">
          <div class="form-check">
            <?php if ($gender === "m") : ?>
              <input type="radio" class="form-check-input" name="gender" value="m" checked>
            <?php else : ?>
              <input type="radio" class="form-check-input" name="gender" value="m">
            <?php endif; ?>

            <label for="" class="form-check-label">Male</label>
          </div>
          <div class="form-check">
            <?php if ($gender === "f") : ?>
              <input type="radio" class="form-check-input" name="gender" value="f" checked>
            <?php else : ?>
              <input type="radio" class="form-check-input" name="gender" value="f">
            <?php endif; ?>

            <label for="" class="form-check-label">Female</label>
          </div>
        </div>
      </div>

      <div class="form-group mb-3">
        <label class="form-label">Favorite color:</label>

        <select name="color" class="form-select">
          <option value="">Please select</option>
          <option value="#f00" <?php if ($color === '#f00') echo 'selected'; ?>>red</option>
          <option value="#0f0" <?php if ($color === '#0f0') echo 'selected'; ?>>green</option>
          <option value="#00f" <?php if ($color === '#00f') echo 'selected'; ?>>blue</option>
        </select>
      </div>

      <div class="form-group mb-3">
        <input class="btn btn-primary" type="submit" value="Submit" name="submit">
      </div>
    </form>
  </div>
</body>
