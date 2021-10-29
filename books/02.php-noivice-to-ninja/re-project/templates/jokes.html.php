<div class="jokelist">

    <ul class="categories">
        <?php foreach ($categories as $category) : ?>
            <li>
                <a href="/joke/list?category=<?= $category->id ?>"><?= $category->name ?></a>
            </li>
        <?php endforeach; ?>
    </ul>

</div>

<div class="jokes">
    <p class="alert alert-success">
        <?= $totalJokes ?> jokes have been submitted to the Internet Joke Database.
    </p>

    <?php foreach ($jokes as $joke) : ?>

        <blockquote>
            <p>
                <?= htmlspecialchars($joke->joketext, ENT_QUOTES, 'UTF-8') ?>

                (by
                <a href="mailto:<?php echo htmlspecialchars($joke->getAuthor()->email, ENT_QUOTES, 'UTF-8'); ?>">
                    <?php echo htmlspecialchars($joke->getAuthor()->name, ENT_QUOTES, 'UTF-8'); ?>
                </a>
                on
                <?php
                $date = new DateTime($joke->jokedate);
                echo $date->format('jS F Y');
                ?>)

                <?php if ($userid == $joke->authorid) : ?>
                    <a href="/joke/edit?jokeid=<?= $joke->id ?>">Edit</a>

            <form action="/joke/delete" method="POST">
                <input type="hidden" name="id" value="<?= $joke->id ?>">
                <input type="submit" value="Delete">
            </form>

        <?php endif; ?>
        </p>
        </blockquote>

    <?php endforeach; ?>
</div>
