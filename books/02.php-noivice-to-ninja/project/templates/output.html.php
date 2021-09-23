<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
</head>

<body>

    <header>
        <h1>TODO</h1>
    </header>

    <nav>
        <ul>
            <li>
                <a href="/public/index.php">Home</a>
            </li>
            <li>
                <a href="/public/todos.php">Todos</a>
            </li>
            <li>
                <a href="/public/addjoke.php">Add new</a>
            </li>
        </ul>
    </nav>

    <main>
        <?= $output ?>
    </main>

    <footer>
        &copy; NTH <?= date('Y') ?>
    </footer>

</body>

</html>
