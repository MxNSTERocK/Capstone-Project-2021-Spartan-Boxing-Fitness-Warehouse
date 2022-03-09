<?php
include('security.php');

$id = $_GET['ID'];
$status = $_GET['status'];

$stat = "UPDATE tbl_membership SET status = '$status' WHERE ID = '$id' ";
mysqli_query($connection, $stat);

header('location: membership.php');
?>