<?php

require('my_config.php');

$manager = new MongoDB\Driver\Manager(MONGO_CONNECTION_STRING);

$query = new MongoDB\Driver\Query([]);

$cursor = $manager->executeQuery(MONGO_DB_NAME . '.users', $query);

$users = $cursor->toArray();
$userCount = count($users);

?>

<?php require('inc/header.php'); ?>

<?php require('inc/navbar.php'); ?>

<div class="container">
  <h1 class="my-3">Tất cả người dùng</h1>
</div>

<div class="container mb-3">
  <div class="row">
    <div class="col float-right">
      <a href="create.php" class="btn btn-primary">Thêm người dùng mới</a>
    </div>
  </div>
</div>

<div class="container">

  <?php if ($userCount > 0) : ?>

    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">MSSV</th>
          <th scope="col">Họ</th>
          <th scope="col">Tên</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($users as $row) : ?>
          <tr>
            <td><?php echo $row->_id ?></td>
            <td><?php echo $row->uid ?></td>
            <td><?php echo $row->lastname ?></td>
            <td><?php echo $row->firstname ?></td>
            <td>
              <a class="btn btn-warning" href="edit.php?id=<?php echo $row->_id ?>">Chỉnh sửa</a>
              <a class="btn btn-danger" href="delete.php?id=<?php echo $row->_id ?>">Xoá</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

  <?php else : ?>

    <p class="leading">Không có người dùng nào. <a href="create.php">Tạo người dùng mới</a></p>

  <?php endif; ?>
</div>

<?php require('inc/footer.php'); ?>
