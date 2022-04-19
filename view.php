<?php
include('security.php');

include('body/header.php');
include('body/navbar.php');
?>
<link href="css/googleapis.css" rel="stylesheet" />
<link href="css/mdb.css" rel="stylesheet" />

<style>
    * {
        box-sizing: border-box;
    }

    /* Create two equal columns that floats next to each other */
    .column {
        float: left;
        width: 50%;
        padding: 10px;
        height: 300px;
        /* Should be removed. Only for demonstration */
    }

    /* Clear floats after the columns */
    .row:after {
        content: "";
        display: table;
        clear: both;
    }
</style>

<?php
if (isset($_POST['view'])) {
    $id = $_POST['view_id'];

    $query = "SELECT * FROM tbl_membership WHERE ID = '$id' ";
    $query_run = mysqli_query($connection, $query);

    foreach ($query_run as $row) {
?>

        <center>
            <div class="col-xl-8 col-md-7 mb-9">
            <div class="card-header py-2 bg-dark">
                <h4 class="m-2 font-weight-bold text-white">
                <?php echo $row['firstname'] . " " . $row['lastname']; ?></h4>
            </div>
                <div class="card border shadow h-100 py-2">

                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <p style="color: black;">
                                    <label>Address</label><input type="text" class="form-control" value="<?php echo $row['address'];?>" readonly>
                                    <label>Email</label><input type="text" class="form-control" value="<?php echo $row['emails']; ?>" readonly>
                                    <label>Joined</label><input type="text" class="form-control" value="<?php echo $row['membership_start']; ?>" readonly>
                                    <label>Expire</label><input type="text" class="form-control" value="<?php echo $row['membership_end']; ?>" readonly>
                                    <label>Membership Type</label><input type="text" class="form-control" value="<?php echo $row['type']; ?>" readonly>
                                </p>
                            </div>
                            <div class="col-md-4 offset-md-1" style="background-color:white;">
                                <div class="col-auto">
                                    <i class="far fa-user fa-4x text-gray-1000"></i>
                                <hr>
                                    <div class="col-auto">
                                        <p style="color: black">
                                        <label>Expire</label><input type="text" class="form-control" value="<?php echo $row['registered']; ?>" readonly>
                                        </p>
                                    </div>
                                </div>
                                <br>
                                <p style="color: black;">
                                    <label> ID </label> <br>
                                    <img width="auto" src="img/membership_image/<?php echo $row['image'] ?>" width="100" height="100" />
                                </p>
                            </div>
                        </div>
                        <hr>
                        <a href="membership.php" class="btn btn-danger" style="float: right;">Cancel</a>
                    </div>
                </div>
            </div>
            </div>
            &nbsp;
    <?php
    }
}
    ?>
        </center>

        <?php
        include('body/script.php');
        include('body/footer.php');
        ?>