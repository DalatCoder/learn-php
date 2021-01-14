<?php
if(!isset($_SESSION))
{
    session_start();
}
?>

<?php
if (!isset($_SESSION['user_role'])) {
    header('Location: ../index.php');
    return;
}

$user_role = $_SESSION['user_role'];
if ($user_role !== 'admin') {
    header('Location: ../index.php');
    return;
}
?>
