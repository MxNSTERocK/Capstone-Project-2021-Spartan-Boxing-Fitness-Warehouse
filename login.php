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
                                    <h1 class="h4 text-gray-900 mb-4"><?= Title ?></h1>
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

                                <form class="row g-1 needs-validation" novalidate action="code.php" method="POST">
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control" id="validationCustom01" placeholder="Enter your Email address" required>
                                        <div class="invalid-feedback">
                                             <small> Invalid Email address </small>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <input type="password" name="password" id="valid" class="form-control" id="validationCustom02" placeholder="Enter your password" pattern="^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$" minlength="8" required>
                                        <div class="invalid-feedback">
                                           <small> 8 minimun character </small>
                                        </div>
                                        <input type="checkbox" onclick="myFunction()"> &nbsp; Show Password

                                        <p>
                                            <center><a href="forgot/forgot.php">Forgot Password</a></center>
                                        </p>

                                        <button type="submit" name="login_btn" class="btn btn-primary btn-user btn-block">
                                            Login </button>
                                </form>

                                <p><a href="register.php">
                                        <center>Click here to register!</center>
                                    </a>
                                    <?php
                                    // echo '<pre>';
                                    // var_dump($_SESSION);
                                    // echo '</pre>';
                                    ?>
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

<script>
    function myFunction() {
        var x = document.getElementById("valid");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>





<?php include('body/script.php') ?>