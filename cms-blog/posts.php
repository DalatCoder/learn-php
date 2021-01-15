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
            $source = '';
            if (isset($_GET['source'])) {
                $source = $_GET['source'];
            }

            switch ($source) {
                case 'categories':
                    include "includes/view_all_post_by_categories.php";
                    break;

                case 'author':
                    include "includes/view_all_post_by_author.php";
                    break;

                default:
                    echo 'No post.';
                    break;
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
