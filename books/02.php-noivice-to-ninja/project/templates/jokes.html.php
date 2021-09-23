<?php foreach ($todos as $todo): ?>
    <div>
        <p><?= htmlspecialchars($todo['title'], ENT_QUOTES, 'UTF-8') ?></p>
    </div>
<?php endforeach; ?>
