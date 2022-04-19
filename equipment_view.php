<?php
include('security.php');

include('body/header.php');
include('body/navbar.php');

$query2 = 'SELECT * FROM tbl_equipment WHERE ID =' . $_GET['ID'] . ' limit 1';
$result2 = mysqli_query($connection, $query2) or die(mysqli_error($connection));
?>

<link href="css/googleapis.css" rel="stylesheet" />
<link href="css/mdb.css" rel="stylesheet" />

<div class="container">
  <div class="card shadow mb-4">
    <div class="card-header py-2 bg-dark">
      <h4 class="m-2 font-weight-bold text-light">Inventory for :
        <?php while ($row = mysqli_fetch_assoc($result2)) {
          echo $row['equipment'];
        } ?></h4>
    </div>
    <div class="card-header py-3">
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Product Code</th>
              <th>Name</th>
              <th>Quantity</th>
              <th>On Hand</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>

            <?php
            $query = 'SELECT * FROM tbl_equipment WHERE ID =' . $_GET['ID'];
            $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
            while ($row = mysqli_fetch_assoc($result)) {
              echo '<tr>';
              echo '<td>' . $row['ID'] . '</td>';
              echo '<td>' . $row['equipment'] . '</td>';
              echo '<td>' . $row['pieces'] . '</td>';
              echo '<td>' . $row['data_added'] . '</td>';
              echo '<td align="right">
                      <center><a type="button" class="btn btn-primary bg-gradient-primary" href="equipment_edit.php?action=edit & id=' . $row['ID'] . '"><i class="fas fa-fw fa-edit"></i></a> </center>
                          </div></td>';
              echo '</tr> ';
            }
            ?>

          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</div>


<?php
include('body/footer.php');
include('body/script.php');
?>