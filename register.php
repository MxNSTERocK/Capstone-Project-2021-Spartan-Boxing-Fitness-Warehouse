<?php
session_start();
include('body/header.php');
?>

<!DOCTYPE html>
<html>

<head>
    <title> Registration </title>
    <link href="css/googleapis.css" rel="stylesheet" />
    <link href="css/mdb.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/material-dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>


</head>

<style>
    /* Background */
    body {
        position: relative;
        background: url('img/bb-spartan-boxing.jpg') no-repeat center center fixed;
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
        background: 0;
        z-index: -1;
    }

    /* Style all input fields */
    input {
        width: 100%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
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
        font-size: 12px;
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
    <center>
        <div class="header">
            <script src="./js/alertify.js"></script>

            <script>
                <?php if (isset($_SESSION['status'])) { ?>
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.success("<?= $_SESSION['status'] ?>");
                <?php
                    unset($_SESSION['status']);
                }
                ?>
                <?php if (isset($_SESSION['message'])) { ?>
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.error("<?= $_SESSION['message'] ?>");
                <?php
                    unset($_SESSION['message']);
                }
                ?>
            </script>

        </div>
        &nbsp;
        <div class="col-xl-6 col-md-6 mb-6">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-lg font-weight-bold text-primary text-uppercase mb-1">
                                Registration</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <hr>
                                <div class="container">
                                    <form action="membership_access.php" method="POST" class="row g-3 needs-validation" enctype="multipart/form-data" novalidate>
                                    <div class="col-md-4">
                                            <label for="validationCustom01" class="form-label">User name</label>
                                            <input type="text" name="username" class="form-control" id="validationCustom01" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="validationCustom02" class="form-label">Firstname</label>
                                            <input type="text" name="firstname" class="form-control" id="validationCustom02" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="validationCustom03" class="form-label">Lastname</label>
                                            <input type="text" name="lastname" class="form-control" id="validationCustom03" required>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="validationCustom04" class="form-label" id="exampleInputEmail1" aria-describedby="emailHelp">Email address</label>
                                            <input type="email" name="email" class="form-control" id="validationCustom04" required>
                                            <div id="emailHelp" class="form-text"><h6 style="color: red;">We'll never share your email with anyone else.</h6></div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="validationCustom05" class="form-label">Contact</label>
                                            <input type="number" name="contact" class="form-control" id="validationCustom05" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="validationCustom06" class="form-label">Enter Password</label>
                                            <input type="password" name="password" class="form-control" id="psw" minlength="8" pattern="^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$" required>
                                        </div>

                                        <div id="message">
                                            <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                                            <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
                                            <p id="number" class="invalid">A <b>number</b></p>
                                            <p id="length" class="invalid">Minimum <b>8 characters</b></p>
                                        </div>

                                        <div class="col-md-6">
                                            <label>Image</label>
                                            <input type="file" name="image" class="form-control" aria-label="file example" required>
                                            <!-- <div class="invalid-feedback">Choose profile picture</div> -->
                                        </div>

                                        <div class="col-md-6">
                                            <label for="validationCustom07" class="form-label">Confirm password</label>
                                            <input type="password" name="confirm" class="form-control" id="validationCustom07" required>
                                        </div>

                                        <div class="col-md-12">
                                            <button type="submit" class="form-control form-control-user btn-user btn-block btn btn-primary" name="reg_user"> Register </button>
                                        </div>
                                        <hr>
                                        <br>
                                        <p>
                                            Already having an account?
                                            <a href="login.php"> Login Here! </a>
                                        </p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </center>
    &nbsp;
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

<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()
</script>

<script src="js/sweetalert.js"></script>