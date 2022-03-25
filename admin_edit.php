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
                $query = "SELECT * FROM tbl_admin WHERE ID = '$id' ";
                $query_run = mysqli_query($connection, $query);

                foreach ($query_run as $row) {
            ?>
                    <form action="code.php" method="POST">
                        <input type="hidden" name="ID" value="<?php echo $row['ID'] ?>">
                        <div class="form-group">
                            <label> Username </label>
                            <input type="text" name="username" value="<?php echo $row['username'] ?>" class="form-control" placeholder="Enter Username">
                        </div>
                        <div class="form-group">
                            <label> Firstname </label>
                            <input type="text" name="firstname" value="<?php echo $row['firstname'] ?>" class="form-control" placeholder="Enter Username">
                        </div>
                        <div class="form-group">
                            <label> Lastname </label>
                            <input type="text" name="lastname" value="<?php echo $row['lastname'] ?>" class="form-control" placeholder="Enter Username">
                        </div>
                        <div class="form-group">
                            <label> Contact </label>
                            <input type="number" name="contact" value="<?php echo $row['contact'] ?>" class="form-control" placeholder="Enter Username">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" value="<?php echo $row['email'] ?>" class="form-control" placeholder="Enter Email">
                            <small class="error_email" style="color: red;"></small>
                        </div>
                        <!-- <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" value="<?php echo $row['password'] ?>" class="form-control" placeholder="Enter Email">
                        </div> -->
                        
                        <button type="submit" name="updatebtn" class="btn btn-success">Update</button>
                        <a href="admin.php" class="btn btn-danger">Cancel</a>
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
include('body/footer.php');
?>