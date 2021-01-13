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
            <td><img width="100px" src="../images/<?php echo $post_image; ?>" alt="images"></td>
            <td><?php echo $post_tags; ?></td>
            <td><?php echo $post_comment_count; ?></td>
            <td><?php echo $post_date; ?></td>
            <td><a href="posts.php?source=edit_post&post_id=<?php echo $post_id; ?>">Edit</a></td>
            <td><a href="posts.php?delete=<?php echo $post_id; ?>">Delete</a></td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>
