<link rel="stylesheet" href="../css/material-dashboard.css">
<link rel="stylesheet" href="../css/design.css">

<link href="../css/forgot.css" rel="stylesheet">
<link href="../css/googleapis.css" rel="stylesheet" />
<link href="../css/mdb.css" rel="stylesheet" />

<?php
session_start();
$error = array();


require "mail.php";

if (!$con = mysqli_connect("localhost", "root", "", "gym")) {

	die("could not connect");
}

$mode = "enter_email";
if (isset($_GET['mode'])) {
	$mode = $_GET['mode'];
}

//something is posted
if (count($_POST) > 0) {

	switch ($mode) {
		case 'enter_email':
			// code...
			$email = $_POST['email'];
			//validate email
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$error[] = "Please enter a valid email";
			} elseif (!valid_email($email)) {
				$error[] = "That email was not found";
			} else {

				$_SESSION['forgot']['email'] = $email;
				send_email($email);
				header("Location: forgot.php?mode=enter_code");
				die;
			}
			break;

		case 'enter_code':
			// code...
			$code = mysqli_real_escape_string($con, $_POST['code']);
			$result = is_code_correct($code);

			if ($result == "the code is correct") {

				$_SESSION['forgot']['code'] = $code;
				header("Location: forgot.php?mode=enter_password");
				die;
			} else {
				$error[] = $result;
			}
			break;

		case 'enter_password':
			// code...
			$password = $_POST['password'];
			$password2 = $_POST['password2'];

			if ($password !== $password2) {
				$error[] = "Passwords do not match";
			} elseif (!isset($_SESSION['forgot']['email']) || !isset($_SESSION['forgot']['code'])) {
				header("Location: forgot.php");
				die;
			} else {

				save_password($password);
				if (isset($_SESSION['forgot'])) {
					unset($_SESSION['forgot']);
				}

				$_SESSION['hooray'] = "Your Password has been successfully changed";
				header("Location: ../login.php");
				die;
			}
			break;

		default:
			// code...
			break;
	}
}

function send_email($email)
{

	global $con;

	$expire = time() + (60 * 1);
	$code = rand(10000, 99999);
	$email = addslashes($email);

	$query = "INSERT INTO tbl_codes (email,code,expire) value ('$email','$code','$expire')";
	mysqli_query($con, $query);

	//send email here
	send_mail($email, 'You Requested to reset your password in SPARTAN BOXING AND FITNESS WAREHOUSE', "Your code is " . $code);
}

function save_password($password)
{

	global $con;

	$password = password_hash($password, PASSWORD_DEFAULT);

	$password = $_POST['password'];

	$hashed = md5($password);
	$email = addslashes($_SESSION['forgot']['email']);

	$query = "UPDATE tbl_admin SET password = '$hashed' where email = '$email' limit 1";
	mysqli_query($con, $query);
}

function valid_email($email)
{
	global $con;

	$email = addslashes($email);

	$query = "SELECT * from tbl_admin where email = '$email' limit 1";
	$result = mysqli_query($con, $query);
	if ($result) {
		if (mysqli_num_rows($result) > 0) {
			return true;
		}
	}

	return false;
}

function is_code_correct($code)
{
	global $con;

	$code = addslashes($code);
	$expire = time();
	$email = addslashes($_SESSION['forgot']['email']);

	$query = "SELECT * from tbl_codes where code = '$code' && email = '$email' order by id desc limit 1";
	$result = mysqli_query($con, $query);
	if ($result) {
		if (mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_assoc($result);
			if ($row['expire'] > $expire) {

				return "the code is correct";
			} else {
				return "the code is expired";
			}
		} else {
			return "the code is incorrect";
		}
	}

	return "the code is incorrect";
}


?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Forgot</title>
</head>

<style>
	body {
		position: relative;
		background: url('../img/bb-spartan-boxing.jpg') no-repeat center center fixed;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		width: 100%;
		height: 100%;
		margin: 0
	}

	body:after {
		position: fixed;
		content: "";
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		background: rgba(0, 0, 255, 0.5);
		z-index: -1;
	}

	    /* Style all input fields */
    input {
        /* width: 100%; */
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        margin-top: 6px;
        margin-bottom: 16px;
    }

    /* Style the submit button */
    input[type=submit] {
        background-color: #04AA6D;
        color: white;
    }

    /* The message box is shown when the user clicks on the password field */
    #message {
        display: none;
        background: #f1f1f1;
        color: #000;
        position: relative;
        padding: 10px;
        margin-top: 5px;
    }

    #message p {
        padding: 5px 15px;
        font-size: 10px;
    }

    /* Add a green text color and a checkmark when the requirements are right */
    .valid {
        color: green;
    }

    .valid:before {
        position: relative;
        left: -15px;
        content: "✓";
    }

    /* Add a red text color and an "x" when the requirements are wrong */
    .invalid {
        color: red;
    }

    .invalid:before {
        position: relative;
        left: -15px;
        content: "x";
    }
</style>

