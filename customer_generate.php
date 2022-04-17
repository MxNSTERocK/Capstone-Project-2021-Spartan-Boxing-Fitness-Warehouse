<?php
include('membership_security.php');

include('body_customer/cheader.php');
include('body_customer/cnavbar.php');

include('generate/libs/phpqrcode/qrlib.php');

function getUsernameFromEmail($email)
{
	$find = '@';
	$pos = strpos($email, $find);
	$username = substr($email, 0, $pos);
	return $username;
}

if (isset($_POST['submit'])) {
	$tempDir = 'generate/temp/';
	$name = $_POST['customer'];
	$email = $_POST['mail'];
	$subject =  $_POST['subject'];
	$filename = getUsernameFromEmail($email);
	$temp =  $_POST['msg'];
	$codeContents = '' . $name . ',' . $email . ',' . urlencode($subject) . ',' . urlencode($temp);

	QRcode::png($codeContents, $tempDir . '' . $filename . '.png', QR_ECLEVEL_L, 5);
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Quick Response (QR) Code Generator</title>
	<!-- <link href="css/googleapis.css" rel="stylesheet" />
	<link href="css/mdb.css" rel="stylesheet" /> -->
</head>

<body>
	<center>

		<div class="col-xl-6 col-md-6 mb-6">
			<div class="card border shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-primary text-uppercase mb-2">
								<h3><strong>Quick Response (QR) Code Generator</strong></h3>
							</div>
							<hr>
							<div class="h5 mb-0 font-weight-bold text-gray-800">
								<div class="container">
									<div class="qr-field">
										<center>
											<div class="container">
												<?php
												if (isset($_POST['submit'])) {
												?>
													<div class="qrframe" style="border:2px solid black; width:210px; height:210px;">
														<?php echo '<img src="generate/temp/' . @$filename . '.png" style="width:200px; height:200px;"><br>'; ?>
													</div>
													<a class="btn btn-success submitBtn" style="width:210px; margin:5px 0;" href="generate/download.php?file=<?php echo $filename; ?>.png ">Download QR Code</a>
											</div>
										<?php
												}
										?>
										</center>
									</div>
									<div class="input-field">
										<br>
										<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="needs-validation" novalidate>
											<div class="form-group">
												<label for="validationCustom01" class="form-label">Full name</label>
												<input type="text" class="form-control" class="form-control" id="validationCustom01" name="customer" style="width:20em;" placeholder="Enter your Name" value="<?php echo @$customer; ?>" required />
											</div>
											<div class="form-group">
												<label>Email</label>
												<input type="email" class="form-control" name="mail" style="width:20em;" placeholder="Enter your Email" value="<?php echo @$email; ?>" required />
											</div>
											<div class="form-group">
												<label>Address</label>
												<input type="text" class="form-control" name="subject" style="width:20em;" placeholder="Enter your Address" value="<?php echo @$subject; ?>" required />
											</div>
											<div class="form-group">
												<label>Contact</label>
												<input type="number" class="form-control" name="msg" style="width:20em;" value="<?php echo @$body; ?>" required pattern="[a-zA-Z0-9 .]+" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" placeholder="Enter your phone number">
											</div>
											<div class="form-group">
												<input type="submit" name="submit" class="btn btn-success submitBtn" style="width:20em; margin:0;" />
											</div>
										</form>

									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
	</center>
	&nbsp;

	<?php
	if (!isset($filename)) {
		$filename = "TechSu";
	}
	?>


</body>

</html>

<script>
	// Example starter JavaScript for disabling form submissions if there are invalid fields
	(function() {
		'use strict'

		// Fetch all the forms we want to apply custom Bootstrap validation styles to
		var forms = document.querySelectorAll('.needs-validation')

		// Loop over them and prevent submission
		Array.prototype.slice.call(forms)
			.forEach(function(form) {
				form.addEventListener('submit', function(event) {
					if (!form.checkValidity()) {
						event.preventDefault()
						event.stopPropagation()
					}

					form.classList.add('was-validated')
				}, false)
			})
	})()
</script>

<?php
include('body_customer/cscript.php');
include('body_customer/cfooter.php');
?>