<?php include "../includes/db.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "includes/head.php"; ?>
</head>

<body>

<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/navigation.php"; ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to Admin
                        <small>Trong Hieu</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-desktop"></i> Posts
                        </li>
                    </ol>

                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Author</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Image</th>
                            <th>Tags</th>
                            <th>Comments</th>
                            <th>Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $query = "SELECT * FROM Posts";
                        $select_all_posts_query = mysqli_query($connection, $query);
                        if (!$select_all_posts_query) {
                            die('Oops! Error when fetching posts data ' . mysqli_error($connection));
                            return;
                        }

                        while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                            $post_id = $row['post_id'];
                            $post_category_id = $row['post_category_id'];
                            $post_author = $row['post_author'];
                            $post_title = $row['post_title'];
                            $post_date = $row['post_date'];
                            $post_image = $row['post_image'];
                            $post_content = $row['post_content'];
                            $post_tags = $row['post_tags'];
                            $post_comment_count = $row['post_comment_count'];
                            $post_status = $row['post_status'];
                            ?>
                            <tr>
                                <td><?php echo $post_id; ?></td>
                                <td><?php echo $post_author; ?></td>
                                <td><?php echo $post_title; ?></td>
                                <td><?php echo $post_category_id; ?></td>
                                <td><?php echo $post_status; ?></td>
                                <td><img width="100px" src="../images/<?php echo $post_image; ?>" alt="images"> </td>
                                <td><?php echo $post_tags; ?></td>
                                <td><?php echo $post_comment_count; ?></td>
                                <td><?php echo $post_date; ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>

                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

</body>

</html>
