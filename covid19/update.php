<?php
include('../security.php');

include('../body/header.php');
include('../body/navbar.php');
?>

<link href="../css/material-dashboard.css" rel="stylesheet"> 


<?php
if (isset($_POST['view'])) {
    $id = $_POST['view_id'];
    
    $query = "SELECT * FROM tbl_covid19 WHERE ID = '$id' ";
    $query_run = mysqli_query($connection, $query);

    foreach ($query_run as $row) {
?>

<div class="container">
    <div class="row">
        <form action="CheckInOut.php" method="post" class="form-horizontal" style="border-radius: 5px;padding:10px;background:#fff;" id="divvideo">
            <i class="glyphicon glyphicon-qrcode"></i> <label>SCAN QR CODE</label>
            <p id="time"></p>
            <input type="text" name="text" id="text" placeholder="scan qrcode" class="form-control" autofocus>

            <input type="text" name="address" value="<?php echo $row['address'] ?>" class="form-control">
            <input type="number" name="temperature" value="<?php echo $row['temperature'] ?>" class="form-control">
            <input type="number" name="contact" value="<?php echo $row['contact'] ?>" class="form-control">
        </form>
    </div>
</div>

<?php
    }
}
?>

<?php
include('../body/script.php');
include('../body/footer.php');
?>