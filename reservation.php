<?php
include('security.php');

include('body/header.php');
include('body/navbar.php');
?>

<link href="css/reservation.css" rel="stylesheet" />
<link href="css/googleapis.css" rel="stylesheet" />
<link href="css/mdb.css" rel="stylesheet" />

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>



<style>
    .alert {
        /* display: inline-block; */
        width: 53%;
    }

    .o {
        position: absolute;
        left: 175px;
        bottom: 37px;
    }
</style>

<body>
    <div class="card-body">
        <div class="container">
            <!-- <div class="col-xl-13 col-md-13 mb-13"> -->
            <div class="card border shadow h-100 py-0">
                <div class="card-header py-3 bg-dark">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        <i class="fas fa-list-ul fa-2x text-gray-1000" data-toggle="modal" data-target="#myEvent" data-toggle="tooltip" data-placement="top" title="Add Event" style="color: white"></i>
                    </div>
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                    <?php
                    $query = "SELECT * FROM tbl_event";
                    $query_run = mysqli_query($connection, $query);
                    ?>
                    <?php
                    if (mysqli_num_rows($query_run) > 0) {
                        while ($row = mysqli_fetch_assoc($query_run)) { ?>

                            <div class="container">
                                <div class="col-md-4">
                                    <div class="fix">
                                        <br>
                                        <p><?php echo $row['event']; ?></p>
                                        <button class="btn btn-information"> <img src="img/event_image/<?php echo $row['image'] ?>" height="100" width="100" /></button>
                                        <?php

                                        if ($row['status'] == 1) {
                                            echo '<p><div class="alert alert-success" id="avail"> <a href="availability.php?ID=' . $row['ID'] . '&status=0">Available</a></div></p>';
                                        } else {
                                            echo '<p><div class="alert alert-danger" id="unavail"><a href="availability.php?ID=' . $row['ID'] . '&status=1">Unavailable</a></div></p>';
                                        }
                                        ?>

                                        <form action="event_edit.php" method="POST">
                                            <input type="hidden" name="edit_id" value="<?php echo $row['ID']; ?>">
                                            <button type="submit" name="upevent" class="o btn btn-success btn-lg "><i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="Update"></i></button>
                                        </form>
                                        <br>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        document.getElementById('avail').onclick = function(e) {
            if (!confirm('Are you sure you want to change the status')) {
                e.preventDefault();
            }
        }
    </script>

    <!-- The Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header bg-dark">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <!-- Reservation -->
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1 text-center">
                                        <legend style="color: black;">Personal Information</legend>
                                        <hr>
                                    </div>
                                </div>

                                <div class="panel-body">
                                    <form name="form" action="code.php" method="POST" class="needs-validation g-3" novalidate>
                                        <div class="col-md-6">
                                            <label for="validationCustom01" class="form-label">Firstname</label>
                                            <input name="firstname" class="form-control" id="validationCustom01" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Lastname</label>
                                            <input name="lastname" class="form-control" required>
                                        </div>
                                        <div class="col-md-12">
                                            <label>Email</label>
                                            <input type="email" name="mail" class="form-control" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Contact</label>
                                            <input type="number" name="contact" class="form-control" required>
                                        </div>

                                        <?php
                                        $select = mysqli_query($connection, " SELECT * FROM tbl_event WHERE status=1");
                                        ?>

                                        <div class="col-md-6">
                                            <label>Event</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <label class="input-group-text" for="inputGroupSelect01">Choose event</label>
                                                </div>

                                                <select name="Event" id="Event" class="form-select" required aria-label="select example">
                                                    <option selected disabled value="">Select level of user</option>
                                                    <?php
                                                    while ($row = mysqli_fetch_array($select)) {
                                                    ?>
                                                        <option><?php echo $row['event']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>

                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            <hr>
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1 text-center">
                                                <legend style="color: black;">Reservation Information</legend>
                                                <hr>
                                            </div>
                                        </div>

                                        <?php
                                        $today = date("Y-m-d");

                                        $date = "SELECT * FROM tbl_reservation";
                                        $date_run = mysqli_query($connection, $date);

                                        while ($row = mysqli_fetch_array($date_run)) {
                                            if ($row['checkout'] >= $today) {

                                                echo '<b>' . $row['Event'] . '</b> <br>' . $row['checkin'] . ' to ' . $row['checkout'] . '<br>'; // echo blah blah
                                            }
                                        }
                                        ?>

                                        <hr>
                                        <div class="panel-body">
                                            <div class="col-md-6">
                                                <label>Check-In</label>
                                                <input name="checkin" type="date" class="form-control" required>
                                            </div>

                                            <div class="col-md-6">
                                                <label>Check-Out</label>
                                                <input name="checkout" type="date" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="container">
                                <div class="col-md-16 col-sm-16">
                                    <button type="submit" name="submit" class="btn btn-primary float-right">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end -->
                </div>
            </div>
        </div>
    </div>

    <div class="container">

        <?php
        $sql = "SELECT * from tbl_reservation";
        $re = mysqli_query($connection, $sql);
        $c = 0;
        while ($row = mysqli_fetch_array($re)) {
            $new = $row['status'];
            $cin = $row['checkin'];
            $id = $row['ID'];
            if ($new == "Not Conform") {
                $c = $c + 1;
            }
        }
        ?>

        <div class="card-body">
            <!-- Modal -->
            <div class="card border shadow h-200 py-0">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title" id="exampleModalLabel" style="color: white;">Reservation</h5>
                </div>
                <div id="accordion">
                    <div class="card">
                        <div class="card-header" style="background-color: #FEEAE6;">
                            <button class="btn btn-success" data-toggle="collapse" href="#collapse1">
                                Booking <span class="badge"><?php echo $c;
                                                            ?></span></button>
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">
                                Make Reservation
                            </button>
                        </div>
                        <div id="collapse1" class="collapse show" data-parent="#accordion">
                            <div class="card-body">
                                <div class="panel panel-default">

                                    <div class="panel-body">
                                        <div class="table-responsive" id="dataTable">

                                            <table class="table" id="dataTable" width="100%" cellspacing="0" style="color: black">
                                                <thead>
                                                    <tr>
                                                        <th>NAME</th>
                                                        <th>EMAIL</th>
                                                        <th>EVENT</th>
                                                        <th>CHECK-IN</th>
                                                        <th>CHECK-OUT</th>
                                                        <th>STATUS</th>
                                                        <th>MORE</th>

                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php
                                                    $tsql = "SELECT * from tbl_reservation";
                                                    $tre = mysqli_query($connection, $tsql);
                                                    while ($trow = mysqli_fetch_array($tre)) {
                                                        $co = $trow['status'];
                                                        if ($co == "Not Conform") {
                                                            echo "<tr>
                                                    <th>" . $trow['firstname'] . " " . $trow['lastname'] . "</th>
                                                    <th>" . $trow['mail'] . "</th>
                                                    <th>" . $trow['Event'] . "</th>
                                                    <th>" . $trow['checkin'] . "</th>
                                                    <th>" . $trow['checkout'] . "</th>
                                                    <th>" . $trow['status'] . "</th>

                                                    <th><a href='reservation_query.php?rid=" . $trow['ID'] . " 'class='btn btn-success btn-sm'>Action</a></th></tr>";
                                                        }
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
                    <?php

                    $rsql = "SELECT * FROM `tbl_reservation`";
                    $rre = mysqli_query($connection, $rsql);
                    $r = 0;
                    $d = 0;
                    while ($row = mysqli_fetch_array($rre)) {
                        $br = $row['status'];
                        if ($br == "Conform") {
                            $r = $r + 1;
                        }
                    }

                    ?>

                    <div class="container">
                        <div class="card-header" style="background-color: #FEEAE6;">
                            <button class="btn btn-success" data-toggle="collapse" href="#collapse2">
                                Booked <span class="badge"><?php echo $r; ?></span></button>
                            <a class="btn btn-danger" data-bs-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Archive</a>
                        </div>
                    </div>

                    <div id="collapse2" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            <?php
                            $msql = "SELECT * FROM `tbl_reservation` ORDER BY checkout ASC";
                            $mre = mysqli_query($connection, $msql);

                            while ($mrow = mysqli_fetch_array($mre)) {
                                $br = $mrow['status'];
                                if ($br == "Conform") {
                                    $fid = $mrow['ID'];

                                    echo "<div class='col-md-3 col-xs-3'>
                                    				<div class='panel panel-primary text-center no-boder bg-color-blue'>
                                    						<i class='fa fa-users fa-2x'></i>
                                    						<small>" . $mrow['lastname'] . "</small>
                                                        <hr>
                                    					<a href=show.php?sid=" . $fid . ">
                                                        <i class='fas fa-eye data-toggle='modal' data-target='#myModal'></i>
                                    				 <br></a>
                                    						<small>" . $mrow['checkin'] . "</small>
                                    				</div>	
                                    		</div>";
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <!-- Archive -->
                <div class="row">
                    <div class="col">
                        <div class="collapse multi-collapse" id="multiCollapseExample1">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Contact</th>
                                                <th>Event</th>
                                                <th>Checkin</th>
                                                <th>Checkout</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            $query = 'SELECT * FROM tbl_decline';
                                            $result = mysqli_query($connection, $query) or die(mysqli_error($connection));

                                            while ($row = mysqli_fetch_assoc($result)) {

                                                echo '<tr>';
                                                echo '<td>' . $row['firstname'] . ' ' . $row['lastname'] . '</td>';
                                                echo '<td>' . $row['mail'] . '</td>';
                                                echo '<td>' . $row['contact'] . '</td>';
                                                echo '<td>' . $row['Event'] . '</td>';
                                                echo '<td>' . $row['checkin'] . '</td>';
                                                echo '<td>' . $row['checkout'] . '</td>';
                                                echo '</tr> ';
                                            }
                                            ?>

                                        </tbody>
                                    </table>
                                    <!-- pagination -->
                                    <nav aria-label="Page navigation example" style="float: right">
                                        <ul class="pagination">
                                            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Add Event -->
    <div class="modal fade" id="myEvent">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title" id="exampleModalLabel" style="color: white;">Add event</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Reservation -->
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="panel panel-primary">
                                <div class="panel-body">
                                    <form name="form" action="code.php" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                                        <div class="form-group">
                                            <label for="validationCustom01" class="form-label">Event</label>
                                            <input name="event" class="form-control" id="validationCustom01" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Description</label>
                                            <input name="description" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Image</label>
                                            <input type="file" name="image" class="form-control" required>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="container">
                            <div class="container">
                                <div class="col-md-16 col-sm-16">
                                    <button type="submit" name="addevent" class="btn btn-primary pull-right">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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

<?php
include('body/script.php');
include('body/footer.php');
?>