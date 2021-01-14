<?php
if (!isset($_SESSION)) {
    session_start();
}
?>

<?php include "includes/authenticate.php"; ?>

<?php include "../includes/db.php"; ?>
<?php include "functions.php"; ?>

<?php

if (isset($_POST['update_profile'])) {
    $user_id = $_SESSION['user_id'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_username = $_POST['user_username'];
    $user_image = $_FILES['user_image']['name'];
    $user_password = $_POST['user_password'];
    $user_role = $_POST['user_role'];
    $user_email = $_POST['user_email'];

    if ($user_image) {
        $user_image_temp = $_FILES['user_image']['tmp_name'];
        move_uploaded_file($user_image, "images/$user_image");
    }

    $query = "UPDATE Users SET ";
    $query .= "user_firstname = '$user_firstname', ";
    $query .= "user_lastname = '$user_lastname', ";
    $query .= "user_username = '$user_username', ";
    $query .= "user_email = '$user_email', ";
    $query .= "user_password = '$user_password', ";
    if ($user_image) $query .= "user_image = '$user_image', ";
    $query .= "user_role = '$user_role' ";
    $query .= "WHERE user_id = $user_id";

    $update_user_query = mysqli_query($connection, $query);
    if (!$update_user_query) {
        die('Oops! Error when updating user ' . mysqli_error($connection));
    }

    header("Location: profile.php");
}
?>

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
                    <?php include "components/page_heading.php"; ?>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-paypal"></i> Profile
                        </li>
                    </ol>

                    <?php
                    $user_id = $_SESSION['user_id'];
                    $query = "SELECT * FROM Users WHERE user_id = $user_id";

                    $select_admin_query = mysqli_query($connection, $query);
                    if (!$select_admin_query) {
                        die('Oops! Error when fetching admin data ' . mysqli_error($connection));
                    }

                    $count = mysqli_num_rows($select_admin_query);
                    if ($count === 0) {
                        die('Cannot find admin account');
                    }

                    $row = mysqli_fetch_assoc($select_admin_query);
                    $user_username = $row['user_username'];
                    $user_firstname = $row['user_firstname'];
                    $user_lastname = $row['user_lastname'];
                    $user_image = $row['user_image'];
                    $user_email = $row['user_email'];
                    $user_password = $row['user_password'];
                    $user_role = $row['user_role'];
                    ?>

                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="firstname">First Name</label>
                            <input value="<?php echo $user_firstname; ?>" type="text" id="firstname"
                                   class="form-control"
                                   name="user_firstname">
                        </div>

                        <div class="form-group">
                            <label for="lastname">Last Name</label>
                            <input value="<?php echo $user_lastname; ?>" type="text" id="lastname" class="form-control"
                                   name="user_lastname">
                        </div>

                        <div class="form-group">
                            <label for="role">User Role</label>
                            <select name="user_role" id="role" class="form-control">
                                <?php
                                echo "<option value='$user_role' selected>$user_role</option>";

                                if ($user_role == 'admin') {
                                    echo '<option value="subscriber">Subcriber</option>';
                                } else {
                                    echo '<option value="admin">Admin</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="image">User Image</label>
                            <div>
                                <img src="images/<?php echo $user_image; ?>" alt="User image" width="100px">
                            </div>
                            <input type="file" id="image" name="user_image" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input value="<?php echo $user_username; ?>" type="text" class="form-control"
                                   name="user_username"
                                   id="username">
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input value="<?php echo $user_email; ?>" type="email" class="form-control"
                                   name="user_email" id="email">
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input value="<?php echo $user_password; ?>" type="password" class="form-control"
                                   name="user_password" id="password">
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="update_profile" value="Update Profile">
                        </div>
                    </form>
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
