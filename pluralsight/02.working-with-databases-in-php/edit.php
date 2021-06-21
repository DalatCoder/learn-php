<?php

require('my_config.php');

$cursor = [];

if (isset($_GET['id'])) {
  $manager = new MongoDB\Driver\Manager(MONGO_CONNECTION_STRING);

  $query = new MongoDB\Driver\Query([
    '_id' => new MongoDB\BSON\ObjectId($_GET['id'])
  ]);

  $cursor = $manager->executeQuery(MONGO_DB_NAME . '.users', $query);
}

?>

<?php require('inc/header.php'); ?>

<?php require('inc/navbar.php'); ?>

<div class="container">
  <h1 class="my-3">Chỉnh sửa thông tin người dùng</h1>

  <?php foreach ($cursor as $row) : ?>
    <form action="update.php" method="POST">
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">MSSV</label>
        <input readonly value="<?php echo $row->uid ?>" autocomplete="off" autofocus name="uid" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Họ</label>
        <input autofocus value="<?php echo $row->lastname ?>" autocomplete="off" type="text" name="lastname" class="form-control" id="exampleInputPassword1">
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword2" class="form-label">Tên</label>
        <input value="<?php echo $row->firstname ?>" autocomplete="off" type="text" name="firstname" class="form-control" id="exampleInputPassword2">
      </div>
      <button type="submit" class="btn btn-primary" name="submit">Cập nhật</button>
      <a href="index.php" class="btn btn-secondary">Quay về</a>
    </form>
  <?php endforeach; ?>

</div>

<?php require('inc/footer.php'); ?>
