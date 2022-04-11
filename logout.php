<?php
include('security.php');

if (isset($_POST['admin_logout'])) {
    // session_destroy();
    unset($_SESSION['username']);
    header('location: login.php');
}
?> 