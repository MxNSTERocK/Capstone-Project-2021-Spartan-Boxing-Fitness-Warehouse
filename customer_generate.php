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
	$codeContents = ''.$name.',' . $email . ',' . urlencode($subject) . ',' . urlencode($temp);
	
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
	<div class="container">
	<div class="qr-field">
			<center>
			<div class="container">
			<?php 
			if (isset($_POST['submit'])) 
			{
			?>
			<div class="qrframe" style="border:2px solid black; width:210px; height:210px;">
				<?php echo '<img src="generate/temp/'. @$filename . '.png" style="width:200px; height:200px;"><br>'; ?>
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
	<center>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
		<div class="form-group">
				<label>Name</label>
				<input type="text" class="form-control" name="customer" style="width:20em;" placeholder="Enter your Name" value="<?php echo @$customer; ?>" required />
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
				<input type="float" class="form-control" name="msg" style="width:20em;" value="<?php echo @$body; ?>" required pattern="[a-zA-Z0-9 .]+" placeholder="Enter your phone number">
			</div>
			<div class="form-group">
				<input type="submit" name="submit" class="btn btn-success submitBtn" style="width:20em; margin:0;" />
			</div>
		</form>	
	</center>
	</div>
	</div>
		</div>
	<?php
	if (!isset($filename)) {
		$filename = "TechSu";
	}
	?>


</body>

</html>

<?php
include('body_customer/cscript.php');
include('body_customer/cfooter.php');
?>