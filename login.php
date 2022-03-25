<?php
session_start();
include('body/header.php');
?>

<link rel="stylesheet" href="css/background.css">
<link href="css/googleapis.css" rel="stylesheet" />
<link href="css/mdb.css" rel="stylesheet" />

<div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-6 col-md-6">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Administrator Login</h1>
                                    <?php
                                    if (isset($_SESSION['error'])) {
                                        echo "
						<div class='alert alert-danger alert-danger' style='background:red;color:#fff'>
						  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
						  <h5><i class='icon fa fa-warning'></i>
						  " . $_SESSION['error'] . "</h5>
						</div>
					  ";
                                        unset($_SESSION['error']);
                                    }
                                    if (isset($_SESSION['hooray'])) {
                                        echo "
						<div class='alert alert-danger alert-success' style='background: #198754;color:#fff'>
						  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
						  <h5><i class='icon fa fa-warning'></i>
						  " . $_SESSION['hooray'] . "</h5>
						</div>
					  ";
                                        unset($_SESSION['hooray']);
                                    }
                                    ?>

                                </div>

                                <script>
                                    $('.alert').alert()
                                </script>

                                <form class="user" action="code.php" method="POST">
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control form-control-user" placeholder="Enter your Email address" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" id="valid" class="form-control form-control-user" placeholder="Enter your password" pattern="^\S+$" minlength="8" autofocus required>
                                        <span id="valid" class="validity"></span>
                                    </div>

                                    <a href="forgot/forgot.php">
                                        <center>Forgot Password</center>
                                    </a>

                                    <button type="submit" name="login_btn" class="btn btn-primary btn-user btn-block">
                                        Login </button>
                                </form>
                                <p>
                                    <a href="register.php">
                                        <center>Click here to register!</center>
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('body/script.php') ?>