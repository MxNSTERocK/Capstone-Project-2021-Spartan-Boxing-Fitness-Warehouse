<?php
include('security.php');

include('body/header.php');
include('body/navbar.php');
?>

<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>QR Code | Log in</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- DataTables -->
	<link rel="stylesheet" href="css/datatable.css">

	<script src="material/jquery/jquery.min.js"></script>
	<script src="material/datatables/jquery.dataTables.min.js"></script>
	<link href="css/googleapis.css" rel="stylesheet" />
	<link href="css/mdb.css" rel="stylesheet" />

	<script>
		$(document).ready(function() {
			$('#dataTable').DataTable();
		});
	</script>

	<style>
		#divvideo {
			box-shadow: 0px 0px 1px 1px rgba(0, 0, 0, 0.1);
		}
	</style>
</head>

<body style="background:#eee">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<?php
				if (isset($_SESSION['error'])) {
					echo "
						<div class='alert alert-danger alert-dismissible' style='background:red;color:#fff'>
						  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
						  <h4><i class='icon fa fa-warning'></i> Error!</h4>
						  " . $_SESSION['error'] . "
						</div>";
					unset($_SESSION['error']);
				}
				if (isset($_SESSION['success'])) {
					echo "
						<div class='alert alert-success alert-dismissible' style='background:green;color:#fff'>
						  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
						  <h4><i class='icon fa fa-check'></i> Success!</h4>
						  " . $_SESSION['success'] . "
						</div>";
					unset($_SESSION['success']);
				}
				?>
				<button type="submit" class="btn btn-success" style="float: right;" onclick="Export()">
					<i class="glyphicon glyphicon-save">&nbsp;</i>Export to Excel </button></p>
			</div>

			<div class="col-md-12">
				<div style="border-radius: 5px;padding:10px;background:#fff;" id="divvideo">
					<br>
					<table id="dataTable" class="table table-bordered">
						<thead>
							<tr style="background-color: #faf1f0;">
								<td>ID</td>
								<td>CUSTOMER</td>
								<td>TEMPERATURE</td>
								<td>TIME IN</td>
								<td>TIME OUT</td>
								<td>STATUS</td>
							</tr>
						</thead>
						<tbody>
							<?php
							$date = date('Y-m-d');
							if ($connection->connect_error) {
								die("Connection failed" . $connection->connect_error);
							}
							$sql = "SELECT * FROM tbl_covid19";
							$query = $connection->query($sql);
							while ($row = $query->fetch_assoc()) {
							?>
								<tr>
									<td><?php echo $row['ID']; ?></td>
									<td><?php echo $row['customer']; ?></td>
									<td><?php echo $row['temperature']; ?></td>
									<td><?php echo $row['timein']; ?></td>
									<td><?php echo $row['timeout']; ?></td>
									<td><?php echo $row['status']; ?></td>
								</tr>
							<?php
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	</div>

	<script>
		function Export() {
			var conf = confirm("Please confirm if you wish to proceed in exporting the attendance in to Excel File");
			if (conf == true) {
				window.open("covid19/export.php", '_blank');
			}
		}
	</script>

</body>

</html>

<script src="material/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="material/jquery-easing/jquery.easing.min.js"></script>
<script src="js/material-dashboard.js"></script>
<script src="js/sweetalert.js"></script>

<?php
include('body/footer.php');
?>