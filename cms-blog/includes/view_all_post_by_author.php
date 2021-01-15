<?php
if (isset($_GET['post_author']) && $_GET['post_author']) {
    $author_name = $_GET['post_author'];

    $query = "SELECT * FROM Posts WHERE post_author = '$author_name'";
    $select_posts_by_author_query = mysqli_query($connection, $query);
    if (!$select_posts_by_author_query) {
        die('Oops! Error when fetching posts by author ' . mysqli_error($connection));
    }

    $number_of_posts = mysqli_num_rows($select_posts_by_author_query);

    if ($number_of_posts > 0) {
        ?>
        <h1 class="page-header">
            All posts by
            <small><?php echo $author_name; ?></small>
        </h1>
        <?php
    }

    while ($row = mysqli_fetch_assoc($select_posts_by_author_query)) {
        $post_id = $row['post_id'];
        $post_title = $row['post_title'];
        $post_date = $row['post_date'];
        $post_image = $row['post_image'];
        $post_content = $row['post_content'];
        if (strlen($post_content) > 200) $post_content = substr($post_content, 0, 200) . ' ...';
        ?>
        <h2>
            <a href="post.php?post_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
        </h2>
        <p class="lead">
            Posted by <?php echo $author_name; ?>
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