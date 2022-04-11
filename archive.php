<?php
include('security.php');

include('body/header.php');
include('body/navbar.php');
?>


<!DOCTYPE html>
<?php require 'code.php' ?>
<html lang="en">

<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1" />
    <link href="css/googleapis.css" rel="stylesheet" />
    <link href="css/mdb.css" rel="stylesheet" />

    <script type="text/javascript" src="covid19/js/instascan.min.js"></script>
    <script src="covid19/plugins/jquery/jquery.min.js"></script>

    <!-- DataTables -->
    <link rel="stylesheet" href="covid19/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="covid19/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
</head>

<body>


    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-2 font-weight-bold text-primary">Archive</h4>
                <h6 class="m-0 font-weight-bold text-success">
                    <a href="admin.php" class="btn btn-success float-right"><i class="fas fa-home"></i></a>
                </h6>
            </div>

            <div class="card-body">

                <div class="table-responsive">
                    <div class="col-md-12 well">

                        <br /><br />
                        <table id="example1" class="table table-bordered">
                            <thead class="alert-info">
                                <tr>
                                    <th>Profile</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Created</th>
                                    <th>Archive</th>
                                </tr>
                            </thead>
                            <tbody style="background-color:#fff;">
                                <?php
                                $query = mysqli_query($connection, "SELECT * FROM `tbl_admin` WHERE status = 0") or die(mysqli_error($connection));
                                while ($row = mysqli_fetch_array($query)) {
                                ?>
                                    <tr>
                                        <td> <img src="img/customer_image/<?php echo $row['image'] ?>" height="50" width="50" /></td>
                                        <td><?php echo $row['firstname'] . ' ' . $row['lastname']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td><?php echo $row['level']; ?></td>
                                        <td><?php echo $row['created']; ?></td>
                                        <td><center><?php
                                            if ($row['status'] == 1) {
                                                echo '<p><a href="archive.php?ID=' . $row['ID'] . '"><i class="fa fa-archive fa-lg" aria-hidden="true"style="color:#0275d8 "></i></a></p>';
                                            } 
                                            else {
                                                echo '<p><a href="active.php?ID=' . $row['ID'] . '&status=1"><i class="fa fa-archive fa-lg" aria-hidden="true"style="color:#d9534f  "></i></a></p>';
                                            }
                                            ?></center></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>







</body>

</html>

<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>


<script src="covid19/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="covid19/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="covid19/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="covid19/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="covid19/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<script src="material/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="material/jquery-easing/jquery.easing.min.js"></script>
<script src="js/material-dashboard.js"></script>

<?php
include('body/footer.php');
?>