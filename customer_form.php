<?php
include('membership_security.php');

include('body_customer/cheader.php');
include('body_customer/cnavbar.php');
?>

<!-- <link href="css/googleapis.css" rel="stylesheet" />
<link href="css/mdb.css" rel="stylesheet" /> -->
<style>
    label {
        color: black;
    }
</style>

<center>
    <div class="col-xl-9 col-md-5 mb-5">
        <div class="card border shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            <legend style="color: black;">Personal Information</legend>
                            <hr>
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <form name="form" class="row g-3 needs-validation" action="membership_access.php" method="POST" novalidate>
                                    <div class="col-md-6">
                                        <label for="validationCustom01" class="form-label">First name</label>
                                        <input type="text" name="firstname" id="validationCustom01" class="form-control" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="validationCustom02" class="form-label">Last name</label>
                                        <input type="text" name="lastname" class="form-control" id="validationCustom02" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label for="validationCustomUsername" class="form-label">Email</label>
                                        <input type="email" name="mail" class="form-control" id="validationCustomUsername" required>
                                        <div class="invalid-feedback">
                                            Please enter valid email address.
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label for="validationCustom03" class="form-label">Contact number</label>
                                        <input type="number" name="contact" class="form-control" id="validationCustom03" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" required>
                                        <div class="invalid-feedback">
                                            Please enter your valid contact number
                                        </div>
                                    </div>
                                    <?php
                                    $select = mysqli_query($connection, " SELECT * FROM tbl_event WHERE status=1");
                                    ?>

                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    <legend style="color: black;">Personal Information</legend>
                                                    <hr>
                                                </div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <label>Choose event</label>
                                        <select name="Event" id="Event" class="form-control form-select" required aria-label="select example">
                                            <option selected disabled value="">Choose event</option>
                                            <?php
                                            while ($row = mysqli_fetch_array($select)) {
                                            ?>
                                                <option><?php echo $row['event']; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                        <div class="invalid-feedback">Choose event</div>
                                    </div>

                                    <div class="col-md-12">
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
                                    </div>
                            </div>
                            <div class="col-md-6">
                                <label for="validationCustom05" class="form-label">Check-in</label>
                                <input type="date" name="checkin" class="form-control" id="validationCustom05" required>
                            </div>
                            <div class="col-md-6">
                                <label for="validationCustom06" class="form-label">Check-out</label>
                                <input type="date" name="checkout" class="form-control" id="validationCustom03" required>
                            </div>
                            <div class="col-12">
                                <div id="line">
                                    <hr />
                                </div>
                                <button type="submit" class="btn btn-info" class="form-control" name="submit">Submit</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</center>

<script>
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
include('body_customer/cscript.php');
include('body_Customer/cfooter.php');
?>