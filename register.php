<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title> Registration </title>
    <link href="css/googleapis.css" rel="stylesheet" />
<link href="css/mdb.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/material-dashboard.css">
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
                                    <form action="membership_access.php" method="POST" enctype="multipart/form-data">
                                        <div class="input-group">
                                            <label>Enter Username</label>
                                            <input type="text" name="username" required>
                                        </div>
                                        <div class="input-group">
                                            <label>Firstname</label>
                                            <input type="text" name="firstname" required>
                                        </div>
                                        <div class="input-group">
                                            <label>Lastname</label>
                                            <input type="text" name="lastname" required>
                                        </div>
                                        <div class="input-group">
                                            <label>Email</label>
                                            <input type="email" name="email" required>
                                        </div>
                                        <div class="input-group">
                                            <label>Contact</label>
                                            <input type="number" name="contact" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" required>
                                        </div>
                                        <input type="hidden" name="role" value="Member">

                                        <div class="input-group">
                                            <label>Enter Password</label>
                                            <input type="password" name="password" id="psw" minlength="8" pattern="^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$" required>
                                        </div>

                                        <div id="message">
                                            <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                                            <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
                                            <p id="number" class="invalid">A <b>number</b></p>
                                            <p id="length" class="invalid">Minimum <b>8 characters</b></p>
                                        </div>

                                        <div class="input-group">
                                            <label>Confirm password</label>
                                            <input type="password" name="confirm" required>
                                        </div>

                                        <div class="input-group">
                                            <label>Image</label>
                                            <input type="file" name="image" required>
                                        </div>
                                        <div class="input-group">
                                            <button type="submit" class="btn btn-primary btn-user btn-block" name="reg_user"> Register </button>
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
                        <div class="col-auto">
                            <i class="far fa-user fa-2x text-gray-1000"></i>
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

<script src="js/sweetalert.js"></script>