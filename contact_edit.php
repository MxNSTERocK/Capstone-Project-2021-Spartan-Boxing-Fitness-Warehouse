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
            <h6 class="m-0 font-weight-bold text-primary">Edit Membership Information</h6>
        </div>
        <div class="card-body">

            <?php


    if(isset($_POST['contact_update'])) {
    $id = $_POST['id'];
    $query = "SELECT * FROM tbl_covid19 WHERE ID = '$id' ";
    $query_run = mysqli_query($connection,$query);

    foreach($query_run as $row) {    
    ?>

            <form action="code.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $row['ID'] ?>">
                <div class="form-group">
                    <label> Customer </label>
                    <br>
                    <input type="text" name="customer" value="<?php echo $row['customer'] ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label> Address </label>
                    <br>
                    <input type="text" name="address" value="<?php echo $row['address'] ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <br>
                    <input type="email" name="email" value="<?php echo $row['email'] ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label>Temperature</label>
                    <br>
                    <input type="float" name="temperature" value="<?php echo $row['temperature'] ?>" class="form-control">
                </div>

                <button type="submit" name="contact_update" class="btn btn-success">Update</button>
                <a href="index.php" class="btn btn-danger">Cancel</a>
            </form>
            <?php
    }
}
?>

        </div>
    </div>
</div>
</div>

<?php
include('body/script.php');
include('body/footer.php');
?>