<?php

if (isset($_GET['id'])) {
  $value = $_GET['id'];

  if (!ctype_digit($value)) {
    header('Location: select.php');
    return;
  }

  $db = new mysqli(
    'localhost',
    'root',
    '',
    'php-getting-started'
  );

  $sql = "DELETE FROM users WHERE id=$value";

  $db->query($sql);

  echo '<p>User deleted</p>';

  $db->close();
}
