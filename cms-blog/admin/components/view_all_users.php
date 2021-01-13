<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Role</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $query = "SELECT * FROM Users";
    $select_all_users_query = mysqli_query($connection, $query);
    if (!$select_all_users_query) {
        die('Oops! Error when fetching users data ' . mysqli_error($connection));
    }

    while ($row = mysqli_fetch_assoc($select_all_users_query)) {
        $user_id = $row['user_id'];
        $username = $row['user_username'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_image = $row['user_image'];
        $user_email = $row['user_email'];
        $user_role = $row['user_role'];
        ?>
        <tr>
            <td><?php echo $user_id; ?></td>
            <td><?php echo $username; ?></td>
            <td><?php echo $user_firstname; ?></td>
            <td><?php echo $user_lastname; ?></td>
            <td><?php echo $user_email; ?></td>
            <td><?php echo $user_role; ?></td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>
