<!--design -->
<link href="css/material-dashboard.css" rel="stylesheet">

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
        <!-- <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
    </div> -->
        <div class="sidebar-brand-text mx-0">
            <h6><?= Title ?></h6>
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="dashboard.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Admin Dashboard
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-user-cog"></i>
            <span data-toggle="tooltip" data-placement="top" title="Go to Admin panel">Administrator</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Acount Management:</h6>
                <a class="collapse-item" href="admin.php" data-toggle="tooltip" data-placement="top" title="Adding Administrator">Administrator</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Contact Tracing
    </div>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-user-md"></i>
            <span data-toggle="tooltip" data-placement="top" title="Go to Contact tracing">Covid Contact Tracing</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Contact Tracing</h6>
                <a class="collapse-item" href="index.php" data-toggle="tooltip" data-placement="top" title="QR CODE Scanner">Webcam</a>
                <a class="collapse-item" href="contact_list.php" data-toggle="tooltip" data-placement="top" title="List of scanned QR CODE">Contact Tracing List</a>
                <a class="collapse-item" href="generate.php" data-toggle="tooltip" data-placement="top" title="Generate QR CODE of customer">Generate QR Code</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Transaction
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
            <i class="far fa-handshake"></i>
            <span data-toggle="tooltip" data-placement="top" title="Make Transaction">Transaction</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Transactions</h6>
                <a class="collapse-item" href="reservation.php" data-toggle="tooltip" data-placement="top" title="Make Reservation">Reservation</a>
                <a class="collapse-item" href="membership.php" data-toggle="tooltip" data-placement="top" title="Be a Member">Membership</a>
                <a class="collapse-item" href="equipment.php" data-toggle="tooltip" data-placement="top" title="Inventory">Equipment </a>
            </div>
        </div>
    </li>
    <li class="sidebar-divider">
    <li class="nav-item">
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <div class="sidebar-card d-none d-lg-flex">
        <img class="sidebar-card-illustration mb-6" src="img/spartan.jpg" style="max-width: 100%;">
        <p class="text-center mb-3"><strong><?= Title ?></strong></p>
        <a class="btn btn-primary btn-sm" href="https://web.facebook.com/search/top?q=spartan%20boxing%20and%20fitness%20warehouse"><i class="fab fa-facebook-f"></i></a>
    </div>

</ul>

<!-- End of Sidebar -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Search -->
            <!-- <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
                <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                    aria-label="Search" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-success" type="button">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
        </form> -->

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

                <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                <li class="nav-item dropdown no-arrow d-sm-none">
                    <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-search fa-fw"></i>
                    </a>

                    <!-- Dropdown - Messages -->
                    <!-- <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                    aria-labelledby="searchDropdown">
                    <form class="form-inline mr-auto w-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small"
                                placeholder="Search for..." aria-label="Search"
                                aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </li> -->

                    <!-- Nav Item - Alerts -->
                <li class="nav-item dropdown no-arrow mx-1" data-toggle="tooltip" data-placement="top" title="Notification for expired membership">
                    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-bell fa-fw"></i>
                        <!-- Counter - Alerts -->
                        <span class="badge badge-danger badge-counter">

                            <?php
                            $date = "SELECT * FROM tbl_membership WHERE membership_end >= DATE(now())AND membership_end <= DATE_ADD(DATE(now()), INTERVAL 3 DAY)AND notifications!='Yes'";

                            $query_run = mysqli_query($connection, $date);
                            $row = mysqli_num_rows($query_run);

                            echo '<small> ' . $row . ' </small>';
                            ?>
                        </span>
                    </a>
                    <!-- Dropdown - Alerts -->
                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                        <h6 class="dropdown-header">
                            Alerts Center
                        </h6>
                        <br>

                        <center>
                            <?php
                            $servertime = date_default_timezone_set('Asia/manila');
                            echo "Today is " . date("M-d-Y") . "<br>";

                            ?>
                        </center>
                        <hr>

                        <div>
 
                            <span class="small text-gray-1000">

                                <?php
                                //$_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

                                $date = "SELECT * FROM tbl_membership WHERE membership_end >= DATE(now())AND membership_end <= DATE_ADD(DATE(now()), INTERVAL 3 DAY) AND notifications!='Yes'";

                                $query_run = mysqli_query($connection, $date);
                                $row = mysqli_num_rows($query_run);
                                foreach ($query_run as $row) {
                                    // echo '<small>' . $row . ' </small>'; 
                                ?>
                            </span>

                            <center><a href="email.php?id=<?= $row['ID'] ?>&emails=<?= $row['emails'] ?>"><?php echo $row['emails']; ?><br></center>
                        <?php
                                }
                        ?>

                        </div>

                        <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                    </div>
                </li>

                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow" data-toggle="tooltip" data-placement="top" title="<?php echo $_SESSION['username']; ?>">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">

                            <?php echo $_SESSION['username'];?> 

                        </span>

                        <?php
                        $firstname = $_SESSION['username'];

                        $query = "SELECT * FROM tbl_admin WHERE email = '$firstname' ";
                        $query_run = mysqli_query($connection, $query);
                        ?>

                        <?php
                         if (mysqli_num_rows($query_run) > 0) {
                         while ($row = mysqli_fetch_assoc($query_run)) { ?>

                        <!-- <img class="img-profile rounded-circle" src="img/undraw_profile.svg"> -->
                        <img class="img-profile rounded-circle" src="img/customer_image/<?php echo $row['image'] ?>" height="50" width="50" />
                        <?php }}?>
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="profile.php">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                            Settings
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                            Activity Log
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- End of Topbar -->

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

                        <form action="code.php" method="POST">
                            <button type="submit" name="admin_logout" class="btn btn-primary">Logout</a></button>
                        </form>

                    </div>
                </div>
            </div>
        </div>