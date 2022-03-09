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
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Member</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="code.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
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
                            <input type="number" name="contact" class="form-control" placeholder="Enter Contact number" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="emails" class="form-control" placeholder="Enter your valid Email address" required>
                            <small class="error_email" style="color: red;"></small>
                        </div>
                        <div class="form-group">
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
                            <label>Note/Comment</label>
                            <textarea type="text" name="note" class="form-control" cols="5" rows="5"></textarea>
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
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-success">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addmember">
                        <i class="fa fa-user-plus"></i>
                    </button>
                </h6>
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
                                    <th>Address</th>
                                    <th>Status</th>
                                    <th>Type</th>
                                    <th>Join</th>
                                    <th>Expire</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (mysqli_num_rows($query_run) > 0) {
                                    while ($row = mysqli_fetch_assoc($query_run)) { ?>
                                        <tr>
                                            <td><?php echo $row['firstname'] . ' ' . $row['lastname']; ?> </td>
                                            <td><?php echo $row['address']; ?></td>
                                            <td><?php
                                                if ($row['status'] == 1) {
                                                    echo '<p><i class="fa fa-circle text-success"></i><a href="active.php?ID=' . $row['ID'] . '&status=0">Active</a></p>';
                                                } else {
                                                    echo '<p><i class="fa fa-circle text-danger"></i><a href="active.php?ID=' . $row['ID'] . '&status=1">Inactive</a></p>';
                                                }
                                                ?></td>
                                            <td><?php echo $row['type']; ?></td>
                                            <td><?php echo $row['membership_start']; ?></td>
                                            <td><?php echo $row['membership_end']; ?></td>

                                            <td>
                                                <form action="view.php" method="POST">
                                                    <input type="hidden" name="view_id" value="<?php echo $row['ID']; ?>">
                                                    <button type="submit" name="view" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></button>
                                                </form>
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
    </div>
    </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

</body>

</html>

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