<?php include "includes/db.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "includes/head.php"; ?>
</head>

<body>

<!-- Navigation -->
<?php include "includes/navigation.php" ?>;

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="page-header">
                Welcome to my blog
                <small>Hello world</small>
            </h1>

            <?php
            $query = "SELECT count(*) AS total FROM Posts";
            $count_number_of_posts_query = mysqli_query($connection, $query);
            if (!$count_number_of_posts_query) {
                die('Oops! Error when counting number of posts. ' . mysqli_error($connection));
            }
            $number_of_posts = mysqli_fetch_assoc($count_number_of_posts_query)['total'];

            $number_of_posts_by_page = 3;
            $number_of_pages = ceil($number_of_posts / $number_of_posts_by_page);

            $curent_page = 1;
            $start_index = 0;
            if (isset($_GET['page']) && $_GET['page'] && is_numeric($_GET['page'])) {
                $page = $_GET['page'];
                if ($page > $number_of_pages)
                    $page = 1;
                $curent_page = $page;
                $start_index = $curent_page - 1;
                $start_index = $start_index * $number_of_posts_by_page;
            }

            $query = "SELECT * FROM Posts WHERE post_status = 'published' LIMIT $start_index, $number_of_posts_by_page";
            $select_all_posts_query = mysqli_query($connection, $query);
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
                    by
                    <a href="posts.php?source=author&post_author=<?php echo $post_author; ?>"><?php echo $post_author; ?></a>
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
            ?>
            <?php
            if ($number_of_posts > $number_of_posts_by_page) {
                ?>
                <!-- Pager -->
                <ul class="pager">
                    <?php
                    if ($curent_page <= 1) {
                        ?>
                        <li class="previous disabled">
                            <a class="disabled" href="javascript:;">&larr; Older</a>
                        </li>
                        <?php
                    } else {
                        ?>
                        <li class="previous">
                            <a href="index.php?page=<?php echo $curent_page - 1; ?>">&larr; Older</a>
                        </li>
                        <?php
                    }
                    ?>

                    <?php
                    for ($i = 1; $i <= $number_of_pages; $i++) {
                        if ($curent_page == $i) {
                            ?>
                            <li>
                                <a class="active_link" href="index.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                            </li>
                            <?php
                        } else {
                            ?>
                            <li>
                                <a href="index.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                            </li>
                            <?php
                        }
                        ?>

                        <?php
                    }
                    ?>

                    <?php
                    if ($curent_page < $number_of_pages) {
                        ?>
                        <li class="next">
                            <a href="index.php?page=<?php echo $curent_page + 1; ?>">Newer &rarr;</a>
                        </li>
                        <?php
                    } else {
                        ?>
                        <li class="next disabled">
                            <a class="disabled" href="javascript:;">Newer &rarr;</a>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
                <?php
            }
            ?>
        </div>

        <!-- Blog Sidebar Widgets Column -->
        <div class="col-md-4">
            <?php include "includes/sidebar.php"; ?>
        </div>

    </div>
    <!-- /.row -->

    <hr>

    <!-- Footer -->
    <?php include "includes/footer.php"; ?>

</div>
<!-- /.container -->

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

</body>

</html>
