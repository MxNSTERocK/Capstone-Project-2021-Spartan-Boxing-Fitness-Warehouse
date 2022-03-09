<div>
<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; <?= Title?></span>
        </div>
    </div>
    </div>
</footer>
<!-- End of Footer -->
</div>
<!-- End of Content Wrapper -->

</body>

<script src="./js/alertify.js"></script>

<script>
    <?php if(isset($_SESSION['status'])) {?>
    alertify.set('notifier','position', 'top-right');
    alertify.success("<?= $_SESSION['status'] ?>");
    <?php 
    unset($_SESSION['status']);
    }
    ?>
        <?php if(isset($_SESSION['message'])) {?>
    alertify.set('notifier','position', 'top-right');
    alertify.error("<?= $_SESSION['message'] ?>");
    <?php 
    unset($_SESSION['message']);
    }
    ?>
</script>

</html>
