<?php
	$conn = mysqli_connect("localhost", "root", "", "gym");
 
	if(!$conn){
		die("Error: Failed to connect to database!");
	}
?>