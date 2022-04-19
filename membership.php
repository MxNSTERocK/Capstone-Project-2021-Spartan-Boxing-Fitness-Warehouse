<?php
include('security.php');
include('body/header.php');
include('body/navbar.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="css/googleapis.css" rel="stylesheet" />
    <link href="css/mdb.css" rel="stylesheet" />

    <link rel="stylesheet" href="css/datatable.css">

    <script src="material/jquery/jquery.min.js"></script>
    <script src="material/datatables/jquery.dataTables.min.js"></script>

    <title>Membership</title>
</head>
<style>
    .container {
        color: black;
    }
</style>

<body>
    <div class="modal fade" id="addmember" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title" id="exampleModalLabel" style="color: white;"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="panel-heading">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1 text-center">
                        <legend style="color: black;">Membership form</legend>
                        <hr>
                    </div>
                </div>
                <div class="modal-body">
                    <form action="code.php" method="POST" enctype="multipart/form-data" class="row needs-validation" novalidate>
                        <div class="col-md-6">
                            <label for="validationCustom01" class="form-label"> Firstname </label>
                            <input type="text" name="firstname" class="form-control" id="validationCustom01" placeholder="Enter your firstname" required>
                        </div>
                        <div class="col-md-6">
                            <label>Lastname</label>
                            <input type="text" name="lastname" class="form-control checking_email" placeholder="Enter your lastname" required>
                        </div>
                        <div class="col-md-6">
                            <label>Address</label>
                            <input type="text" name="address" class="form-control" placeholder="Enter your address" required>
                        </div>
                        <div class="col-md-6">
                            <label>Contact</label>
                            <input type="number" name="contact" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" placeholder="Enter Contact number" required>
                        </div>
                        <div class="col-md-6">
                            <label>Email</label>
                            <input type="email" name="emails" class="form-control" placeholder="Enter your valid Email address" required>
                            <small class="error_email" style="color: red;"></small>
                        </div>
                        <div class="col-md-6">
                            <label>Membership join</label>
                            <input type="date" name="membership_start" class="form-control" required>
                        </div>
                        <!-- <div class="form-group">
                            <label>Membership Expire</label>
                            <input type="date" name="membership_end" class="form-control" >
                        </div> -->
                        <div class="row">
                            <div class="col-md-6 col-xs-6">
                                <label>Membership Type:</label>
                                <label class="container">
                                    <input type="radio" name="type" value="Annual" required />Annual
                                </label>
                                <label class="container">
                                    <input type="radio" name="type" value="Senior/Student" required />Senior/Student
                                </label>
                            </div>
                            <div class="col-md-6 col-xs-6">
                                <label>Import Picture</label>
                                <input type="file" name="image" class="form-control-file" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="validationCustom01" class="form-label"> Note/Comment </label>
                            <textarea type="text" name="note" class="form-control" id="validationCustom01" cols="2" rows="2" placeholder="Note/Comment" required></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" name="register" class="btn btn-success">Save</button>
                </div>
                </form>

            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="card shadow mb-4">
            <!-- <div class="card-header py-3">
                <h4 class="m-2 font-weight-bold text-primary">Membership</h4>
                <h6 class="m-0 font-weight-bold text-success">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addmember">
                        <i class="fa fa-user-plus"></i>
                    </button>
                </h6>
            </div>  -->
            <div class="card-header py-2 bg-dark">
                <h4 class="m-2 font-weight-bold text-white">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addmember">Membership
                        <i class="fa fa-user-plus"></i>
                    </button>
            </div>
            <div class="card-body">

                <div class="table-responsive">

                    <?php
                    $query = "SELECT * FROM tbl_membership";
                    $query_run = mysqli_query($connection, $query);
                    ?>
                    <center>
                        <table class="table" id="dataTable" width="100%" cellspacing="10%">
                            <thead>
                                <tr style="background-color: #faf1f0;">
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Type</th>
                                    <th>Address</th>
                                    <th>Expire</th>
                                    <th>View</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (mysqli_num_rows($query_run) > 0) {
                                    while ($row = mysqli_fetch_assoc($query_run)) {

                                        date_default_timezone_set('Asia/manila');
                                        $today = date("Y-m-d"); ?>

                                        <tr>
                                            <td><?php echo $row['firstname'] . ' ' . $row['lastname']; ?> </td>
                                            <td><?php echo $row['emails']; ?></td>

                                            <?php
                                            if ($row['membership_end'] > $today) {
                                                //    echo '<p><i class="fa fa-circle text-success"></i><a href="active.php?ID=' . $row['ID'] . '&status=0">Active</a></p>';
                                                echo "<td style='background-color: #00FF00;'>" . $row['membership_end'] . "</td>";
                                            } else {
                                                echo "<td style='background-color: red;'>" . $row['membership_end'] . "</td>";
                                            }
                                            ?>

                                            <td><?php echo $row['type']; ?></td>
                                            <td><?php echo $row['address']; ?></td>
                                            <td><?php echo $row['membership_end']; ?></td>

                                            <td>
                                                <form action="view.php" method="POST">
                                                    <input type="hidden" name="view_id" value="<?php echo $row['ID']; ?>">
                                                    <button type="submit" name="view" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="membership_edit.php" method="POST">
                                                    <input type="hidden" name="update_id" value="<?php echo $row['ID']; ?>">
                                                    <button type="submit" name="update" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo "";
                                }
                                ?>
                            </tbody>
                        </table>
                    </center>
                </div>
            </div>
        </div>
    </div>
    </div>


    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

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

<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>

<script src="material/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="material/jquery-easing/jquery.easing.min.js"></script>
<script src="js/material-dashboard.js"></script>

<?php
include('body/footer.php');
?>