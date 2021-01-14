<?php
if (isset($_POST['create_post'])) {
    $post_title = $_POST['post_title'];
    $post_author = $_POST['post_author'];
    $post_category_id = $_POST['post_category_id'];
    $post_status = $_POST['post_status'];

    $post_image = $_FILES['post_image']['name'];
    if ($post_image) {
        $post_image_temp = $_FILES['post_image']['tmp_name'];
        move_uploaded_file($post_image_temp, "../images/${post_image}");
    } else {
        $post_image = "default.jpg";
    }

    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_date = date('d-m-y');
    $post_comment_count = 0;

    $query = "INSERT INTO Posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status) ";
    $query .= "VALUES ($post_category_id, '$post_title', '$post_author', now(), '$post_image', '$post_content', '$post_tags', $post_comment_count, '$post_status')";

    $insert_post_query = mysqli_query($connection, $query);
    if (!$insert_post_query) {
        die('Oops! Error when creating new post ' . mysqli_error($connection));
        return;
    }

    header("Location: posts.php");
}
?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" id="title" class="form-control" name="post_title">
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

                echo "<option value='${cat_id}'>${cat_title}</option>";
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="author">Post Author</label>
        <input type="text" id="author" class="form-control" name="post_author">
    </div>

    <div class="form-group">
        <label for="status">Post Status</label>
        <select name="post_status" id="status" class="form-control">
            <option value="draft">Draft</option>
            <option value="published">Published</option>
        </select>
    </div>

    <div class="form-group">
        <label for="image">Post Image</label>
        <input type="file" id="image" name="post_image" class="form-control">
    </div>

    <div class="form-group">
        <label for="tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags" id="tags">
    </div>

    <div class="form-group">
        <label for="editor">Post Content</label>
        <textarea name="post_content" id="editor" cols="30" rows="30" class="form-control"></textarea>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">
    </div>
</form>

<script>
    document.addEventListener("DOMContentLoaded", function (event) {
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    });
</script>