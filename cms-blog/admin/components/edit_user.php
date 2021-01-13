<?php
if (isset($_GET['source']) && isset($_GET['user_id']) && $_GET['source'] == "edit_user") {
    $edit_user_id = $_GET['user_id'];
    if (!is_numeric($edit_user_id)) {
        die('Invalid user id');
    }

    $query = "SELECT * FROM Users WHERE user_id = $edit_user_id";
    $select_user_query = mysqli_query($connection, $query);
    if (!$select_user_query) {
        die('Oops! Error when fetching user data ' . mysqli_error($connection));
    }

    $count = mysqli_num_rows($select_user_query);
    if ($count == 0) {
        echo 'No data';
        return;
    }

    $row = mysqli_fetch_assoc($select_user_query);
    $user_id = $row['user_id'];
    $user_firstname = $row['user_firstname'];
    $user_lastname = $row['user_lastname'];
    $user_role = $row['user_role'];
    $user_username = $row['user_username'];
    $user_email = $row['user_email'];
    $user_password = $row['user_password'];
    $user_image = $row['user_image'];
}

if (isset($_POST['update_user'])) {
    $user_id = $_GET['user_id'];
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

    header("Location: users.php");
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="firstname">First Name</label>
        <input value="<?php echo $user_firstname; ?>" type="text" id="firstname" class="form-control"
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
        <input value="<?php echo $user_username; ?>" type="text" class="form-control" name="user_username"
               id="username">
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input value="<?php echo $user_email; ?>" type="email" class="form-control" name="user_email" id="email">
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input value="<?php echo $user_password; ?>" type="password" class="form-control" name="user_password" id="password">
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_user" value="Update User">
    </div>
</form>