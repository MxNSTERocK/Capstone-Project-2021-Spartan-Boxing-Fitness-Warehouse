<?php
include('membership_security.php'); 

include('body_customer/cheader.php');
include('body_customer/cnavbar.php');
?>

<!-- <link href="css/googleapis.css" rel="stylesheet" />
<link href="css/mdb.css" rel="stylesheet" /> -->

<style>
    fieldset {
        background-color: #eeeeee;
        box-sizing: border-box;
        padding: 1px 5px 10px;
    }

    legend {
        background-color: #5bc0de;
        color: white;
        padding: 1px 5px 10px 20px 40px 80px 100px;
    }

    input {
        margin: 0px;
    }
</style>

<center>
    <div class="col-xl-6 col-md-6 mb-6">
        <div class="card border shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="col-xl-12 col-md-12 mb-12">
                            <form action="membership_access.php" method="POST" enctype="multipart/form-data">
                                <fieldset>
                                    <legend>Membership Registration</legend>
                                <div class="form-group">
                                    <label> Firstname </label>
                                    <input type="text" name="firstname" class="form-control" placeholder="Enter your firstname" onkeyup="this.value = this.value.toUpperCase();" required>
                                </div>
                                <div class="form-group">
                                    <label>Lastname</label>
                                    <input type="text" name="lastname" class="form-control checking_email" placeholder="Enter your lastname" required>
                                </div>
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" name="address" class="form-control" placeholder="Enter your address" required>
                                </div>
                                <div class="form-group">
                                    <label>Contact</label>
                                    <input type="number" name="contact" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" placeholder="Enter Contact number" required>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" value="<?php echo $_SESSION['firstname']; ?>" placeholder="Enter your valid Email address">
                                    <small class="error_email" style="color: red;"></small>
                                </div>
                                <div class="form-group">
                                    <label>Membership join</label>
                                    <input type="date" name="membership_start" class="form-control" required>
                                </div>
                                <!-- <div class="form-group">
                                    <label>Membership Expire</label>
                                    <input type="date" name="membership_end" class="form-control" required>
                                </div> -->
                                <div class="row">
                                    <div class="col-md-6 col-xs-6">
                                        <label>Membership Type:</label>
                                        <label class="container">Annual
                                            <input type="radio" name="type" value="Annual" />
                                        </label>
                                        <label class="container">Senior/Student
                                            <input type="radio" name="type" value="Senior/Student" />
                                        </label>
                                    </div>
                                    <div class="col-md-6 col-xs-6">
                                        <label>Import Picture</label>
                                        <input type="file" name="proof" class="form-control-file" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Note/Comment</label>
                                    <textarea type="text" name="note" class="form-control" cols="2" rows="2" required></textarea>
                                </div>

                                <button type="submit" name="register" class="btn btn-info">Save</button>
                                </fieldset>
                            </form>
                        </div>
                </div>
            </div>
        </div>
        &nbsp;
</center>

<script>
    function myFunction() {
        // Get the checkbox
        var checkBox = document.getElementById("myCheck");
        // Get the output text
        var text = document.getElementById("text");

        // If the checkbox is checked, display the output text
        if (checkBox.checked == true) {
            text.style.display = "block";
        } else {
            text.style.display = "none";
        }
    }
</script>

<?php
include('body_customer/cscript.php');
include('body_customer/cfooter.php');
?>