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

                if (!$select_all_posts_query) {
                    die('Oops! Error when fetching list of posts ' . mysqli_error($connection));
                }
            }

            while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = $row['post_content'];
                ?>
                <h2>
                    <a href="post.php?post_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="#"><?php echo $post_author; ?></a>
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
