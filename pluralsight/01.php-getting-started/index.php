<?php

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
  $password = getValue('password');
  $gender = getValue('gender');
  $color = getValue('color');
  $languages = getValue('languages');
  $comments = getValue('comments');
  $termAndCondition = getValue('tc');

  if (!$name || !$password || !$gender || !$color || !$languages || !$comments || !$termAndCondition) {
    $ok = false;
  }

  if (!$languages) $languages = [];

  if ($ok) {
    printf(
      "
        User name: %s <br>
        Password: %s <br>
        Gender: %s <br>
        Color: %s <br>
        Language(s): %s <br>
        Comments: %s <br>
        Term and Conditions: %s <br>
    ",
      $name,
      $password,
      $gender,
      $color,
      implode(' ', $languages),
      $comments,
      $termAndCondition
    );
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
        <label for="" class="form-label">Password</label>
        <input type="password" name="password" class="form-control">
      </div>

      <div class="form-group mb-3">
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
        <label for="" class="form-label">Languages spoken</label>
        <select class="form-select" multiple name="languages[]" id="">
          <option value="en" <?php if (in_array('en', $languages)) echo 'selected'; ?>>English</option>
          <option value="fr" <?php if (in_array('fr', $languages)) echo 'selected'; ?>>French</option>
          <option value="it" <?php if (in_array('it', $languages)) echo 'selected'; ?>>Italian</option>
        </select>
      </div>

      <div class="form-group mb-3">
        <label for="" class="form-label">Comments</label>
        <textarea name="comments" id="" cols="30" rows="3" class="form-control"><?php echo htmlspecialchars($comments, ENT_QUOTES); ?></textarea>
      </div>

      <div class="form-group mb-3">
        <?php if ($termAndCondition === "ok") : ?>
          <input class="form-check-input" type="checkbox" name="tc" value="ok" checked> I accept the T&amp;C <br>
        <?php else : ?>
          <input class="form-check-input" type="checkbox" name="tc" value="ok"> I accept the T&amp;C <br>
        <?php endif; ?>
      </div>

      <div class="form-group mb-3">
        <input class="btn btn-primary" type="submit" value="Submit" name="submit">
      </div>
    </form>
  </div>
</body>
