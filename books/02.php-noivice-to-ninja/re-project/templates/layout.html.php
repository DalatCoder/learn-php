<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/jokes.css">
    <title><?= $title ?></title>
</head>

<body>
    <nav>
        <header>
            <h1>Internet Joke Database</h1>
        </header>
        <ul>
            <li> <a href="/">Home</a> </li>
            <li> <a href="/joke/list">Jokes List</a> </li>
            <li> <a href="/joke/edit">Add a new Joke</a> </li>

            <?php if ($loggedIn) : ?>
                <li> <a href="/category/list">Categories</a> </li>
                <li><a href="/logout">Log out</a></li>
            <?php else : ?>
                <li><a href="/login">Log in</a></li>
            <?php endif; ?>
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
