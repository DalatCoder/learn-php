<?php require('inc/header.php'); ?>

<?php require('inc/navbar.php'); ?>

<div class="container">
  <h1 class="my-3">Thêm người dùng mới</h1>

  <form action="store.php" method="POST">
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">MSSV</label>
      <input autocomplete="off" autofocus name="uid" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Họ</label>
      <input autocomplete="off" type="text" name="lastname" class="form-control" id="exampleInputPassword1">
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword2" class="form-label">Tên</label>
      <input autocomplete="off" type="text" name="firstname" class="form-control" id="exampleInputPassword2">
    </div>
    <button type="submit" class="btn btn-primary" name="submit">Thêm</button>
    <a href="index.php" class="btn btn-secondary">Quay về</a>
  </form>
</div>

<?php require('inc/footer.php'); ?>
