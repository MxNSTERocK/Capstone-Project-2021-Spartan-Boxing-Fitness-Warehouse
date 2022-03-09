<?php
include('membership_security.php');

include('body_customer/cheader.php');
include('body_customer/cnavbar.php');
?>

<!-- <link href="css/googleapis.css" rel="stylesheet" />
<link href="css/mdb.css" rel="stylesheet" /> -->

<style>
    fieldset {
        background-color: #eeeeee;
        box-sizing: border-box;
        padding: 1px 5px 10px;
    }

    legend {
        background-color: #54b87f;
        color: white;
        padding: 1px 5px 10px 20px 40px 80px 100px;
    }

    input {
        margin: 0px;
    }
</style>

<center>


    <div class="col-xl-5 col-md-5 mb-5">
        <div class="card border shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                    $firstname = $_SESSION['firstname'];
                    
                    $query = "SELECT * FROM tbl_customer WHERE email = '$firstname' ";
                    $fecth_run = mysqli_query($connection, $query);

                    while($row = mysqli_fetch_array($fecth_run)) {
                    ?>

                    <div class="col-xl-12 col-md-12 mb-12">
                        <form name="form" action="membership_access.php" method="POST">
                            <fieldset>
                                <legend>Personal Information</legend>
                                <div class="form-group">
                                    <label>Id</label>
                                    <input type="number" class="form-control" name="ID" value="<?php echo $row['id']; ?>"  readonly>
                                </div>
                                <?php 
                    }
                                ?>
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
                                    <input name="contact" type="number" class="form-control" required>
                                </div>

                                <?php
                                $select = mysqli_query($connection, " SELECT * FROM tbl_event WHERE status=1");
                                ?>

                                <legend>Reservation Information</legend>
                                <div class="form-group">
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
                                <button type="submit" class="btn btn-success" name="submit">Submit</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</center>

<?php
include('body_customer/cscript.php');
include('body_Customer/cfooter.php');
?>