<?php 
include('body_trainer/trainer_security.php');

if (isset($_POST['update_info'])) {

    $id = mysqli_real_escape_string($connection, $_POST['id']);
    $firstname = mysqli_real_escape_string($connection, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($connection, $_POST['lastname']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $contact = mysqli_real_escape_string($connection, $_POST['contact']);

    $image = mysqli_real_escape_string($connection, $_FILES['image']['name']);

    $allowed_extension = array('gif', 'png', 'jpg', 'jpeg');
    $filename = $_FILES['image']['name'];
    $file_extension = pathinfo($filename, PATHINFO_EXTENSION);

    if (!in_array($file_extension, $allowed_extension)) {
        $_SESSION['message'] = "Invalid File Format" .$filename;
        header('location: portfolio.php');
    } else {

        $query = "UPDATE tbl_customer SET firstname='$firstname', lastname='$lastname', email='$email', contact='$contact', image='$image' WHERE id='$id' ";
        $query_run = mysqli_query($connection, $query);

        if ($query_run) {
            move_uploaded_file($_FILES['image']['tmp_name'], "img/customer_image/" .$_FILES['image']['name']);
            $_SESSION['status'] = "Successfully Updated";
            header('location: portfolio.php');
        } else {
            $_SESSION['message'] = "Sorry Try again!";
            header('location: portfolio.php');
        }
    }
}
?>