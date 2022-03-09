<?php
include('membership_security.php');

include('body_customer/cheader.php');
include('body_customer/cnavbar.php');
?>

<!-- <link href="css/googleapis.css" rel="stylesheet" />
<link href="css/mdb.css" rel="stylesheet" /> -->

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
    </div>

    <div class="d-flex justify-content-center">
        <div class="col-xl-3 col-md-3 mb-3">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Membership</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">

                            </div>
                        </div>
                        <div class="col-auto">
                            <a href="customer_membership.php" class="far fa-address-card fa-2x text-gray-1000"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-3 mb-3">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Reservation
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <a href="customer_form.php" class="fas fa-book fa-2x text-gray-1000"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-xl-6 col-md-6 mb-6">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-md font-weight-bold text-success text-uppercase mb-1">
                                Membership</div>
                                <hr>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php
                                $firstname = $_SESSION['firstname'];

                                $left = "SELECT tbl_membership.status, tbl_membership.membership_start, tbl_membership.membership_end, IFNULL(tbl_membership.ID, 'NOT A MEMBER')FROM tbl_customer RIGHT JOIN tbl_membership ON tbl_customer.id = tbl_membership.ID WHERE email = '$firstname'";
                                $run = mysqli_query($connection, $left);
                                $row = mysqli_num_rows($run);

                                while ($row = mysqli_fetch_array($run)) {
                                    echo '<small> Status: &nbsp; </small>';
                                    if ($row['status'] == '1') {
                                        echo 'Active';
                                    } elseif ($row['status'] == '0') {
                                        echo 'Inactive';
                                    }
                                    else {
                                        echo 'Pending';
                                    }
                                    echo '<hr>';
                                    echo '<small> Until: &nbsp; </small>';
                                    echo $row['membership_start'];
                                    echo '<hr>';
                                    echo '<small> to: &nbsp; </small>';
                                    echo $row['membership_end'];
                                }?>
                </div>
            </div>
            

            <div class="col-auto">
                <li  class="far fa-address-card fa-4x text-gray-1000"></li>
            </div>

        </div>
    </div>
</div>
</div>



<div class="col-xl-6 col-md-6 mb-6">
    <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-md font-weight-bold text-info text-uppercase mb-1">Reservation
                        <hr>
                    </div>
                    <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                            <?php
                                $firstname = $_SESSION['firstname'];

                                $left = "SELECT tbl_reservation.Event, tbl_reservation.status, tbl_reservation.checkin, tbl_reservation.checkout, IFNULL(tbl_reservation.ID, 'No Reservation')FROM tbl_customer RIGHT JOIN tbl_reservation ON tbl_customer.id = tbl_reservation.ID WHERE email = '$firstname'";
                                $run = mysqli_query($connection, $left);
                                $row = mysqli_num_rows($run);

                                while ($row = mysqli_fetch_array($run)) {
                                    echo '<small> Status: &nbsp; </small>';
                                    if ($row['status'] == 'Conform') {
                                        echo 'Confirmed';
                                    } elseif ($row['status'] == '') {
                                        echo 'Pending';
                                    }
                                    else {
                                        echo 'Pending';
                                    }
                                    echo '<hr>';
                                    echo '<small> Until: &nbsp; </small>';
                                    echo $row['checkin'] . ' ' . $row['checkout'];
                                    echo '<hr>';
                                    echo '<small> Event: &nbsp; </small>';
                                    echo $row['Event'];
                                }?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-auto">
                    <li class="fas fa-book fa-4x text-gray-1000"></li>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>






<?php
include('body_customer/cscript.php');
include('body_customer/cfooter.php');
?>