<?php
include('./body_trainer/trainer_security.php');

include('body_trainer/trainer_header.php'); 
include('body_trainer/trainer_navbar.php');
?>

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
                                Custromer</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">

                            </div>
                        </div>
                        <div class="col-auto">
                            <a href="trainer_list.php" class="fas fa-list fa-2x text-gray-1000"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="col-xl-3 col-md-3 mb-3">
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
        </div> -->
    </div>

    <hr>
</div>
</div>



<script src="material/jquery/jquery.min.js"></script>
<script src="material/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="js/material-dashboard.js"></script>

<?php
include('body_customer/cfooter.php');
?>