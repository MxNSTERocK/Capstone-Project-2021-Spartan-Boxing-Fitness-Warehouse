<?php
include('security.php');

include('body/header.php');
include('body/navbar.php');
?>

<link href="css/googleapis.css" rel="stylesheet" />
<link href="css/mdb.css" rel="stylesheet" />

<?php
if (!isset($_GET["rid"])) {

    header("location:index.php");
} else {
    $curdate = date("Y/m/d");
    $id = $_GET['rid'];


    $sql = "Select * from tbl_reservation where id = '$id'";
    $re = mysqli_query($connection, $sql);
    while ($row = mysqli_fetch_array($re)) {
        $id = $row['ID'];
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        $email = $row['mail'];
        $contact = $row['contact'];
        $event = $row['Event'];
        $checkin = $row['checkout'];
        $checkout = $row['checkout'];
        $status = $row['status'];
        $days = $row['days'];
    }
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Administrator </title>
    <!-- Bootstrap Styles-->
    <!-- <link href="reservation/admin/assets/css/bootstrap.css" rel="stylesheet" /> -->
    <!-- FontAwesome Styles-->
    <link href="reservation/admin/assets/css/font-awesome.css" rel="stylesheet" />
    <!-- Morris Chart Styles-->
    <link href="reservation/admin/assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <!-- Custom Styles-->
    <link href="reservation/admin/assets/css/custom-styles.css" rel="stylesheet" />
    <!-- Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>

<body>
    <div class="container">
        <div class="col-xl-12 col-md-12 mb-12">
            <div class="card border shadow h-100 py-0">
            <div class="modal-header bg-dark">
            <h5 class="modal-title" id="exampleModalLabel" style="color: white;">Reservation Information<small> &nbsp; <?php echo  $curdate; ?> </small></h5>
        </div>
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="panel panel-info">
                                            <div class="panel-heading">
                                                Booking Confirmation
                                            </div>
                                            <br>
                                            <div class="panel-body">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tr>
                                                            <th>DESCRIPTION</th>
                                                            <th>INFORMATION</th>
                                                        </tr>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th><?php echo $id . " " . $firstname . " " . $lastname; ?> </th>
                                                        </tr>
                                                        <tr>
                                                            <th>Email</th>
                                                            <th><?php echo $email; ?> </th>
                                                        </tr>
                                                        <tr>
                                                            <th>Contact </th>
                                                            <th><?php echo $contact; ?></th>
                                                        </tr>
                                                        <tr>
                                                            <th>Event </th>
                                                            <th><?php echo $event;  ?></th>
                                                        </tr>
                                                        <tr>
                                                            <th>Checkin </th>
                                                            <th><?php echo $checkin; ?></th>
                                                        </tr>
                                                        <tr>
                                                            <th>Checkout </th>
                                                            <th><?php echo $checkout; ?></th>
                                                        </tr>
                                                        <tr>
                                                            <th>status </th>
                                                            <th><?php echo $status; ?></th>
                                                        </tr>
                                                        <tr>
                                                            <th># of Days </th>
                                                            <th><?php echo $days; ?></th>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="panel-footer">
                                                <form method="POST">
                                                    <div class="form-group">
                                                        <label>Select the Conformation</label>
                                                        <select name="conf" class="form-control">
                                                            <option value selected> </option>
                                                            <option value="Conform">Conform</option>
                                                            <option value="Decline">Decline</option>
                                                        </select>
                                                    </div>
                                                    <button type="submit" name="co" value="Conform" class="btn btn-success pull-right" onclick="pop">Submit</button>
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
        </div>
    </div>
    </div>

    <?php
    if (isset($_POST['co'])) {
        $st = $_POST['conf'];

        if ($st == "Conform") {
            $urb = "UPDATE `tbl_reservation` SET `status`='$st' WHERE ID = '$id'";
            $query_run = mysqli_query($connection, $urb);
            echo "<script type='text/javascript'> alert('Booking Conform')</script>";
            echo "<script type='text/javascript'> window.location='reservation.php'</script>";
        } else if ($st == "Decline") {
            $query = mysqli_query($connection, "SELECT * FROM `tbl_reservation`");
            while ($fetch = mysqli_fetch_array($query)) {
                mysqli_query($connection, "INSERT INTO tbl_decline (ID,firstname,lastname,mail,contact,Event,checkin,checkout,status,days)  SELECT ID,firstname,lastname,mail,contact,Event,checkin,checkout,status,days FROM tbl_reservation WHERE ID='$id'");
                mysqli_query($connection, "DELETE FROM `tbl_reservation` WHERE ID = '$id'");
                // $urb = "DELETE FROM `tbl_reservation` WHERE ID = '$id'";
                // $run = mysqli_query($connection, $urb);
                echo "<script type='text/javascript'> alert('Successfully Decline')</script>";
                echo "<script type='text/javascript'> window.location='reservation.php'</script>";
            }
        }
    }
    ?>

    <script>
        function confirmation(delName) {
            var del = confirm("Are you sure you want to delete this record?\n" + delName);
            if (del == true) {
                window.location.href = "reservation.php";
            }
            return del;
        }
    </script>

    <!-- jQuery Js -->
    <script src="reservation/admin/assets/js/jquery-1.10.2.js"></script>
    <!-- Bootstrap Js -->
    <script src="reservation/admin/assets/js/bootstrap.min.js"></script>
    <!-- Metis Menu Js -->
    <script src="reservation/admin/assets/js/jquery.metisMenu.js"></script>
    <!-- Morris Chart Js -->
    <script src="reservation/admin/assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="reservation/admin/assets/js/morris/morris.js"></script>
    <!-- Custom Js -->
    <script src="reservation/admin/assets/js/custom-scripts.js"></script>
</body>

</html>

<?php
include('body/script.php');
include('body/footer.php');
?>