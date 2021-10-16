<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
</head>

<body>
    <nav>
        <header>
            <h1>Internet Joke Database</h1>
        </header>
        <ul>
            <li> <a href="index.php">Home</a> </li>
            <li> <a href="jokes.php">Jokes List</a> </li>
            <li> <a href="addjoke.php">Add a new Joke</a> </li>
        </ul>
    </nav>

    <main>
        <?= $output ?>
    </main>

    <footer>
        &copy; IJDB 2017
    </footer>
</body>

</html>
