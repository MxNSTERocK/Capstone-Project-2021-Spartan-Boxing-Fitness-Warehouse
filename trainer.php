<?php
include('./body_trainer/trainer_security.php');

$id = $_GET['ID'];
$status = $_GET['status'];

$stat = "UPDATE tbl_admin SET status = '$status' WHERE ID = '$id' ";
mysqli_query($connection, $stat);

header('location: dashboard.php');
?>