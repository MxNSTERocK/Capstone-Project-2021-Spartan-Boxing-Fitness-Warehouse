<?php
include('security.php');
?>


<html>

<head>
	<meta charset="utf-8">
	<title>Details of Reservation</title>
	<link href="css/show.css" rel="stylesheet" />
	<link href="css/googleapis.css" rel="stylesheet" />
	<!-- <link href="css/mdb.css" rel="stylesheet" /> -->
</head>

<style>
	.hide-from-printer {
		position: fixed;
		width: 50%;
		bottom: 10px;
	}

	.button {
		background-color: black;
		border: none;
		color: white;
		padding: 15px 32px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 16px;
		margin: 4px 2px;
		cursor: pointer;
	}

	p {
		color: black;
	}

	td {
		color: black;
	}

	span {
		color: black;
	}

	@media print {
		.hide-from-printer {
			display: none;
		}
	}
</style>

<body>
	<?php
	ob_start();

	$pid = $_GET['sid'];


	$sql = "select * from tbl_reservation where id = '$pid' ";
	$re = mysqli_query($connection, $sql);
	while ($row = mysqli_fetch_array($re)) {
		$id = $row['ID'];
		$firstname =  $row['firstname'];
		$lastname = $row['lastname'];
		$email = $row['mail'];
		$contact = $row['contact'];
		$event = $row['Event'];
		$checkin = $row['checkin'];
		$checkout = $row['checkout'];
		$status = $row['status'];
		$days = $row['days'];
	}
	?>
	<header>
		<h1>Information of Customer</h1>
		<address>
			<p>SPARTAN BOXING AND FITNESS WAREHOUSE,</p>
			<p>Mendez Road,<br>Tagaytay City,<br>Philippines.</p>
			<p>+123 456 789</p>
		</address>
		<span><img alt="" src="reservation/images/logo.jpg"></span>
	</header>
	<article>
		<h1></h1>
		<address>

			<p><br></p>
			<p>Customer Name : <?php echo $firstname . " " . $lastname; ?><br></p>
		</address>
		<table class="meta">
			<tr>
				<th><span>Customer ID</span></th>
				<td><span><?php echo $id; ?></span></td>
			</tr>
			<tr>
				<th><span>Check in Date</span></th>
				<td><span><?php echo $checkin; ?> </span></td>
			</tr>
			<tr>
				<th><span>Check out Date</span></th>
				<td><span><?php echo $checkout; ?> </span></td>
			</tr>

		</table>
		<table>
			<tr>
				<td>Customer phone : <?php echo $contact; ?> </td>

				<td>Customer email : <?php echo $email; ?> </td>
			</tr>
			<tr>
				<td>Event Booked : <?php echo $event; ?> </td>
			</tr>
		</table>
		<br>
		<br>
		<table class="inventory">
			<thead>
				<tr>
					<th><span>Days</span></th>
					<th><span>No of Days</span></th>

				</tr>
			</thead>
			<tbody>
				<tr>
					<td><span>Number of days Booked</span></td>
					<td><span><?php echo $days; ?> </span></td>
				</tr>
			</tbody>
		</table>


	</article>
	<aside>
		<h1><span>Contact us</span></h1>
		<div>
			<p align="center">Email : sample@gmail.com || Web : www.sampple.com || Phone : +123 456 789 </p>
		</div>
	</aside>
	<br>
	<div class="hide-from-printer">
		<center><button class="button" onclick="window.print()">Print this page</button></center>
	</div>
</body>

</html>

<?php

ob_end_flush();

?>