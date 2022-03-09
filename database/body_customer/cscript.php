    <!-- Bootstrap core JavaScript-->
    <script src="material/jquery/jquery.min.js"></script>
    <script src="material/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="material/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/material-dashboard.js"></script>

    <!-- Page level plugins -->
    <!-- <script src="material/chart.js/Chart.min.js"></script> -->

    <!-- Page level custom scripts -->
    <!-- <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script> -->


    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <?php
    if (isset($_SESSION['status']) && $_SESSION['status'] != '') 
    {
    ?>
        <script>
        swal({
            title: " <?php echo $_SESSION['status']; ?>",
            icon: "<?php echo $_SESSION['status_code']; ?>",
            button: "Well Done!",
        });
    </script>
    <?php
        unset($_SESSION['status']);
    }
    ?>