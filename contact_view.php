<?php
include('security.php');

include('body/header.php');
include('body/navbar.php');
?>

<link href="css/googleapis.css" rel="stylesheet" />
<link href="css/mdb.css" rel="stylesheet" />

<?php
if (isset($_POST['contact_view'])) {
    $id = $_POST['id'];
    
    $query = "SELECT * FROM tbl_covid19 WHERE ID = '$id' ";
    $query_run = mysqli_query($connection, $query);

    foreach ($query_run as $row) {
?>

<div class="container-fluid">
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="m-0 font-weight-bold text-primary">Contact Tracing View</h4>
    </div>
    
    <div class="card-body">

            <div class="form-group">
                <label> ID: </label> &nbsp; <?php echo $row['ID'];?>
            </div>
            <div class="form-group">
                <label> Customer: </label> &nbsp; <?php echo $row['customer'];?> 
            </div>
            <div class="form-group">
                <label> Address: </label> &nbsp; <?php echo $row['address'];?> 
            </div>
            <div class="form-group">
                <label> Email: </label> &nbsp; <?php echo $row['email'];?> 
            </div>
            <div class="form-group">
                <label> Temperature: </label> &nbsp; <?php echo $row['temperature'];?> 
            </div>
            <div class="form-group">
                <label> Contact number: </label> &nbsp; <?php echo $row['number'];?> 
            </div>
            <div class="form-group">
                <label> Timein: </label> &nbsp; <?php echo $row['timein'];?> 
            </div>
            <div class="form-group">
                <label> Timeout: </label> &nbsp; <?php echo $row['timeout'];?> 
            </div>
            <div class="form-group">
                <label> Logdate: </label> &nbsp; <?php echo $row['logdate'];?> 
            </div>

            <hr>
            <a href="index.php" class="btn btn-danger">Cancel</a>
            <?php
        }
    }
            ?>
    </div>

<?php
include('body/script.php');
include('body/footer.php')
?>