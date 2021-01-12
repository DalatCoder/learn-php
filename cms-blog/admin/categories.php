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
                            <i class="fa fa-file"></i> Categories
                        </li>
                    </ol>

                    <div class="row">
                        <div class="col-md-5">

                            <?php
                            // Create new category

                            if (isset($_POST['submit'])) {
                                $new_cat_title = $_POST['cat_title'];
                                if (!$new_cat_title) {
                                    echo 'This field should not be empty';
                                } else {
                                    $query = "INSERT INTO Categories(cat_title) VALUES('{$new_cat_title}')";

                                    $create_category_query = mysqli_query($connection, $query);
                                    if (!$create_category_query) {
                                        die('Oops! Error when creating new category ' . mysqli_error($connection));
                                    }

                                    // Redirect when we done
                                    // header("Location: categories.php");
                                }
                            }
                            ?>

                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="cat_title">Add Category</label>
                                    <input class="form-control" type="text" id="cat_title" name="cat_title"
                                           autocomplete="off"/>
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="submit" value="Add Category"/>
                                </div>
                            </form>
                            <?php
                            if (isset($_GET['edit'])) {
                                $updated_cat_id = $_GET['edit'];
                                if (is_numeric($updated_cat_id)) {
                                    include "includes/update_category.php";
                                }
                            }
                            ?>
                        </div>

                        <?php
                        // GET Operation

                        // Delete category
                        if (isset($_GET['delete'])) {
                            $delete_cat_id = $_GET['delete'];
                            if (is_numeric($delete_cat_id)) {
                                $query = "DELETE FROM Categories WHERE cat_id = $delete_cat_id";
                                $delete_category_query = mysqli_query($connection, $query);
                                if (!$delete_cat_id) {
                                    die('Oops! Error when deleting selected category ' . mysqli_error($connection));
                                }

                                // Redirect when we done
                                // header("Location: categories.php");
                            }
                        }
                        ?>

                        <?php
                        // FETCH list of categories and display

                        $query = "SELECT * FROM Categories";
                        $select_all_categories_query = mysqli_query($connection, $query);
                        if (!$select_all_categories_query) {
                            die('Oops! Error when fetching category data ' . mysqli_error());
                            return;
                        }
                        $count = mysqli_num_rows($select_all_categories_query);

                        if ($count > 0) {
                            ?>
                            <div class="col-md-7">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Category Title</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    while ($row = mysqli_fetch_assoc($select_all_categories_query)) {
                                        $cat_id = $row['cat_id'];
                                        $cat_title = $row['cat_title'];
                                        ?>
                                        <tr>
                                            <td><?php echo $cat_id; ?></td>
                                            <td><?php echo $cat_title; ?></td>
                                            <td><a href="categories.php?edit=<?php echo $cat_id; ?>">Edit</a></td>
                                            <td><a href="categories.php?delete=<?php echo $cat_id; ?>">Delete</a></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
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