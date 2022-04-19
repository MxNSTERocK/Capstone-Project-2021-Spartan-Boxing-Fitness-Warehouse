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
            <h5 class="modal-title" id="exampleModalLabel" style="color: white;">Update Event</h5>
        </div>
        <div class="card-body">

            <?php
            if (isset($_POST['upevent'])) {
                $id = $_POST['edit_id'];
                $query = "SELECT * FROM tbl_event WHERE ID = '$id' ";
                $query_run = mysqli_query($connection, $query);

                foreach ($query_run as $row) {
            ?>
                    <form action="code.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="ID" value="<?php echo $row['ID'] ?>">
                        <div class="form-group">
                            <label> Event </label>
                            <input type="text" name="event" value="<?php echo $row['event'] ?>" class="form-control" placeholder="Enter Username">
                        </div>
                        <div class="form-group">
                            <label> Description </label>
                            <input type="text" name="description" value="<?php echo $row['description'] ?>" class="form-control" placeholder="Enter Username">
                        </div>
                        <div class="form-group">
                            <label> Image </label>
                            
                            <input type="file" name="image" value="<?php echo $row['image'] ?>" class="form-control" placeholder="Enter Username">
                        </div>
                                                
                        <button type="submit" name="event_update" class="btn btn-success">Update</button>
                        <a href="reservation.php" class="btn btn-danger">Cancel</a>
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