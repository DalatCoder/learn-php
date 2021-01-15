<?php
if (!isset($_SESSION)) {
    session_start();
}
?>

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Home</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php
                $query = "SELECT * FROM Categories";
                $select_all_categories_query = mysqli_query($connection, $query);
                if (!$select_all_categories_query) {
                    die('Oops! Error when fetching category data ' . mysqli_error());
                    return;
                }

                while ($row = mysqli_fetch_assoc($select_all_categories_query)) {
                    $title = $row['cat_title'];
                    $id = $row['cat_id'];
                    echo "
                            <li>
                                <a href='category.php?category_id=$id'>{$title}</a>
                            </li>
                        ";
                }
                ?>
                <li>
                    <a href="admin">Admin</a>
                </li>
                <li>
                    <a href='registration.php'>Registration</a>
                </li>
                <?php
                if (isset($_SESSION['user_role'])) {
                    if (isset($_GET['post_id'])) {
                        $post_id = $_GET['post_id'];
                        if (is_numeric($post_id)) {
                            echo "
                            <li>
                                <a href='admin/posts.php?source=edit_post&post_id=$post_id'>Edit Post</a>
                            </li>
                            ";
                        }
                    }
                }
                ?>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
