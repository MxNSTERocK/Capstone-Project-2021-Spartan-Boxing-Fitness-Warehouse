<?php 
include('security.php');
include('body/header.php');
include('body/navbar.php');
?>

<link href="css/googleapis.css" rel="stylesheet" />
<link href="css/mdb.css" rel="stylesheet" />

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Admin Profile</h6>
        </div>
        <div class="card-body">

            <?php
            if (isset($_POST['edit_btn'])) {
                $id = $_POST['edit_id'];
                $query = "SELECT * FROM tbl_trainer WHERE ID = '$id' ";
                $query_run = mysqli_query($connection, $query);

                foreach ($query_run as $row) {
            ?>
                    <form action="code.php" method="POST">
                        <input type="hidden" name="ID" value="<?php echo $row['ID'] ?>">
                        <div class="form-group">
                            <label> Trainer's name </label>
                            <input type="text" name="trainer" value="<?php echo $row['trainer'] ?>" class="form-control" placeholder="Enter Username">
                        </div>
                        
                        <button type="submit" name="updatebtn" class="btn btn-success">Update</button>
                        <a href="dashboard.php" class="btn btn-danger">Cancel</a>
                    </form>
            <?php
                }
            }
            ?>
        </div>
    </div>
</div>
</div>

    <script src="material/jquery/jquery.min.js"></script>
    <script src="material/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="material/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/material-dashboard.js"></script>

<?php 
include('body/script.php');
include('body/footer.php');
?>