<?php
include('security.php');

include('body/header.php');
include('body/navbar.php');
?>

<link href="css/googleapis.css" rel="stylesheet" />
<link href="css/mdb.css" rel="stylesheet" />

<div class="container-fluid">

    <div class="card shadow mb-4">
    <div class="modal-header bg-dark">
            <h5 class="modal-title" id="exampleModalLabel" style="color: white;">Edit Membership Information</h5>
        </div>
        <div class="card-body">

            <?php
            if (isset($_POST['update'])) {
                $id = $_POST['update_id'];
                $query = "SELECT * FROM tbl_membership WHERE ID = '$id' ";
                $query_run = mysqli_query($connection, $query);

                foreach ($query_run as $row) {
            ?>

                    <form action="code.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="edit_id" value="<?php echo $row['ID'] ?>">
                        <div class="form-group">
                            <label"> Firstname </label>
                                <br>
                                <input type="text" name="edit_firstname" value="<?php echo $row['firstname'] ?>" class="form-control" placeholder="Update your firstname">
                        </div>
                        <div class="form-group">
                            <label>Lastname</label>
                            <br>
                            <input type="text" name="edit_lastname" value="<?php echo $row['lastname'] ?>" class="form-control" placeholder="Update your lastname">
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <br>
                            <input type="text" name="edit_address" value="<?php echo $row['address'] ?>" class="form-control" placeholder="Update your address">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <br>
                            <input type="email" name="edit_email" value="<?php echo $row['emails'] ?>" class="form-control" placeholder="Update your valid Email">
                        </div>
                        <div class="form-group">
                            <label>Start</label>
                            <br>
                            <input type="date" name="edit_membership_start" value="<?php echo $row['membership_start'] ?>" class="form-control">
                        </div>
                        <!-- <div class="form-group">
                            <label>End</label>
                            <br>
                            <input type="date" name="edit_membership_end" value="<?php echo $row['membership_end'] ?>" class="form-control">
                        </div> -->

                        <div class="row">
                            <div class="col-md-6 col-xs-6">
                                <label>Membership Type:</label>
                                <label class="container">
                                    <input type="radio" name="type" value="Annual" <?php if ($row['type'] == "Annual") {
                                                                                        echo "checked";
                                                                                    } ?> />Annual
                                </label>
                                <label class="container">
                                    <input type="radio" name="type" value="Senior/Student" <?php if ($row['type'] == "Senior/Student") {
                                                                                                echo "checked";
                                                                                            } ?> />Senior/Student
                                </label>
                            </div>
                            <div class="col-md-6 col-xs-6">
                                <label for="exampleFormControlFile1">Import Picture</label>
                                <input type="file" class="form-control-file" id="exampleFormControlFile1">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Note</label>
                            <br>
                            <input type="Text" name="edit_note" value="<?php echo $row['note'] ?>" class="form-control" placeholder="Put some comment here or suggestion">
                        </div>

                        <button type="submit" name="update" class="btn btn-success">Update</button>
                        <a href="membership.php" class="btn btn-danger">Cancel</a>
                    </form>
            <?php
                }
            }
            ?>
        </div>
    </div>
</div>
</div>

<!-- <script src="material/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="material/jquery-easing/jquery.easing.min.js"></script>
<script src="js/material-dashboard.js"></script>
<script src="js/sweetalert.js"></script> -->

<?php
include('body/script.php');
include('body/footer.php');
?>