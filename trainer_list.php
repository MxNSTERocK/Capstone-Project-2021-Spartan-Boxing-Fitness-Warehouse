<?php
include('./body_trainer/trainer_security.php');

include('body_trainer/trainer_header.php');
include('body_trainer/trainer_navbar.php');
?>

<!-- <link href="css/googleapis.css" rel="stylesheet" />
<link href="css/mdb.css" rel="stylesheet" /> -->

<link rel="stylesheet" href="css/datatable.css">

<script src="material/jquery/jquery.min.js"></script>
<script src="material/datatables/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>

<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-2 font-weight-bold text-primary">Customer</h4>
        </div>

        <?php
        $id = $_SESSION['id'];

        $query = "SELECT * FROM tbl_membership" ;
        $query_run = mysqli_query($connection, $query);
        ?>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>membership_end</th>
                            <th>Trainer</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        if (mysqli_num_rows($query_run) > 0) {
                            while ($row = mysqli_fetch_assoc($query_run)) { ?>
                                <tr>
                                    <td><?php echo $row['firstname'] . ' ' . $row['lastname']; ?> </td>
                                    <td><?php echo $row['emails']; ?></td>
                                    <td><?php echo $row['membership_end']; ?></td>                       
                                    <td><?php echo $row['trainer']; ?></td>
                                </tr>
                        <?php
                            }
                        } else {
                            echo "";
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>

<script src="material/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="material/jquery-easing/jquery.easing.min.js"></script>
<script src="js/material-dashboard.js"></script>

<?php
include('body/footer.php');
?>




<!-- <script src="material/jquery/jquery.min.js"></script>
<script src="material/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="js/material-dashboard.js"></script> -->

<?php
//include('body_customer/cfooter.php');
?>