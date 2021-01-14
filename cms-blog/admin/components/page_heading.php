<?php
if(!isset($_SESSION))
{
    session_start();
}
?>

<?php
$user_firstname = $_SESSION['user_firstname'];
$user_lastname = $_SESSION['user_lastname']
?>

<h1 class="page-header">
    Welcome to Admin page
    <small><?php echo $user_firstname . " " . $user_lastname; ?></small>
</h1>
