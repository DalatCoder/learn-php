<?php
if (isset($_POST['create_user'])) {
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_username = $_POST['user_username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $user_role = $_POST['user_role'];

    $user_image = $_FILES['user_image']['name'];
    if ($user_image) {
        $user_image_temp = $_FILES['user_image']['tmp_name'];
        move_uploaded_file($user_image, "images/${user_image}");
    } else {
        $user_image = "default.png";
    }

    $query = "INSERT INTO Users (user_firstname, user_lastname, user_username, user_email, user_password, user_role, user_image)";
    $query .= "VALUES ('$user_firstname', '$user_lastname', '$user_username', '$user_email', '$user_password', '$user_role', '$user_image')";

    $create_user_query = mysqli_query($connection, $query);
    if (!$create_user_query) {
        die('Oops! Error when creating new user ' . mysqli_error($connection));
    }

    header("Location: users.php");
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="firstname">First Name</label>
        <input type="text" id="firstname" class="form-control" name="user_firstname">
    </div>

    <div class="form-group">
        <label for="lastname">Last Name</label>
        <input type="text" id="lastname" class="form-control" name="user_lastname">
    </div>

    <div class="form-group">
        <label for="role">User Role</label>
        <select name="user_role" id="role" class="form-control">
            <option value="subscriber" selected>Select Options</option>
            <option value="subscriber">Subcriber</option>
            <option value="admin">Admin</option>
        </select>
    </div>

    <div class="form-group">
        <label for="image">User Image</label>
        <input type="file" id="image" name="user_image" class="form-control">
    </div>

    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="user_username" id="username">
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="user_email" id="email">
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="user_password" id="password">
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_user" value="Add User">
    </div>
</form>