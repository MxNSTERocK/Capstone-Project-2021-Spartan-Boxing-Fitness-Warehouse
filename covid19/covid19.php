<?php
include('../security.php');

include('../body/header.php');
include('../body/navbar.php');

?>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>QR Code | Log in</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href="../css/material-dashboard.css" rel="stylesheet">

	<script type="text/javascript" src="js/instascan.min.js"></script>
	<script src="plugins/jquery/jquery.min.js"></script>

	<!-- DataTables -->
	<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

	<style>
		#divvideo {
			box-shadow: 0px 0px 1px 1px rgba(0, 0, 0, 0.1);
		}
	</style>
</head>

<body style="background:#eee">
	<div class="container">
		<div class="row">
			<br>
			<div class="col-md-3" style="padding:5px;background:#fff;border-radius: 5px;" id="divvideo">
				<center>
					<p class="login-box-msg">
						<button type="submit" class="btn btn-success" onclick="Export()">
							<i class="glyphicon glyphicon-save">&nbsp;</i>Export to Excel </button>
					</p>
				</center>
				<video id="preview" width="100%" height="50%" style="border-radius:5px;"></video>
				<br>
				<br>
				<?php
				if (isset($_SESSION['error'])) {
					echo "
						<div class='alert alert-danger alert-dismissible' style='background:#389ced;color:#fff'>
						  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
						  <h4><i class='icon fa fa-warning'></i> Error!</h4>
						  " . $_SESSION['error'] . "
						</div>
					  ";
					unset($_SESSION['error']);
				}
				if (isset($_SESSION['success'])) {
					echo "
						<div class='alert alert-success alert-dismissible' style='background:green;color:#fff'>
						  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
						  <h4><i class='icon fa fa-check'></i> Success!</h4>
						  " . $_SESSION['success'] . "
						</div>
					  ";
					unset($_SESSION['success']);
				}
				?>

			</div>
			<div class="col-md-9">
				<form action="CheckInOut.php" method="post" class="form-horizontal" style="border-radius: 5px;padding:10px;background:#fff;" id="divvideo">
					<i class="glyphicon glyphicon-qrcode"></i> <label>SCAN QR CODE</label>
					<p id="time"></p>
					<input type="text" name="text" id="text" placeholder="scan qrcode" class="form-control">
				</form>

				<div style="border-radius: 5px;padding:10px;background:#fff;" id="divvideo">
					<table id="example1" class="table table-bordered">
						<thead>
							<tr>
								<td>CUSTOMER</td>
								<td>ADDRESS</td>
								<td>TEMP</td>
								<td> IN</td>
								<td> OUT</td>
								<td>LOGDATE</td>
								<td>ACTION</td>
							</tr>
						</thead>
						<tbody>
							<?php
							$server = "localhost";
							$username = "root";
							$password = "";
							$dbname = "db_gymreservation";

							$conn = new mysqli($server, $username, $password, $dbname);
							$date = date('Y-m-d');
							if ($conn->connect_error) {
								die("Connection failed" . $conn->connect_error);
							}
							$sql = "SELECT * FROM tbl_covid19 WHERE DATE(LOGDATE)=CURDATE()";
							$query = $conn->query($sql);
							while ($row = $query->fetch_assoc()) {
							?>
								<tr>
									<td><?php echo $row['customer']; ?></td>
									<td><?php echo $row['address']; ?></td>
									<td><?php echo $row['temperature']; ?></td>
									<td><?php echo $row['timein']; ?></td>
									<td><?php echo $row['timeout']; ?></td>
									<td><?php echo $row['logdate']; ?></td>
									<td>
										<form action="#" method="POST">
											<input type="hidden" name="id" value="<?php echo $row['ID']; ?>">
											<button type="submit" name="contact_edit" class="btn btn-success btn-sm">View</button>
										</form>
									</td>
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
	<!-- alert -->
	<script>
		function Export() {
			var conf = confirm("Please confirm if you wish to proceed in exporting the attendance in to Excel File");
			if (conf == true) {
				window.open("export.php", '_blank');
			}
		}
	</script>
	<script>
		let scanner = new Instascan.Scanner({
			video: document.getElementById('preview')
		});
		Instascan.Camera.getCameras().then(function(cameras) {
			if (cameras.length > 0) {
				scanner.start(cameras[0]);
			} else {
				alert('No cameras found');
			}

		}).catch(function(e) {
			console.error(e);
		});

		scanner.addListener('scan', function(c) {
			document.getElementById('text').value = c;
			document.forms[0].submit();
		});
	</script>
	<script type="text/javascript">
		var timestamp = '<?= time(); ?>';

		function updateTime() {
			$('#time').html(Date(timestamp));
			timestamp++;
		}
		$(function() {
			setInterval(updateTime, 1000);
		});
	</script>
	<script src="plugins/bootstrap/js/bootstrap.min.js"></script>
	<script src="plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
	<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
	<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

	<script>
		$(function() {
			$("#example1").DataTable({
				"responsive": true,
				"autoWidth": false,
			});
			$('#example2').DataTable({
				"paging": true,
				"lengthChange": false,
				"searching": false,
				"ordering": true,
				"info": true,
				"autoWidth": false,
				"responsive": true,
			});
		});
	</script>

	<!-- <script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script> -->

</body>

</html>

<?php
include('../body/script.php');
include('../body/footer.php');
?>