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
    <ul>
      <?php foreach ($result as $index => $item) : ?>

        <li style="color: <?php echo $item['color']; ?>;"> <?php echo $item['name']; ?> (<?php echo $item['gender']; ?>) </li>

      <?php endforeach; ?>
    </ul>
  </div>
</body>
