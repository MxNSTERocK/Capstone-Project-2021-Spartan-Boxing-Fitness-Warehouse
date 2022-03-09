<?php
session_start();
include('body/header.php');
?>

<link href="css/googleapis.css" rel="stylesheet" />
<link href="css/mdb.css" rel="stylesheet" />

<div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-6 col-md-6">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row bg-light">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Customer Login</h1>

                                    <?php
                                    if (isset($_SESSION['status'])) {
                                        echo "
						<div class='alert alert-danger alert-dismissible' style='background:#389ced;color:#fff'>
						  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
						  <h5><i class='icon fa fa-warning'></i>
						  " . $_SESSION['status'] . "</h5>
						</div>
					  ";
                                        unset($_SESSION['status']);
                                    }
                                    ?>
                                </div>

                                <style>
                                    body {
                                        position: relative;
                                        background: url('img/bb-1.jpg') no-repeat center center fixed;
                                        -webkit-background-size: cover;
                                        -moz-background-size: cover;
                                        -o-background-size: cover;
                                        background-size: cover;
                                        width: 100%;
                                        height: 100%;
                                        margin: 0;
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

                                    .validity {
                                        background-color: #ffffff;
                                        border: solid -1rem #ADADAD;
                                        height: 17px;
                                        display: flex;
                                        justify-content: center
                                    }

                                    .form-control {
                                        position: relative;
                                        top: -1px;
                                        padding: 0;
                                    }

                                    input:invalid+span:after {
                                        content: 'INVALID';
                                        color: red;
                                    }

                                    input:valid+span:after {

                                        content: 'VALID';
                                        color: green;
                                    }

                                    input {
                                        position: relative;
                                        top: -1px;
                                        padding: 0;
                                    }

                                    .valid,
                                    .valid {
                                        vertical-align: middle;
                                    }
                                </style>

                                <form class="user" action="membership_access.php" method="POST">

                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control form-control-user" placeholder="Enter your Email address" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" id="valid" class="form-control form-control-user" pattern="^\S+$" minlength="5" placeholder="Enter your Password" required>
                                        <span id="valid" class="validity"></span>
                                    </div>

                                    <p>
                                        <a href="forgot/forgot.php">
                                            <center>Forgot Password</center>
                                        </a>
                                    </p>
                                    <hr>
                                    <!-- Button -->
                                    <button type="submit" name="login_member" class="btn btn-primary btn-user btn-block">
                                        Login </button>
                                </form>
                                <p>
                                    <a href="register.php">
                                        <center>Click here to register!</center>
                                    </a>
                                    <a href="login.php">
                                        <center>Click here to login Administrator!</center>
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

<?php
include('body/script.php');
?>