<body>

	<?php

	switch ($mode) {
		case 'enter_email':
			// code...
	?>
			<center>
				<br>
				<br>
				<div class="container">
					<!-- Outer Row -->
					<div class="row justify-content-center">
						<div class="col-xl-6 col-lg-6 col-md-6">
							<div class="card o-hidden border-1 shadow-lg my-5">
								<div class="row bg-light">

									<form method="post" action="forgot.php?mode=enter_email">
										<h3>Enter your Email</h3>
										<span style="font-size: 12px;color:blue;">
											<div class='alert alert-danger' style='background:#389ced;color:#fff'>
												<h5>
													<?php
													foreach ($error as $err) {
														echo $err . "<br>";
													}
													?></i></h5>
											</div>
										</span>
										<div class="container">
											<input class="form-control form-control-user" type="email" name="email" placeholder="Enter Valid Email"><br>
										</div>
										<br style="clear: both;">
										<div class="container">
											<input type="submit" value="Next" class="form-control form-control-user btn-user btn-block" style="background-color:gray">
										</div>
										<br><br>
									</form>

								</div>
							</div>
						</div>
					</div>
				</div>
			<?php
			break;

		case 'enter_code':
			// code...
			?>
				<center>
					<br>
					<br>
					<div class="container">
						<!-- Outer Row -->
						<div class="row justify-content-center">
							<div class="col-xl-6 col-lg-6 col-md-6">
								<div class="card o-hidden border-1 shadow-lg my-5">
									<div class="row bg-light">

										<form method="post" action="forgot.php?mode=enter_code">
											<h3>Enter your code sent to your email</h3>
											<hr>
											<br>
											<span style="font-size: 12px;color:blue;">
												<div class='alert alert-danger' style='background:#389ced;color:#fff'>
													<h5>
														<?php
														foreach ($error as $err) {
															echo $err . "<br>";
														}
														?></i></h5>
												</div>
											</span>

											<div class="container">
												<input class="form-control form-control-user" type="text" name="code" placeholder="Enter your code"><br>
											</div>
											<br style="clear: both;">

											<div class="container">
												<input type="submit" value="Next" class="form-control form-control-user" style="background-color:gray">
											</div>
											<a href="../login.php">
												<!-- <input type="button" value="Start Over"> -->
											</a>
											<br><br>
											<!-- <div><a href="../login_member.php">Login</a></div> -->
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</center>
			<?php
			break;

		case 'enter_password':
			// code...
			?>
				<center>
					<br>
					<br>

					<div class="container">
						<!-- Outer Row -->
						<div class="row justify-content-center">
							<div class="col-xl-6 col-lg-6 col-md-6">
								<div class="card o-hidden border-1 shadow-lg my-5">
									<div class="row bg-light">
										<form method="post" action="forgot.php?mode=enter_password">
											<h3>Enter your new password</h3>
											<span style="font-size: 12px;color:blue;">
												<div class='alert alert-danger' style='background:#389ced;color:#fff'>
													<h5>
														<?php
														foreach ($error as $err) {
															echo $err . "<br>";
														}
														?></i></h5>
												</div>
											</span>
											<div class="container">
												<input class="form-control form-control-user" type="password" id="psw" name="password" placeholder="Password" pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$" required><br>
												<!-- check in modal -->
												<div id="message">
													<h6>No space allowed</h6>
													<p id="letter" class="invalid">A <b>lowercase</b> letter</p>
													<p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
													<p id="number" class="invalid">A <b>number</b></p>
													<p id="length" class="invalid">Minimum <b>8 characters</b></p>
												</div>

												<input class="form-control form-control-user" type="password" name="password2" placeholder="Retype Password" required><br>
											</div>
											<br style="clear: both;">
											<div class="container">
												<input type="submit" value="Next" class="form-control form-control-user" style="background-color:gray">
											</div>
											<br><br>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</center>

		<?php
			break;

		default:
			// code...
			break;
	}

		?>


</body>

</html>

<script>
        var myInput = document.getElementById("psw");
        var letter = document.getElementById("letter");
        var capital = document.getElementById("capital");
        var number = document.getElementById("number");
        var length = document.getElementById("length");

        // When the user clicks on the password field, show the message box
        myInput.onfocus = function() {
            document.getElementById("message").style.display = "block";
        }

        // When the user clicks outside of the password field, hide the message box
        myInput.onblur = function() {
            document.getElementById("message").style.display = "none";
        }

        // When the user starts to type something inside the password field
        myInput.onkeyup = function() {
            // Validate lowercase letters
            var lowerCaseLetters = /[a-z]/g;
            if (myInput.value.match(lowerCaseLetters)) {
                letter.classList.remove("invalid");
                letter.classList.add("valid");
            } else {
                letter.classList.remove("valid");
                letter.classList.add("invalid");
            }

            // Validate capital letters
            var upperCaseLetters = /[A-Z]/g;
            if (myInput.value.match(upperCaseLetters)) {
                capital.classList.remove("invalid");
                capital.classList.add("valid");
            } else {
                capital.classList.remove("valid");
                capital.classList.add("invalid");
            }

            // Validate numbers
            var numbers = /[0-9]/g;
            if (myInput.value.match(numbers)) {
                number.classList.remove("invalid");
                number.classList.add("valid");
            } else {
                number.classList.remove("valid");
                number.classList.add("invalid");
            }

            // Validate length
            if (myInput.value.length >= 8) {
                length.classList.remove("invalid");
                length.classList.add("valid");
            } else {
                length.classList.remove("valid");
                length.classList.add("invalid");
            }
        }
    </script>


<?php
// include('../body/script.php');
?>