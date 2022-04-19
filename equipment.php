<?php
include('security.php');

include('body/header.php');
include('body/navbar.php');
?>

<link href="css/googleapis.css" rel="stylesheet" />
<link href="css/mdb.css" rel="stylesheet" />

<link rel="stylesheet" href="css/datatable.css">

<script src="material/jquery/jquery.min.js"></script>
<script src="material/datatables/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>

<div class="container">
    <h4 class="m-2 font-weight-bold text-primary"></h4>
    <div class="card shadow mb-4">
        <div class="modal-header bg-dark">
            <h5 class="modal-title" id="exampleModalLabel" style="color: white;">Inventory Form</h5>
        </div>
        <div class="container">
            <br>
            <form action="code.php" method="POST" class="needs-validation" novalidate>
                <div class="row">
                    <div class="col-md-4 col-xs-6">
                        <label for="validationCustom01" class="form-label">Equipment</label>
                        <input type="text" class="form-control" id="validationCustom01" name="equipment" placeholder="Equipment" required>
                    </div>
                    <div class="col-md-4 col-xs-6">
                        <label for="validationCustom02" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="validationCustom02" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" name="pieces" placeholder="Quantity" required>
                    </div>
                    <div class="col-md-4 col-xs-6">
                        <label for="validationCustom03" class="form-label">Date</label>
                        <input type="date" class="form-control" id="validationCustom03" name="data_added" placeholder="Date" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-xs-12">
                        <label for="validationCustom04" class="form-label">Note</label>
                        <textarea class="form-control" id="validationCustom04" rows="3" name="note" placeholder="Place put note here" required></textarea>
                    </div>
                </div>
                <br>
                <button type="submit" name="add_equipment" class="btn btn-success" style="float: right;">Save</button>

            </form>
        </div>
    </div>
</div>

<div class="container">
    <div class="card shadow mb-4">
    <div class="modal-header bg-dark">
            <h5 class="modal-title" id="exampleModalLabel" style="color: white;">Inventory</h5>
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
                            <th>Staus</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $query = 'SELECT * FROM tbl_equipment GROUP BY ID';
                        $result = mysqli_query($connection, $query) or die(mysqli_error($connection));

                        while ($row = mysqli_fetch_assoc($result)) {

                            echo '<tr>';
                            echo '<td>' . $row['ID'] . '</td>';
                            echo '<td>' . $row['equipment'] . '</td>';
                            echo '<td>' . $row['pieces'] . '</td>';
                            echo '<td>' . $row['data_added'] . '</td>';
                            echo '<td>' . $row['status'] . '</td>';
                            echo '<td align="right">
                              <center> <a type="button" class="btn btn-primary bg-gradient-primary" href="equipment_view.php?action=edit & ID=' . $row['ID'] . '"><i class="fas fa-fw fa-th-list"></i></a></center>
                          </div> </td>';
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

<script src="material/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="material/jquery-easing/jquery.easing.min.js"></script>
<script src="js/material-dashboard.js"></script>

<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>

<?php
include('body/footer.php');
?>