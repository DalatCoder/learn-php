<?php

$title  = 'Todo list';

try {
    $pdo = new PDO('mysql:host=localhost;dbname=todos;charset=utf8', 'tronghieu', 'tronghieu');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'SELECT * FROM `todo`';
    $results = $pdo->query($sql);

    $todos = [];
    while ($row = $results->fetch()) {
        $todos[] = $row;
    }

    ob_start();

    include __DIR__ . '/../templates/jokes.html.php';

    $output = ob_get_clean();
}
catch (PDOException $e) {
    $output = 'Error while tring to connect to the database ' . $e->getMessage();
}

include __DIR__ . '/../templates/output.html.php';