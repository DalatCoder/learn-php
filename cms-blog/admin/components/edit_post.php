<?php
if (isset($_GET['source']) && isset($_GET['post_id']) && $_GET['source'] == "edit_post") {
    $edit_post_id = $_GET['post_id'];
    if (!is_numeric($edit_post_id)) {
        die('Invalid post id');
    }

    $query = "SELECT * FROM Posts WHERE post_id = $edit_post_id";
    $select_post_query = mysqli_query($connection, $query);
    if (!$select_post_query) {
        die('Oops! Error when fetching post data ' . mysqli_error($connection));
    }

    $count = mysqli_num_rows($select_post_query);
    if ($count == 0) {
        echo 'No data';
        return;
    }

    $row = mysqli_fetch_assoc($select_post_query);
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
}

if (isset($_POST['update_post'])) {
    $post_title = $_POST['post_title'];
    $post_author = $_POST['post_author'];
    $post_category_id = $_POST['post_category_id'];
    $post_status = $_POST['post_status'];

    $post_image = $_FILES['post_image']['name'];
    if ($post_image) {
        $post_image_temp = $_FILES['post_image']['tmp_name'];
        move_uploaded_file($post_image_temp, "../images/${post_image}");
    }

    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];

    $query = "UPDATE Posts SET ";
    $query .= "post_title = '$post_title', ";
    $query .= "post_author = '$post_author', ";
    $query .= "post_category_id = $post_category_id, ";
    $query .= "post_date = now(), ";
    $query .= "post_status = '$post_status', ";
    $query .= "post_tags = '$post_tags', ";
    if ($post_image) $query .= "post_image = '$post_image', ";
    $query .= "post_content = '$post_content' ";
    $query .= "WHERE post_id = $edit_post_id";

    $update_post_query = mysqli_query($connection, $query);
    if (!$update_post_query) {
        die('Oops! Error when updating post ' . mysqli_error($connection));
    }

    header("Location: posts.php");
}
?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post Title</label>
        <input value="<?php echo $post_title; ?>" type="text" id="title" class="form-control" name="post_title">
    </div>

    <div class="form-group">
        <label for="post_category_id">Post Category</label>
        <select name="post_category_id" id="post_category_id" class="form-control">
            <?php
            $query = "SELECT * FROM Categories";
            $select_all_categories_query = mysqli_query($connection, $query);
            if (!$select_all_categories_query) {
                die('Oops! Error when fetching categories data ' . mysqli_error($connection));
            }

            while ($row = mysqli_fetch_assoc($select_all_categories_query)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];

                if ($cat_id == $post_category_id) {
                    echo "<option value='${cat_id}' selected>${cat_title}</option>";
                } else {
                    echo "<option value='${cat_id}'>${cat_title}</option>";
                }
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="author">Post Author</label>
        <input value="<?php echo $post_author; ?>" type="text" id="author" class="form-control" name="post_author">
    </div>

    <div class="form-group">
        <label for="status">Post Status</label>
        <input value="<?php echo $post_status; ?>" type="text" id="status" class="form-control" name="post_status">
    </div>

    <div class="form-group">
        <div>
            <img src="../images/<?php echo $post_image; ?>" alt="Post image" width="100">
        </div>
        <label for="image">Post Image</label>
        <input value="<?php echo $post_image; ?>" type="file" id="image" name="post_image" class="form-control">
    </div>

    <div class="form-group">
        <label for="tags">Post Tags</label>
        <input value="<?php echo $post_tags; ?>" type="text" class="form-control" name="post_tags" id="tags">
    </div>

    <div class="form-group">
        <label for="content">Post Content</label>
        <textarea name="post_content" id="content" cols="30" rows="10" class="form-control"><?php echo $post_content; ?></textarea>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_post" value="Update Post">
    </div>
</form>