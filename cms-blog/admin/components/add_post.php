<?php
if (isset($_POST['create_post'])) {
    print_r($_POST);
    $post_title = $_POST['post_title'];
    $post_author = $_POST['post_author'];
    $post_category_id = $_POST['post_category_id'];
    $post_status = $_POST['post_status'];

    $post_image = $_FILES['post_image']['name'];
    $post_image_temp = $_FILES['post_image']['tmp_name'];

    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_date = date('d-m-y');
    $post_comment_count = 0;

    move_uploaded_file($post_image_temp, "../images/${post_image}");

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
        <label for="post_category">Post Category ID</label>
        <input type="text" id="post_category" class="form-control" name="post_category_id">
    </div>

    <div class="form-group">
        <label for="author">Post Author</label>
        <input type="text" id="author" class="form-control" name="post_author">
    </div>

    <div class="form-group">
        <label for="status">Post Status</label>
        <input type="text" id="status" class="form-control" name="post_status">
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
        <label for="content">Post Content</label>
        <textarea name="post_content" id="content" cols="30" rows="10" class="form-control"></textarea>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">
    </div>
</form>