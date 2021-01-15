<?php
if (isset($_GET['category_id']) && $_GET['category_id'] && is_numeric($_GET['category_id'])) {
    $cat_id = $_GET['category_id'];

    $query = "SELECT * FROM Categories WHERE cat_id = $cat_id";
    $select_category_query = mysqli_query($connection, $query);
    if (!$select_category_query) {
        die('Oops! Error when fetching category title ' . mysqli_error($connection));
    }

    $row = mysqli_fetch_assoc($select_category_query);

    if ($row) {
        $cat_title = $row['cat_title'];
        ?>
        <h1 class="page-header">
            All posts in
            <small><?php echo $cat_title; ?></small>
        </h1>
        <?php
    }

    $query = "SELECT * FROM Posts WHERE post_category_id = $cat_id";
    $select_all_posts_query = mysqli_query($connection, $query);
    $number_of_posts = mysqli_num_rows($select_all_posts_query);

    if (!$select_all_posts_query) {
        die('Oops! Error when fetching list of posts ' . mysqli_error($connection));
    }

    while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
        $post_id = $row['post_id'];
        $post_title = $row['post_title'];
        $post_author = $row['post_author'];
        $post_date = $row['post_date'];
        $post_image = $row['post_image'];
        $post_content = $row['post_content'];
        if (strlen($post_content) > 200) $post_content = substr($post_content, 0, 200) . ' ...';
        ?>
        <h2>
            <a href="post.php?post_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
        </h2>
        <p class="lead">
            by <a href="posts.php?source=author&post_author=<?php echo $post_author; ?>"><?php echo $post_author; ?></a>
        </p>
        <p>
            <span class="glyphicon glyphicon-time"></span>
            Posted on <?php echo $post_date; ?>
        </p>
        <hr>
        <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
        <hr>
        <p><?php echo $post_content; ?></p>
        <a class="btn btn-primary" href="post.php?post_id=<?php echo $post_id; ?>">Read More <span
                    class="glyphicon glyphicon-chevron-right"></span></a>

        <hr>
        <?php
    }

    if ($number_of_posts > 5) {
        ?>
        <!-- Pager -->
        <ul class="pager">
            <li class="previous">
                <a href="#">&larr; Older</a>
            </li>
            <li class="next">
                <a href="#">Newer &rarr;</a>
            </li>
        </ul>
        <?php
    }
}
?>