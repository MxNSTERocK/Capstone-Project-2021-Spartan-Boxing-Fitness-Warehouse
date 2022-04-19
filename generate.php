<?php
include('security.php');

include('body/header.php');
include('body/navbar.php');

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
	<link href="css/googleapis.css" rel="stylesheet" />
	<link href="css/mdb.css" rel="stylesheet" />
</head>

<body>
	<center>
		<div class="col-xl-6 col-md-6 mb-6">

			<div class="card border shadow h-100 py-0">
				<div class="modal-header bg-dark">
					<h5 class="modal-title" id="exampleModalLabel" style="color: white;">
					<strong>Quick Response (QR) Code Generator</strong>
					</h5>
				</div>
				<br>

				<div class="h5 mb-0 font-weight-bold text-gray-800">
					<div class="container">
						<div class="qr-field">
							<div class="container">
								<?php
								if (isset($_POST['submit'])) {
								?>
									<div class="qrframe" style="border:2px solid black; width:210px; height:210px;">
										<?php echo '<img src="generate/temp/' . @$filename . '.png" style="width:200px; height:200px;"><br>'; ?>
									</div>
									<a class="btn btn-success submitBtn" style="width:210px; margin:5px 0;" href="generate/download.php?file=<?php echo $filename; ?>.png "><i class="fas fa-download">&nbsp;</i>Download QR Code</a>
							</div>
						<?php
								}
						?>
						</div>
						<div class="input-field">

							<br>
							<!-- <h3>Please Fill-out All Fields</h3> -->
							<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="needs-validation" novalidate>
								<div class="form-group">
									<label for="validationCustom01" class="form-label">Full name</label>
									<input type="text" class="form-control" id="validationCustom01" name="customer" style="width:20em;" placeholder="Enter your Name" value="<?php echo @$customer; ?>" required />
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
									<input type="number" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" name="msg" style="width:20em;" value="<?php echo @$body; ?>" placeholder="Enter your phone number" required title="Number Only">
								</div>

								<div class="form-group">
									<input type="submit" name="submit" class="btn btn-success submitBtn" style="width:20em; margin:0;" />
								</div>
							</form>
						</div>
						<?php
						if (!isset($filename)) {
							$filename = "TechSu";
						}
						?>

					</div>
				</div>

			</div>
		</div>
	</center>
	&nbsp;
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
include('body/script.php');
include('body/footer.php');
?>