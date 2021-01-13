<?php include "includes/db.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "includes/head.php"; ?>
</head>

<body>

<!-- Navigation -->
<?php include "includes/navigation.php"; ?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Post Content Column -->
        <div class="col-lg-8">
            <?php
            if (isset($_GET['post_id']) && $_GET['post_id'] && is_numeric($_GET['post_id'])) {
                $post_id = $_GET['post_id'];

                $query = "SELECT * FROM Posts WHERE post_id = $post_id";
                $select_post_query = mysqli_query($connection, $query);

                if (!$select_post_query) {
                    die('Oops! Error when fetching post data ' . mysqli_error($connection));
                }

                $row = mysqli_fetch_assoc($select_post_query);

                if ($row) {
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];
                    ?>
                    <!-- Blog Post -->

                    <!-- Title -->
                    <h1><?php echo $post_title; ?></h1>

                    <!-- Author -->
                    <p class="lead">
                        by <a href="#"><?php echo $post_author; ?></a>
                    </p>

                    <hr>

                    <!-- Date/Time -->
                    <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>

                    <hr>

                    <!-- Preview Image -->
                    <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="Post image">

                    <hr>

                    <!-- Post Content -->
                    <p class="lead"><?php echo $post_content; ?></p>

                    <hr>

                    <!-- Blog Comments -->
                    <?php
                    if (isset($_POST['create_comment'])) {
                        $post_id = $_GET['post_id'];
                        $comment_author = $_POST['comment_author'];
                        $comment_email = $_POST['comment_email'];
                        $comment_content = $_POST['comment_content'];

                        $query = "INSERT INTO Comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";
                        $query .= "VALUES ($post_id, '$comment_author', '$comment_email', '$comment_content', 'unapproved', now())";

                        $create_comment_query = mysqli_query($connection, $query);
                        if (!$create_comment_query) {
                            die('Oops! Error when creating new comment ' . mysqli_error($connection));
                        }

                        header("Location: post.php?post_id=$post_id");
                    }
                    ?>

                    <!-- Comments Form -->
                    <div class="well">
                        <h4>Leave a Comment:</h4>
                        <form role="form" action="" method="post">
                            <div class="form-group">
                                <label for="author">Author</label>
                                <input type="text" id="author" name="comment_author" class="form-control"
                                       placeholder="Author name">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="comment_email" class="form-control"
                                       placeholder="Author email">
                            </div>
                            <div class="form-group">
                                <label for="content">Content</label>
                                <textarea class="form-control" rows="3" id="content" name="comment_content"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
                        </form>
                    </div>

                    <hr>

                    <!-- Posted Comments -->

                    <!-- Comment -->
                    <?php
                    $post_id = $_GET['post_id'];
                    $query = "SELECT * FROM Comments WHERE comment_post_id = $post_id ";
                    $query .= "AND comment_status = 'approved' ";
                    $query .= "ORDER BY comment_id DESC";
                    
                    $select_approved_comments_query = mysqli_query($connection, $query);
                    if (!$select_approved_comments_query) {
                        die('Oops! Error when fetching comments data ' . mysqli_error($connection));
                    }

                    while ($row = mysqli_fetch_assoc($select_approved_comments_query)) {
                        $comment_author = $row['comment_author'];
                        $comment_date = $row['comment_date'];
                        $comment_content = $row['comment_content'];
                        ?>
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading"><?php echo $comment_author; ?>
                                    <small><?php echo $comment_date; ?></small>
                                </h4>
                                <?php echo $comment_content; ?>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <?php
                }
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
