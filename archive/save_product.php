<?php
	require_once 'conn.php';
 
	if(ISSET($_POST['save'])){
		$product_code = $_POST['product_code'];
		$product_name = $_POST['product_name'];
		$description = $_POST['description'];
		$due_date = $_POST['due_date'];
 
		$insert = mysqli_query($conn, "INSERT INTO `product` VALUES('', '$product_code', '$product_name', '$description', '$due_date')") or die(mysqli_error($conn));
		if($insert)
		header("location: index.php");
	}
?>

<?php
    	date_default_timezone_set("Etc/GMT+8");
     
    	require_once 'conn.php';
     
    	$query = mysqli_query($conn, "SELECT * FROM `product`"); 
    	$date = date("Y-m-d");
    	while($fetch = mysqli_fetch_array($query)){
    		if(strtotime($fetch['due_date']) < strtotime($date)){
    			mysqli_query($conn, "INSERT INTO `archive` VALUES('', '$fetch[product_id]', '$fetch[product_code]', '$fetch[product_name]', '$fetch[description]', '$fetch[due_date]')") or die(mysqli_error($conn));
    			mysqli_query($conn, "DELETE FROM `product` WHERE `product_id` = '$fetch[product_id]'") or die(mysqli_error($conn));
    		}
    	}
    ?>