<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <th>ID</th>
        <th>Author</th>
        <th>Email</th>
        <th>Comment</th>
        <th>Status</th>
        <th>In response to</th>
        <th>Date</th>
        <th>Approve</th>
        <th>Unapprove</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $query = "SELECT * FROM Comments JOIN Posts ON comment_post_id = post_id";
    $select_all_comments_query = mysqli_query($connection, $query);
    if (!$select_all_comments_query) {
        die('Oops! Error when fetching comments data ' . mysqli_error($connection));
    }

    while ($row = mysqli_fetch_assoc($select_all_comments_query)) {
        $post_id = $row['post_id'];
        $post_title = $row['post_title'];
        $comment_id = $row['comment_id'];
        $comment_author = $row['comment_author'];
        $comment_email = $row['comment_email'];
        $comment_content = $row['comment_content'];
        $comment_status = $row['comment_status'];
        $comment_date = $row['comment_date'];
        ?>
        <tr>
            <td><?php echo $comment_id; ?></td>
            <td><?php echo $comment_author; ?></td>
            <td><?php echo $comment_email; ?></td>
            <td><?php echo $comment_content; ?></td>
            <td><?php echo $comment_status; ?></td>
            <td><a href="../post.php?post_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a></td>
            <td><?php echo $comment_date; ?></td>
            <td><a href="comments.php?source=approved_comment&comment_id=<?php echo $comment_id; ?>">Approved</a></td>
            <td><a href="comments.php?source=unapproved_comment&comment_id=<?php echo $comment_id; ?>">Unapproved</a>
            </td>
            <td><a href="comments.php?source=delete_comment&comment_id=<?php echo $comment_id; ?>">Delete</a></td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>
