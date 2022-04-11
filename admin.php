<?php
include('security.php');

include('body/header.php');
include('body/navbar.php');
?>

<link href="css/googleapis.css" rel="stylesheet" />
<link href="css/mdb.css" rel="stylesheet" />

<link rel="stylesheet" href="css/datatable.css">

<script src="material/jquery/jquery.min.js"></script>
<script src="material/datatables/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>

<style>
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

<!-- Page Heading -->
<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #faf1f0;">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="code.php" method="POST" enctype="multipart/form-data">

                <div class="modal-body">
                <div class="row">
                <div class="col-md-6">
                        <label> Username </label>
                        <input type="text" name="username" class="form-control" placeholder="Enter Username" required>
                    </div>
                    <div class="col-md-6">
                        <label> Firstname </label>
                        <input type="text" name="firstname" class="form-control" placeholder="Enter Username" required>
                    </div>
                    <div class="col-md-6">
                        <label> Lastname </label>
                        <input type="text" name="lastname" class="form-control" placeholder="Enter Username" required>
                    </div>
                    <div class="col-md-6">
                        <label> Contact number </label>
                        <input type="text" name="contact" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" placeholder="Enter Username" required>
                    </div>
                    <div class="col-md-6">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control checking_email" placeholder="Enter Email" required>
                        <small class="error_email" style="color: red;"></small>
                    </div>
                    <div class="col-md-6">
                    <label>Level</label>
                    <select class="form-select form-select-lg mb-3" name="level" class="form-control" aria-label=".form-select-lg example">
                        <option selected>Select level of user</option>
                        <option value="admin">Admin</option>
                        <!-- <option value="trainer">Trainer</option> -->
                        <option value="customer">Customer</option>
                    </select>
                    </div>
                    <label>Image</label>
                    <input type="file" name="image" class="form-control" required>

                    <div class="col-md-6">
                        <label>Password</label>
                        <input type="password" id="psw" name="password" class="form-control" placeholder="Enter Password" pattern="^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$" required>
                    </div>

                    <!-- check in modal -->
                    <div id="message">
                        <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                        <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
                        <p id="number" class="invalid">A <b>number</b></p>
                        <p id="length" class="invalid">Minimum <b>8 characters</b></p>
                    </div>

                    <div class="col-md-6">
                        <label>Confirm Password</label>
                        <input type="password" name="confirmpassword" class="form-control" placeholder="Confirm Password" required>
                    </div>

                    <input type="hidden" name="status" value="Active">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" name="registerbtn" value="Submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3" style="background-color: #FEF6FF;">
            <h4 class="m-2 font-weight-bold text-primary">Administrator</h4>
            <h6 class="m-0 font-weight-bold text-success">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addadminprofile" data-toggle="tooltip" data-placement="top" title="Adding Administrator">
                    <i class="fa fa-user-plus"></i>
                </button>
                <a href="archive.php" class="btn btn-success float-right"><i class="fas fa-file-archive float-right" data-toggle="tooltip" data-placement="top" title="View Archived record">&nbsp; Archive</i></a>
                </button>
            </h6>
        </div>

        <?php
        $query = "SELECT * FROM tbl_admin WHERE status = 1 ";
        $query_run = mysqli_query($connection, $query);
        ?>
        <div class="card-body">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr style="background-color: #faf1f0;">
                        <th>Profile</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Level</th>
                        <th>status</th>
                        <th>Action</th>
                        <!-- <th>Delete</th> -->
                    </tr>
                </thead>
                <tbody>


                    <?php
                    if (mysqli_num_rows($query_run) > 0) {
                        while ($row = mysqli_fetch_assoc($query_run)) { ?>
                            <tr>
                                <td> <img src="img/customer_image/<?php echo $row['image'] ?>" height="50" width="50" /></td>
                                <td><?php echo $row['username']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['level']; ?></td>

                                <td>
                                    <center><?php
                                            if ($row['status'] == 1) {
                                                echo '<p><a href="status.php?ID=' . $row['ID'] . '"><i class="fa fa-archive fa-lg" aria-hidden="true"style="color:#0275d8 " data-toggle="tooltip" data-placement="top" title="Click to Archive"></i></a></p>';
                                            }
                                            // else {
                                            //     echo '<p><a href="status.php?ID=' . $row['ID'] . '&status=1"><i class="fa fa-circle fa-2xl"></i></a></p>';
                                            // }
                                            ?></center>
                                </td>
                                <td>
                                    <form action="admin_edit.php" method="POST">
                                        <input type="hidden" name="edit_id" value="<?php echo $row['ID']; ?>">
                                        <button type="submit" name="edit_btn" class="btn btn-success btn-sm"><i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="Update"></i></button>
                                    </form>
                                </td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo "No Record Found";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>


    <!-- User Table -->

    <div class="modal fade" id="addmember" tabindex="-1" role="dialog" aria-labelledby="addmember" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addmember">Add Member Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="code.php" method="POST">

                    <div class="modal-body">

                        <div class="form-group">
                            <label> Username </label>
                            <input type="text" name="username" class="form-control" placeholder="Enter Username" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control checking_email" placeholder="Enter Email" required>
                            <small class="error_email" style="color: red;"></small>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Enter Password" minlength="8" required>
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" name="confirmpassword" class="form-control" placeholder="Confirm Password" required>
                        </div>

                        <input type="hidden" name="status" value="Active">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" name="registerbtn" class="btn btn-success">Save</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- FOR TRAINER -->

    <!-- <div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3" style="background-color: #FEF6FF;">
            <h4 class="m-2 font-weight-bold text-primary">Trainer</h4>
            <h6 class="m-0 font-weight-bold text-success">
            </h6>
        </div>

        <?php
        //$query = "SELECT * FROM tbl_admin WHERE level = 'trainer' ";
        //$query_run = mysqli_query($connection, $query);
        ?>

        <table class="table-hover" id="dataTable2" style="width:100%">
            <thead>
                <tr style="background-color: #faf1f0;">
                    <th>Profile</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Level</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                //if (mysqli_num_rows($query_run) > 0) {
                //    while ($row = mysqli_fetch_assoc($query_run)) { 
                ?>
                        <tr>
                            <td> <img src="img/customer_image/<?php // echo $row['image'] 
                                                                ?>" height="50" width="50" /></td>
                            <td><?php // echo $row['username']; 
                                ?></td>
                            <td><?php // echo $row['email']; 
                                ?></td>
                            <td><?php // echo $row['level']; 
                                ?></td>
                            <td><?php
                                //if ($row['status'] == 1) {
                                //    echo '<p><i class="fa fa-circle text-success"></i><a href="status.php?ID=' . $row['ID'] . '&status=0">Enable</a></p>';
                                //} else {
                                //    echo '<p><i class="fa fa-circle text-danger"></i><a href="status.php?ID=' . $row['ID'] . '&status=1">Disable</a></p>';
                                //}
                                ?></td>
                            <td>
                                <form action="admin_edit.php" method="POST">
                                    <input type="hidden" name="edit_id" value="<?php // echo $row['ID']; 
                                                                                ?>">
                                    <button type="submit" name="edit_btn" class="btn btn-success btn-sm"><i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="Update"></i></button>
                                </form>
                            </td>
                        </tr>
                <?php
                //   }
                // } else {
                //    echo "No Record Found";
                //}
                ?>
            </tbody>
        </table>
    </div>
</div> -->
</div>
</div>

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

<script src="material/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="material/jquery-easing/jquery.easing.min.js"></script>
<script src="js/material-dashboard.js"></script>

<?php
include('body/footer.php');
?>