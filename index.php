<?php
error_reporting(0);
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

	<link href="css/googleapis.css" rel="stylesheet" />
	<link href="css/mdb.css" rel="stylesheet" />	

	<!-- <link href="css/material-dashboard.css" rel="stylesheet"> -->

	<script type="text/javascript" src="covid19/js/instascan.min.js"></script>
	<script src="covid19/plugins/jquery/jquery.min.js"></script>

	<!-- DataTables -->
	<link rel="stylesheet" href="covid19/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="covid19/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

	<style>
		#divvideo {
			box-shadow: 0px 0px 1px 1px rgba(0, 0, 0, 0.1);
		}
	</style>
</head>

<body style="background:#eee">
	<div class="container">
		<div class="row">
		<h4 class="m-2 font-weight-bold text-primary">Contact tracing </h4>
			<br>
		
			<div class="col-md-2" style="display:none;padding:4px;background:#fff;border-radius: 5px;" id="divvideo">
				
					<p class="login-box-msg">
						<button type="submit" class="btn btn-success" onclick="Export()">
							<i class="glyphicon glyphicon-save">&nbsp;</i>Export to Excel </button>
					</p>
				<!--<video id="preview" width="100%" height="70%" style="border-radius:5px;"></video>-->
				<br>
				<br><br>
			
			</div>
			<div class="col-md-12">
				
				<form action="covid19/CheckInOut.php" method="POST" class="form-horizontal" style="border-radius: 5px;padding:10px;background:#fff;" id="divvideo">
					<i class="glyphicon glyphicon-qrcode"></i> <label><h2>SCAN QR CODE</h2></label>
					<p id="time"></p><br>
					<center>

					<video id="preview" width="40%" height="30%";></video></center>
					<?php
				if (isset($_SESSION['error'])) {
					echo "
						<div class='alert alert-danger alert-dismissible' style='background:#389ced;color:#fff'>
						  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
						  <h5><i class='icon fa fa-warning'></i>
						  " . $_SESSION['error'] . "</h5>
						</div>
					  ";
					unset($_SESSION['error']);
				}
				if (isset($_SESSION['success'])) {
					echo "
						<div class='alert alert-success alert-dismissible' style='background:green;color:#fff'>
						  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
						  <h6><i class='icon fa fa-check'></i> 
						  " . $_SESSION['success'] . "</h6>
						</div>
					  ";
					unset($_SESSION['success']);
				}
				?>
					<input type="hidden" name="text" id="text" value="<?php echo @$customer; ?>  "placeholder="scan qrcode" class="form-control">
				</form>

				<div style="border-radius: 5px;padding:10px;background:#fff;" id="divvideo">
					<table id="example1" class="table table-bordered">
						<thead>
							<tr style="background-color: #faf1f0;">
								<td>NAME</td>
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
							$date = date('Y-m-d');
							if ($connection->connect_error) {
								die("Connection failed" . $connection->connect_error);
							}
							$sql = "SELECT * FROM tbl_covid19 WHERE DATE(LOGDATE)=CURDATE()";
							$query = $connection->query($sql);
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
										<form action="contact_view.php" method="POST">
											<input type="hidden" name="id" value="<?php echo $row['ID']; ?>">
											<button type="submit" name="contact_view" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></button>
										</form>
										<form action="contact_edit.php" method="POST">
											<input type="hidden" name="id" value="<?php echo $row['ID']; ?>">
											<button type="submit" name="contact_update" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></i></button>
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
				window.open("covid19/export.php", '_blank');
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
			a=document.getElementById('text').value = c;
			window.location.href = "<?= BaseURL?>/covid19/CheckInOut.php?covid="+btoa(a);
			//
			/*var r = confirm("Are you sure you want to continue?");
			if (r == true) {
				window.location.href = "index.php?covid="+btoa(a);
			} else {
  			}*/
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
	<script src="covid19/plugins/bootstrap/js/bootstrap.min.js"></script>
	<script src="covid19/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="covid19/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
	<script src="covid19/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
	<script src="covid19/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

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
	
</body>

</html>

	<script src="material/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="material/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/material-dashboard.js"></script>
    <script src="js/sweetalert.js"></script>

    <?php
    include('body/sweet.php');
    include('body/footer.php');
    ?>