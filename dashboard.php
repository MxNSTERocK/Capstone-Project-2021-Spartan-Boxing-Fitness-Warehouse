<?php
include('security.php');

include('body/header.php');
include('body/navbar.php');
?>

<link href="css/googleapis.css" rel="stylesheet" />
<link href="css/mdb.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<link rel="stylesheet" href="css/datatable.css">

<script src="material/jquery/jquery.min.js"></script>
<script src="material/datatables/jquery.dataTables.min.js"></script>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Registered Admin</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php
                                $query = "SELECT ID FROM tbl_admin WHERE level= 'admin' ORDER BY ID";
                                $query_run = mysqli_query($connection, $query);
                                $row = mysqli_num_rows($query_run);
                                echo '<small> Admin:  ' . $row . ' </small>';
                                ?>
                                <hr>
                                <?php
                                $query = "SELECT ID FROM tbl_admin WHERE level= 'customer' ORDER BY ID";
                                $query_run = mysqli_query($connection, $query);
                                $row = mysqli_num_rows($query_run);
                                echo '<small> Customer:  ' . $row . ' </small>';
                                ?>

                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="far fa-user fa-2x text-gray-1000"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Membership</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php
                                $query = "SELECT ID FROM tbl_membership WHERE status= 1 ORDER BY ID";
                                $query_run = mysqli_query($connection, $query);
                                $row = mysqli_num_rows($query_run);
                                echo '<small> Active:  ' . $row . ' </small>';
                                ?>
                                <hr>
                                <?php
                                $query = "SELECT ID FROM tbl_membership WHERE status= 0 ORDER BY ID";
                                $query_run = mysqli_query($connection, $query);
                                $row = mysqli_num_rows($query_run);
                                echo '<small> Deactivated:  ' . $row . ' </small>';
                                ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="far fa-address-card fa-2x text-gray-1000"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Reservation
                            </div>

                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">

                                <?php
                                $query = "SELECT ID FROM tbl_reservation WHERE status= 'Conform' ORDER BY ID";
                                $query_run = mysqli_query($connection, $query);
                                $row = mysqli_num_rows($query_run);
                                echo '<small> Confirm:  ' . $row . ' </small>';
                                ?>
                                <hr>
                                <?php
                                $query = "SELECT ID FROM tbl_reservation WHERE status= 'Not Conform' ORDER BY ID";
                                $query_run = mysqli_query($connection, $query);
                                $row = mysqli_num_rows($query_run);
                                echo '<small> Not Confirm:  ' . $row . ' </small>';
                                ?>
                            </div>

                        </div>
                        <div class="col-auto">
                            <i class="fas fa-book fa-2x text-gray-1000"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Equipment</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">

                                <?php
                                $query = "SELECT ID FROM tbl_equipment WHERE status= 'Available' ORDER BY ID";
                                $query_run = mysqli_query($connection, $query);
                                $row = mysqli_num_rows($query_run);
                                echo '<small> Available:  ' . $row . ' </small>';
                                ?>
                                <hr>
                                <?php
                                $query = "SELECT ID FROM tbl_equipment WHERE status= 'Unavailable' ORDER BY ID";
                                $query_run = mysqli_query($connection, $query);
                                $row = mysqli_num_rows($query_run);
                                echo '<small> Unavailable:  ' . $row . ' </small>';
                                ?>

                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dumbbell fa-2x text-gray-1000"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Add Trainer </button>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Trainer </h5>
                                </div>
                                <div class="modal-body">
                                    <form action="code.php" method="POST">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label> Trainer's name </label>
                                                <input type="text" name="trainer" class="form-control" placeholder="Enter your firstname" onkeyup="this.value = this.value.toUpperCase();" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" name="add_trainer" class="btn btn-success">Save</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="container">
                        <div class="col-md-">
                            <div class="fix">
                                <table class="table" id="dataTable" width="100%" cellspacing="10%">
                                    <thead>
                                        <tr style="background-color: #faf1f0;">
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
        
                                        <?php
                                        $query = "SELECT * FROM tbl_trainer";
                                        $query_run = mysqli_query($connection, $query);

                                        if (mysqli_num_rows($query_run) > 0) {
                                            while ($row = mysqli_fetch_assoc($query_run)) { ?>

                                                <tr>
                                                    <td><?php echo $row['trainer'] ?> </td>
                                                    <td><?php
                                                        if ($row['status'] == 1) {
                                                            echo '<p><i class="fa fa-circle text-success"></i><a href="trainer.php?ID=' . $row['ID'] . '&status=0">Active</a></p>';
                                                        } else {
                                                            echo '<p><i class="fa fa-circle text-danger"></i><a href="trainer.php?ID=' . $row['ID'] . '&status=1">Inactive</a></p>';
                                                        }
                                                        ?></td>
                                                    <td>
                                                        <form action="trainer_edit.php" method="POST">
                                                            <input type="hidden" name="edit_id" value="<?php echo $row['ID']; ?>">
                                                            <button type="submit" name="edit_btn" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                        <?php
                                            }
                                        } else {
                                            echo "No Available Trainer";
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

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"></h6>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#eventModal">
                        Add Event </button>

                    <!-- Modal -->
                    <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModal" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="eventModal">Add Event</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="code.php" method="POST" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label> Event </label>
                                                <input type="text" name="event" class="form-control" placeholder="Enter your firstname" onkeyup="this.value = this.value.toUpperCase();" required>
                                            </div>
                                            <div class="form-group">
                                                <label> Description </label>
                                                <input type="text" name="description" class="form-control checking_email" placeholder="Enter your lastname" required>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 col-xs-6">
                                                    <label>Import Picture</label>
                                                    <input type="file" name="image" class="form-control-file" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" name="+event" class="btn btn-success">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="reservation.php">Manage Event</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="container">
                    <?php
                    $query = "SELECT * FROM tbl_event";
                    $query_run = mysqli_query($connection, $query);
                    ?>
                    <center>
                        <table class="table" id="dataTable" width="100%" cellspacing="10%">
                            <thead>
                                <tr style="background-color: #faf1f0;">
                                    <th>Event</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (mysqli_num_rows($query_run) > 0) {
                                    while ($row = mysqli_fetch_assoc($query_run)) { ?>
                                        <tr>
                                            <td><?php echo $row['event']; ?> </td>
                                            <td><?php
                                                if ($row['status'] == 1) {
                                                    echo '<p><i class="fa fa-circle text-success"></i><ID=' . $row['ID'] . '&status=0"></a></p>';
                                                } else {
                                                    echo '<p><i class="fa fa-circle text-danger"></i><ID=' . $row['ID'] . '&status=1"></a></p>';
                                                }
                                                ?></td>

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
                                    echo "Sorry! No Available Event";
                                }
                                ?>
                            </tbody>
                        </table>
                </div>

                <div class="card-body">
               
                        <div class="mt-2 text-center small">
                            <span class="mr-2">
                                <i class="fas fa-circle text-success"></i> Available
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle text-danger"></i> Unavailable
                            </span>
                        </div>
             
                </div>
            </div>
        </div>
    </div>
</div>


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