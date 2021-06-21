<?php
require('my_config.php');

$manager = new MongoDB\Driver\Manager(MONGO_CONNECTION_STRING);

$bulk = new MongoDB\Driver\BulkWrite;
?>

<?php

if (isset($_POST['submit'])) {
  $uid = '';
  $firstname = '';
  $lastname = '';

  if (isset($_POST['uid']) && $_POST['uid']) {
    $uid = $_POST['uid'];
  }
  if (isset($_POST['firstname']) && $_POST['firstname']) {
    $firstname = $_POST['firstname'];
  }
  if (isset($_POST['lastname']) && $_POST['lastname']) {
    $lastname = $_POST['lastname'];
  }

  if ($uid && $firstname && $lastname) {
    $newUser = [
      'uid' => $uid,
      'firstname' => $firstname,
      'lastname' => $lastname
    ];

    $id = $bulk->insert($newUser);

    $result = $manager->executeBulkWrite(MONGO_DB_NAME . '.users', $bulk);
  }

  header("Location: index.php");
}
