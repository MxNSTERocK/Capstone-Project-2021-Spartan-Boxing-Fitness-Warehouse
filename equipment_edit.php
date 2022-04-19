<?php
include('security.php');

include('body/header.php');
include('body/navbar.php');
?>

<link href="css/googleapis.css" rel="stylesheet" />
<link href="css/mdb.css" rel="stylesheet" />


<?php
$sql = "SELECT * FROM tbl_equipment order by ID asc";
$result = mysqli_query($connection, $sql) or die("Bad SQL: $sql");

$opt = "<select class='form-control' name='category'>
        <option disabled selected>Select Category</option>";
while ($row = mysqli_fetch_assoc($result)) {
  $opt .= "<option value='" . $row['ID'] . "'>" . $row['equipment'] . "</option>";
}

$opt .= "</select>";

$query = 'SELECT * FROM tbl_equipment WHERE ID =' . $_GET['id'];
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
while ($row = mysqli_fetch_array($result)) {
  $zz = $row['ID'];
  $zzz = $row['equipment'];
  $A = $row['pieces'];
  $D = $row['data_added'];
  $st = $row['status'];
}
$id = $_GET['id'];
?>

<style>
  .col-sm-3 {
    color: black;
  }
</style>

<center>
  <div class="container-fluid">
    <div class="card shadow mb-4">
      <div class="card-header py-2 bg-dark">
      <h4 class="m-2 font-weight-bold text-light">Edit Inventory for : <?php echo $zzz ?></h4>
      </div>

      <div class="card-body">
        <form role="form" method="post" action="code.php">
          <input type="hidden" name="ID" value="<?php echo $zz; ?>" />
          <div class="form-group row text-left text-warning">
            <div class="col-sm-3" style="padding-top: 5px;">
              Equipment:
            </div>
            <div class="col-sm-9">
              <input class="form-control" value="<?php echo $zzz; ?>" readonly>
            </div>
          </div>
          <div class="form-group row text-left text-warning">
            <div class="col-sm-3" style="padding-top: 5px;">
              Quantity:
            </div>
            <div class="col-sm-9">
              <input class="form-control" value="<?php echo $A; ?>" readonly>
            </div>
          </div>
          <div class="form-group row text-left text-warning">
            <div class="col-sm-3" style="padding-top: 5px;">
              Date:
            </div>
            <div class="col-sm-9">
              <input class="form-control" placeholder="Quantity" name="data_added" value="<?php echo $D; ?>" readonly required>
            </div>
          </div>
          <div class="form-group row text-left text-warning">
            <div class="col-sm-3" style="padding-top: 5px;">
              Status:
            </div>
            <div class="col-sm-9">
              <select name="status" class="form-control" value="<?php echo $st; ?>" required>>
                <option selected>Choose...</option>
                <option value="Available">Available</option>
                <option value="Unavailable">Unavailable</option>
              </select>
            </div>
          </div>
          <hr>
          <a type="button" class="btn btn-primary bg-gradient-primary" href="equipment.php?action=edit & id='<?php echo $zzz; ?>'"><i class="fas fa-fw fa-flip-horizontal fa-share"></i> Back</a>
          <button type="submit" class="btn btn-primary" name="equipment_update"><i class="fa fa-edit fa-fw"></i>Update</button>
        </form>
      </div>
    </div>


    </div>
  </div>
</center>

<?php
include('body/script.php');
include('body/footer.php');
?>