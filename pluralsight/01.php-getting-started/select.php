<ul>
  <?php

  $db = new mysqli(
    'localhost',
    'root',
    '',
    'php-getting-started'
  );

  $sql = 'SELECT * FROM users';

  $result = $db->query($sql);

  foreach ($result as $key => $value) {
    $color = $value['color'];
    $name = $value['name'];
    $gender = $value['gender'];

    printf(
      '
    <li><span style="color: %s">%s (%s)</span></li>
  ',
      htmlspecialchars($color, ENT_QUOTES),
      htmlspecialchars($name, ENT_QUOTES),
      htmlspecialchars($gender, ENT_QUOTES),
    );
  }

  $db->close();
  ?>
</ul>
