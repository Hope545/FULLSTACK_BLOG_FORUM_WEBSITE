<?php require "../layouts/header.php"; ?>
<?php require "../../config/config.php"; ?>

<?php 


if(isset($_SESSION['email'])){
    header("location: ".ADMINURL."admin/login-admins.php");
}

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $delete = $conn->query("DELETE FROM `replies` WHERE `id` = '$id' LIMIT 1");
    $delete->execute();

    header("location: show-replies.php");
}