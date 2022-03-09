<?php
include('security.php');

$id = $_GET['id'];
$status = $_GET['status'];

$stat = "UPDATE tbl_customer SET status = '$status' WHERE id = '$id' ";
mysqli_query($connection, $stat);

header('location: admin.php');
?>