<?php
$db = new mysqli(
  'localhost',
  'root',
  '',
  'php-getting-started'
);

$sql = 'SELECT * FROM users';

$result = $db->query($sql);

foreach ($result as $row) {
  $row['id'] = htmlspecialchars($row['id'], ENT_QUOTES);
  $row['color'] = htmlspecialchars($row['color'], ENT_QUOTES);
  $row['name'] = htmlspecialchars($row['name'], ENT_QUOTES);
  $row['gender'] = htmlspecialchars($row['gender'], ENT_QUOTES);
}

$db->close();
?>


<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
  <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"></script>
  <title>PHP Getting Started</title>
</head>

<body class="container py-5">
  <div class="row justify-content-center">
    <table class="table table-hover table-borderless">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Gender</th>
          <th>Color</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($result as $index => $item) : ?>
          <tr>
            <td><?php echo $item['id']; ?></td>
            <td><?php echo $item['name']; ?></td>
            <td><?php echo $item['gender']; ?></td>
            <td><?php echo $item['color']; ?></td>

            <td>
              <a href="update.php?id=<?php echo $item['id']; ?>" class="btn btn-sm btn-info">Update</a>
              <a href="delete.php?id=<?php echo $item['id']; ?>" class="btn btn-sm btn-danger">Delete</a>
            </td>

          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

  </div>
</body>
