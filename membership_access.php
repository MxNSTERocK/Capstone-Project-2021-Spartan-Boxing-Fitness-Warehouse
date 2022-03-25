<?php
include('membership_security.php');

// Membership Registration

if (isset($_POST['reg_user'])) {

    $id = mysqli_real_escape_string($connection, $_POST['id']);
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $firstname = mysqli_real_escape_string($connection, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($connection, $_POST['lastname']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $contact = mysqli_real_escape_string($connection, $_POST['contact']);
    $role = mysqli_real_escape_string($connection, $_POST['level']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);
    $confirm = mysqli_real_escape_string($connection, $_POST['confirm']);
    $image = mysqli_real_escape_string($connection, $_FILES['image']['name']);

    $hashed = md5($password); 

    $allowed_extension = array('gif', 'png', 'jpg', 'jpeg');
    $filename = $_FILES['image']['name'];
    $file_extension = pathinfo($filename, PATHINFO_EXTENSION);

    if (!in_array($file_extension, $allowed_extension)) {
        $_SESSION['message'] = "Invalid File Format";
        header('location: register.php');
    } else {

        $email_query = "SELECT * FROM tbl_admin WHERE email='$email'";
        $email_query_run = mysqli_query($connection, $email_query);

        if (mysqli_num_rows($email_query_run) > 0) {
            $_SESSION['message'] = "Email Already Exist";
            header('location: register.php');
        } else {

            $level="customer";

            if ($password === $confirm) {

                $status=1;

                $query = "INSERT INTO tbl_admin (username,firstname,lastname,email,password,contact,level,status,image) VALUES ('$username','$firstname','$lastname','$email','$hashed','$contact','$level','$status','$image')";
                $query_run = mysqli_query($connection, $query);
            }
            if ($query_run) {
                move_uploaded_file($_FILES['image']['tmp_name'], "img/customer_image/" . $_FILES['image']['name']);
                $_SESSION['status'] = "Successfully Registered";
                header('location: register.php');
            } else {
                $_SESSION['message'] = "Password and Confirm Password Does Not Match";
                header('location: register.php');
            }
        }
    }
}


// Membership Login

if (isset($_POST['login_member'])) {

    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);

    $pattern = "/^\s+|[\s]+$/";
    if (preg_match($pattern, $email) == 0) {
        $email_validation = "Valid";
    } else {
        $email_validation = "Invalid";
    }
    if (preg_match($pattern, $password) == 0) {
        $password_validation = "Valid";
    } else {
        $password_validation = "Invalid";
    }
    if ($email_validation == "Valid" && $password_validation == "Valid") {

        $hashed = md5($password);

        $query = "SELECT * FROM tbl_customer WHERE email='$email' AND password='$hashed' LIMIT 1";
        $query_run = mysqli_query($connection, $query);
        $status = mysqli_fetch_array($query_run);

        if ($status['status'] ==  1) {
            $_SESSION['firstname'] = $email;
            header('location: customer.php');
        } else if ($status['status'] == 0) {
            $_SESSION['message'] = "Your status is deactivated";
            header('location: login_member.php');
        } else {
            $_SESSION['message'] = "Invalid Credential";
            header('location: login_member.php');
        }
    }
}

// Membership Logout

if (isset($_POST['logout_btn'])) {
    session_destroy();
    unset($_SESSION['firstname']);
    header('location: login.php');
}

// Membership Adding

if (isset($_POST['register'])) {

    $filename = $_FILES['proof']['name'];
    $filetmpname = $_FILES['proof']['tmp_name'];
    $folder = 'img/membership_image/';

    move_uploaded_file($filetmpname, $folder . $filename);

    $ID = mysqli_real_escape_string($connection, $_POST['ID']);
    $firstname = mysqli_real_escape_string($connection, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($connection, $_POST['lastname']);
    $address = mysqli_real_escape_string($connection, $_POST['address']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $contact = mysqli_real_escape_string($connection, $_POST['contact']);
    $trainer = mysqli_real_escape_string($connection, $_POST['trainer']);
    $membership_start = mysqli_real_escape_string($connection, $_POST['membership_start']);
    $newEndingDate = date("Y-m-d", strtotime(date("Y-m-d", strtotime($membership_start)) . " + 365 day"));
    $type = mysqli_real_escape_string($connection, $_POST['type']);
    $note = mysqli_real_escape_string($connection, $_POST['note']);

    $email_query = "SELECT * FROM tbl_membership WHERE emails='$email'";
    $email_query_run = mysqli_query($connection, $email_query);

    if (mysqli_num_rows($email_query_run) > 0) {
        $_SESSION['message'] = "You cant register because you already registered!";
        header('location: customer_membership.php');
    } else {

        $query = "INSERT INTO tbl_membership(ID,firstname,lastname,address,emails,contact,membership_start,membership_end, trainer, type, note, image) VALUES 
                ('$ID','$firstname','$lastname','$address','$email','$contact','$membership_start','$newEndingDate','$trainer','$type','$note','$filename')";
        $query_run = mysqli_query($connection, $query);

        if ($query_run) {
            $_SESSION['status'] = "Successfully Registered";
            header('location: customer_membership.php');
        } else {
            $_SESSION['message'] = "Sorry! Please Try again";
            header('location: customer_membership.php');
        }
    }
}

////////////////////////////////

if (isset($_POST['update'])) {

    $id = mysqli_real_escape_string($connection, $_POST['edit_id']);
    $firstname = mysqli_real_escape_string($connection, $_POST['edit_firstname']);
    $lastname = mysqli_real_escape_string($connection, $_POST['edit_lastname']);
    $address = mysqli_real_escape_string($connection, $_POST['edit_address']);
    $email = mysqli_real_escape_string($connection, $_POST['edit_email']);
    $password = mysqli_real_escape_string($connection, $_POST['edit_password']);
    $membership_start = mysqli_real_escape_string($connection, $_POST['edit_membership_start']);
    $membership_end = mysqli_real_escape_string($connection, $_POST['edit_membership_end']);
    $note = mysqli_real_escape_string($connection, $_POST['edit_note']);

    $pattern = "/^\s+|[\s]+$/";
    if (preg_match($pattern, $password) == 0) {
        $password_validation = "Valid";
    } else {
        $password_validation = "Invalid";
    }

    if ($password_validation == "Valid") {

        $hashed = md5($password);
        $stat = 'No';
        $query = "UPDATE tbl_membership SET firstname='$firstname', lastname='$lastname', address='$address', emails='$email', membership_start='$membership_start', membership_end='$membership_end', note='$note', notifications='$stat'  WHERE ID='$id' ";
        $query_run = mysqli_query($connection, $query);

        if ($query_run) {
            $_SESSION['status'] = "Your Data is Updated";
            header('location: membership.php');
        } else {
            $_SESSION['message'] = "Your Data is Not Updated";
            header('location: membership.php');
        }
    } else {
        $_SESSION['message'] = "Error in Validation";
        header('location: membership.php');
    }
}


// Reservation Registration 

if (isset($_POST['submit'])) {

    $check = "SELECT * FROM tbl_reservation WHERE checkin = '$_POST[checkin]' AND checkout = '$_POST[checkout]' AND Event = '$_POST[Event]'";
    $rs = mysqli_query($connection, $check);
    $data = mysqli_fetch_array($rs, MYSQLI_NUM);

    //cancelator for date between esxisting date
    $checkin = date('Y-m-d', strtotime($_POST['checkin']));
    $checkout = date('Y-m-d', strtotime($_POST['checkout']));
    $sqlSelect = "SELECT * FROM tbl_reservation WHERE Event = '$_POST[Event]'";
    $result = mysqli_query($connection, $sqlSelect);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $start = date('Y-m-d', strtotime($row['checkin']));
            $end = date('Y-m-d', strtotime($row['checkout']));
            if (($checkin > $start) and ($checkin < $end)) {
                $remarks = 'in between';
                break;
            } elseif (($checkout > $start) and ($checkout < $end)) {
                $remarks = 'in between';
                break;
            } elseif (($start > $checkin) and ($start < $checkout)) {
                $remarks = 'in between';
                break;
            } elseif (($end > $checkin) and ($end < $checkout)) {
                $remarks = 'in between';
                break;
            }
        }
    }

    //suggesting if other event is available
    if ($_POST['Event'] == 'Boxing') {
        $eventholder = 'Basketball';
    }
    if ($_POST['Event'] == 'Basketball') {
        $eventholder = 'Boxing';
    }
    $availablity = "SELECT * FROM tbl_reservation WHERE Event = '$eventholder'";
    $result1 = mysqli_query($connection, $availablity);
    $status = 'Available';
    if (mysqli_num_rows($result1) > 0) {
        while ($row1 = mysqli_fetch_array($result1)) {
            //get ko yung check in and check out
            $start1 = date('Y-m-d', strtotime($row1['checkin']));
            $end1 = date('Y-m-d', strtotime($row1['checkout']));
            // kapag may nag match means may existing na
            // nasa pagitan pareho ng existing yung sinelect
            if (($checkin > $start1) and ($checkin < $end1)) {
                $status = 'Not Available';
                break;
            }
            if (($checkout > $start1) and ($checkout < $end1)) {
                $status = 'Not Available';
                break;
            }
            if (($checkout == $start1) and ($checkout == $end1)) {
                $status = 'Not Available';
                break;
            }
        }
    }

    if (($data > 1) or ($remarks == 'in between')) {
        $_SESSION['message'] = "Please Choose Another Date.";
        header('location: customer_form.php');
    } else {
        $new = "Not Conform";
        $newUser = "INSERT INTO `tbl_reservation`(`ID`,`firstname`, `lastname`, `mail`, `contact`, `Event`, `checkin`, `checkout`, `status`, `days`) VALUES ('$_POST[ID]','$_POST[firstname]','$_POST[lastname]','$_POST[mail]','$_POST[contact]','$_POST[Event]','$_POST[checkin]','$_POST[checkout]','$new',datediff('$_POST[checkout]','$_POST[checkin]'))";

        if (mysqli_query($connection, $newUser)) {
            $_SESSION['status'] = "Your Booking Application Has been sent!";
            header('location: customer_form.php');
        } else {
            $_SESSION['message'] = "Please Try again!";
            header('location: customer_form.php');
        }
    }
}

//Customer // Update

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
        header('location: person.php');
    } else {

        $query = "UPDATE tbl_customer SET firstname='$firstname', lastname='$lastname', email='$email', contact='$contact', image='$image' WHERE id='$id' ";
        $query_run = mysqli_query($connection, $query);

        if ($query_run) {
            move_uploaded_file($_FILES['image']['tmp_name'], "img/customer_image/" .$_FILES['image']['name']);
            $_SESSION['status'] = "Successfully Updated";
            header('location: person.php');
        } else {
            $_SESSION['message'] = "Sorry Try again!";
            header('location: person.php');
        }
    }
}

if (isset($_POST['force'])) {

    $id = mysqli_real_escape_string($connection, $_POST['id']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);

    $query = "UPDATE tbl_customer SET email='$email' WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['status'] = "Successfully Updated";
        session_destroy();
        unset($_SESSION['firstname']);
        header('location: person.php');
    } else {
        $_SESSION['message'] = "Sorry Try again!";
        header('location: person.php');
    }
}
