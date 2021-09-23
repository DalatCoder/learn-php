<?php

$title = 'Create todo table';

try {
    $pdo = new PDO('mysql:host=localhost;dbname=todos;charset=utf8', 'tronghieu', 'tronghieu');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'CREATE TABLE IF NOT EXISTS todo (
        id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        completed_at DATE NULL
    ) DEFAULT  CHARACTER SET utf8 ENGINE=InnoDB';

    $pdo->exec($sql);
    $output = 'Todo table created successfully!';
} catch (PDOException $e) {
    $output = 'Database error: ' . $e->getMessage() . ' in ' . $e->getFile() . ': ' . $e->getLine();
}

include __DIR__ . '/../templates/output.html.php';