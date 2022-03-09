<?php
include('security.php');

include('body/header.php');
include('body/navbar.php');
?>

<link href="css/reservation.css" rel="stylesheet" />
<link href="css/googleapis.css" rel="stylesheet" />
<link href="css/mdb.css" rel="stylesheet" />


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
            <div class="col-xl-13 col-md-13 mb-13">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-header py-3" style="background-color: #FEEAE6;">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            <i class="fas fa-list-ul fa-2x text-gray-1000" data-toggle="modal" data-target="#myEvent" data-toggle="tooltip" data-placement="top" title="Add Event"></i> &nbsp; List of Event
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
                                            <!-- <img width="auto" src="img/event_image/<?php //echo $row['image'] ?>" width="100" height="150" /> -->
                                            <?php
                                            if ($row['status'] == 1) {
                                                echo '<p><div class="alert alert-success"><a href="availability.php?ID=' . $row['ID'] . '&status=0">Available</a></div></p>';
                                            } else {
                                                echo '<p><div class="alert alert-danger"><a href="availability.php?ID=' . $row['ID'] . '&status=1">Unavailable</a></div></p>';
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

    </div>
    <!-- The Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Reservation Form</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <!-- Reservation -->
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    PERSONAL INFORMATION
                                </div>
                                <hr>
                                <div class="panel-body">
                                    <form name="form" action="code.php" method="POST">
                                        <div class="form-group">
                                            <label>Firstname</label>
                                            <input name="firstname" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Lastname</label>
                                            <input name="lastname" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input name="mail" type="email" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                                    <label>Contact</label>
                                                    <input name="contact" type="int" class="form-control" required>
                                                </div>

                                        <?php
                                        $select = mysqli_query($connection, " SELECT * FROM tbl_event WHERE status=1");
                                        ?>

                                        <div class="form-group">
                                            <label>Event</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <label class="input-group-text" for="inputGroupSelect01">Choose event</label>
                                                </div>

                                                <select name="Event" id="Event" class="form-control">
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
                                            RESERVATION INFORMATION
                                        </div>
                                        <hr>
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <label>Check-In</label>
                                                <input name="checkin" type="date" class="form-control">
                                            </div>


                                            <div class="form-group">
                                                <label>Check-Out</label>
                                                <input name="checkout" type="date" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="container">
                                <div class="col-md-16 col-sm-16">
                                    <button type="submit" name="submit" class="btn btn-primary pull-right">Submit</button>
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
            <div class="card border-left-primary shadow h-200 py-2">
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
                                    					<div class='panel-body'>
                                    						<i class='fa fa-users fa-2x'></i>
                                    						<h3>" . $mrow['lastname'] . "</h3>
                                    					</div>
                                    					<div class='panel-footer back-footer-blue'><br>
                                    					<a href=show.php?sid=" . $fid . "><button  class='btn btn-success btn' data-toggle='modal' data-target='#myModal'>
                                    				Show
                                    				</button></a> <br>
                                    						" . $mrow['checkin'] . "
                                    					</div>
                                    				</div>	
                                    		</div>";
                                    }
                                }
                                ?>
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
                    <div class="modal-header" style="background-color: #FEEAE6;">
                        <h4 style="color:black" class="modal-title"> <i class='fas fa-book' style='font-size:48px;color:black'>&nbsp;</i>Event</h4>
                    </div>
                    <div class="modal-body">
                        <!-- Reservation -->
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="panel panel-primary">
                                    <div class="panel-body">
                                        <form name="form" action="code.php" method="POST" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label>Event</label>
                                                <input name="event" class="form-control" required>
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
    </div>
</body>

</html>

<?php
include('body/script.php');
include('body/footer.php');
?>