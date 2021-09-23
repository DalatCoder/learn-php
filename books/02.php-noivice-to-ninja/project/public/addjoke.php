<?php

if (isset($_POST['submit'])) {
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=todos;charset=utf8', 'tronghieu', 'tronghieu');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'INSERT INTO `todo` SET `title` = :title, `completed_at` = :date';

        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':title', $_POST['title']);
        $stmt->bindValue(':date', $_POST['date'] ? $_POST['date'] : '');
        $stmt->execute();

        header('Location: /public/todos.php');
    }
    catch (PDOException $e) {
        $title = 'An error has occurred';

        $output = 'Database error: ' . $e->getMessage() . ' in ' . $e->getFile() . ': ' . $e->getLine();
    }
}
else {
    $title = 'Add a new todo';

    ob_start();

    include __DIR__ . '/../templates/addjoke.html.php';

    $output = ob_get_clean();
}

include __DIR__ . '/../templates/output.html.php';