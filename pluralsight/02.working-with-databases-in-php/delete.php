<?php

require('my_config.php');

$manager = new MongoDB\Driver\Manager(MONGO_CONNECTION_STRING);

if (isset($_GET['id'])) {
  $bulk = new MongoDB\Driver\BulkWrite;
  $bulk->delete(
    ['_id' => new MongoDB\BSON\ObjectId($_GET['id'])],
    ['limit' => 1]
  );

  $result = $manager->executeBulkWrite(MONGO_DB_NAME . '.users', $bulk);

  header('Location: index.php');
}
