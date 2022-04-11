<?php
error_reporting(1);
include('security.php');

// for admin adding 

if (isset($_POST['registerbtn'])) {

    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);
    $confirmpassword = mysqli_real_escape_string($connection, $_POST['confirmpassword']);
    $status = mysqli_real_escape_string($connection, $_POST['status']);
    $firstname = mysqli_real_escape_string($connection, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($connection, $_POST['lastname']);
    $contact = mysqli_real_escape_string($connection, $_POST['contact']);
    $level = mysqli_real_escape_string($connection, $_POST['level']);
    $image = mysqli_real_escape_string($connection, $_FILES['image']['name']);

    $hashed = md5($password);
    $status = 1;

    $allowed_extension = array('gif', 'png', 'jpg', 'jpeg');
    $filename = $_FILES['image']['name'];
    $file_extension = pathinfo($filename, PATHINFO_EXTENSION);

    if (!in_array($file_extension, $allowed_extension)) {
        $_SESSION['message'] = "Invalid File Format";
        header('location: admin.php');
    } else {

        $email_query = "SELECT * FROM tbl_admin WHERE email='$email'";
        $email_query_run = mysqli_query($connection, $email_query);

        if (mysqli_num_rows($email_query_run) > 0) {
            $_SESSION['message'] = "Email Already Exist";
            header('location: admin.php');
        } else {
            
            if ($password === $confirmpassword) {
                $query = "INSERT INTO tbl_admin(username,email,password,status,firstname,lastname,contact,image,level) VALUES ('$username','$email','$hashed','$status','$firstname','$lastname','$contact','$image','$level')";
                $query_run = mysqli_query($connection, $query);
            }
            if ($query_run) {
                move_uploaded_file($_FILES['image']['tmp_name'], "img/customer_image/" . $_FILES['image']['name']);
                $_SESSION['status'] = "Admin Profile Added";
                header('location: admin.php');
            } else {
                $_SESSION['message'] = "Password and Confirm Password Does Not Match";
                header('location: admin.php');
            }
        }
    }
}


//for admin update

if (isset($_POST['updatebtn'])) {

    $id = mysqli_real_escape_string($connection, $_POST['ID']);
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $firstname = mysqli_real_escape_string($connection, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($connection, $_POST['lastname']);
    $contact = mysqli_real_escape_string($connection, $_POST['contact']);

    $pattern = "/^\s+|[\s]+$/";
    if (preg_match($pattern, $username) == 0) {
        $username_validation = "Valid";
    } else {
        $username_validation = "Invalid";
    }
    if (preg_match($pattern, $email) == 0) {
        $email_validation = "Valid";
    } else {
        $email_validation = "Invalid";
    }
    if (preg_match($pattern, $email) == 0) {
        $password_validation = "Valid";
    } else {
        $password_validation = "Invalid";
    }

    if ($username_validation == "Valid" && $email_validation == "Valid" && $password_validation == "Valid") {

        $query = "UPDATE tbl_admin SET username='$username', email='$email' ,firstname='$firstname' ,lastname='$lastname', contact='$contact' WHERE ID='$id' ";
        $query_run = mysqli_query($connection, $query);

        if ($query_run) { // query condition
            $_SESSION['status'] = "Your Data is Updated";
            header('location: admin.php');
        } else {
            $_SESSION['message'] = "Your Data is Not Updated";
            header('location: admin.php');
        }
    } else { //validation
        $_SESSION['message'] = "Error in Validation";
        header('location: admin.php');
    }
}

// FOR LOGIN ADMINISTRATOR / TRAINER / USER

if (isset($_POST['login_btn'])) {

    $firstname = mysqli_real_escape_string($connection, $_POST['firstname']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);
    $hashed = md5($password);


    $login = mysqli_query($connection, "SELECT * FROM tbl_admin WHERE email='$email' AND password='$hashed' AND status = 1");
    $cek = mysqli_num_rows($login);

    if ($cek > 0) {

        $data = mysqli_fetch_assoc($login);

        if ($data['level'] == "admin") {
            $_SESSION['username'] = $email;
            // $_SESSION['level'] = "admin";
            header("location:   dashboard.php");
        } 
        else if ($data['level'] == "customer") {
            $_SESSION['firstname'] = $email;
            // $_SESSION['level'] = "customer";
            header("location:   customer.php");
        }
        // else if($data['level']=="trainer"){
        // 	$_SESSION['id'] = $email;
        // 	$_SESSION['level'] = "trainer";
        // 	header("location:   trainer_dashboard.php");
        // }
        else {
            // $_SESSION['error'] = "Your status is inactive";
            // header("location:login.php");
        }
    } else {
        $_SESSION['error'] = "Invalid Credential";
        header("location:login.php");
    }
}

// ////////////////////////////

// For admin Logout

if (isset($_POST['admin_logout'])) {
    // session_destroy();
    unset($_SESSION['username']);
    // session_unset();
    header('location: login.php');
}

//////////////////// End of Administrator //////////////////////

// Adding Membership
// Working

if (isset($_POST['register'])) {

    $firstname = mysqli_real_escape_string($connection, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($connection, $_POST['lastname']);
    $address = mysqli_real_escape_string($connection, $_POST['address']);
    $email = mysqli_real_escape_string($connection, $_POST['emails']);
    $contact = mysqli_real_escape_string($connection, $_POST['contact']);
    $membership_start = mysqli_real_escape_string($connection, $_POST['membership_start']);
    $newEndingDate = date("Y-m-d", strtotime(date("Y-m-d", strtotime($membership_start)) . " + 365 day"));
    // $membership_end = mysqli_real_escape_string($connection, $_POST['membership_end']);
    $type = mysqli_real_escape_string($connection, $_POST['type']);
    $note = mysqli_real_escape_string($connection, $_POST['note']);
    $image = mysqli_real_escape_string($connection, $_FILES['image']['name']);

    $allowed_extension = array('gif', 'png', 'jpg', 'jpeg');
    $filename = $_FILES['image']['name'];
    $file_extension = pathinfo($filename, PATHINFO_EXTENSION);

    $email_query = "SELECT * FROM tbl_membership WHERE emails='$email'";
    $email_query_run = mysqli_query($connection, $email_query);

    if (mysqli_num_rows($email_query_run) > 0) {
        $_SESSION['message'] = "Email Already Exist";
        header('location: membership.php');
    } else {
        if (!in_array($file_extension, $allowed_extension)) {
            $_SESSION['message'] = "Invalid File Format";
            header('location: membership.php');
        } else {
            $query = "INSERT INTO tbl_membership(firstname,lastname,address,emails,membership_start,membership_end,note,contact, type, image) VALUES ('$firstname','$lastname','$address','$email','$membership_start','$newEndingDate','$note','$contact','$type','$image')";
            $query_run = mysqli_query($connection, $query);

            if ($query_run) {
                move_uploaded_file($_FILES['image']['tmp_name'], "img/membership_image/" . $_FILES['image']['name']);
                $_SESSION['status'] = "Successfully Registered";
                header('location: membership.php');
            } else {
                $_SESSION['message'] = "Registered Error";
                header('location: membership.php');
            }
        }
    }
}



//////////////////////////////////\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

// For membership Update

if (isset($_POST['update'])) {

    $id = mysqli_real_escape_string($connection, $_POST['edit_id']);
    $firstname = mysqli_real_escape_string($connection, $_POST['edit_firstname']);
    $lastname = mysqli_real_escape_string($connection, $_POST['edit_lastname']);
    $address = mysqli_real_escape_string($connection, $_POST['edit_address']);
    $email = mysqli_real_escape_string($connection, $_POST['edit_email']);
    $password = mysqli_real_escape_string($connection, $_POST['edit_password']);
    $membership_start = mysqli_real_escape_string($connection, $_POST['edit_membership_start']);
    $newEndingDate = date("Y-m-d", strtotime(date("Y-m-d", strtotime($membership_start)) . " + 365 day"));
    $type = mysqli_real_escape_string($connection, $_POST['type']);
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
        $status = 1;
        $query = "UPDATE tbl_membership SET firstname='$firstname', lastname='$lastname', address='$address', emails='$email', membership_start='$membership_start', membership_end='$newEndingDate', note='$note', type='$type', status = '$status', notifications='$stat'  WHERE ID='$id' ";
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

////////////////////////// End of Membership ////////////////////

// Adding Event

if (isset($_POST['addevent'])) {

    $filename = $_FILES['image']['name'];
    $filetmpname = $_FILES['image']['tmp_name'];
    $folder = 'img/event_image/';

    move_uploaded_file($filetmpname, $folder . $filename);

    $id = mysqli_real_escape_string($connection, $_POST['ID']);
    $event = mysqli_real_escape_string($connection, $_POST['event']);
    $description = mysqli_real_escape_string($connection, $_POST['description']);

    $allowed_extension = array('gif', 'png', 'jpg', 'jpeg');
    $filename = $_FILES['image']['name'];
    $file_extension = pathinfo($filename, PATHINFO_EXTENSION);

    if (!in_array($file_extension, $allowed_extension)) {
        $_SESSION['message'] = "Invalid File Format" . $filename;
        header('location: reservation.php');
    } else {

        $email_query = "SELECT * FROM tbl_event WHERE event='$event'";
        $email_query_run = mysqli_query($connection, $email_query);

        if (mysqli_num_rows($email_query_run) > 0) {
            $_SESSION['status'] = "Event already exist";
            header('location: reservation.php');
        } else {

            $query = "INSERT INTO tbl_event (event,description,image) VALUES ('$event','$description','$filename')";
            $query_run = mysqli_query($connection, $query);

            if ($query_run) {
                $_SESSION['status'] = "Event added";
                header('location: reservation.php');
            } else {
                $_SESSION['message'] = "Event not added";
                header('location: reservation.php');
            }
        }
    }
}


// Adding Event

if (isset($_POST['+event'])) {

    $filename = $_FILES['image']['name'];
    $filetmpname = $_FILES['image']['tmp_name'];
    $folder = 'img/event_image/';

    move_uploaded_file($filetmpname, $folder . $filename);

    $id = mysqli_real_escape_string($connection, $_POST['ID']);
    $event = mysqli_real_escape_string($connection, $_POST['event']);
    $description = mysqli_real_escape_string($connection, $_POST['description']);

    $allowed_extension = array('gif', 'png', 'jpg', 'jpeg');
    $filename = $_FILES['image']['name'];
    $file_extension = pathinfo($filename, PATHINFO_EXTENSION);

    if (!in_array($file_extension, $allowed_extension)) {
        $_SESSION['message'] = "Invalid File Format" . $filename;
        header('location: reservation.php');
    } else {

        $email_query = "SELECT * FROM tbl_event WHERE event='$event'";
        $email_query_run = mysqli_query($connection, $email_query);

        if (mysqli_num_rows($email_query_run) > 0) {
            $_SESSION['status'] = "Event already exist";
            header('location: reservation.php');
        } else {

            $query = "INSERT INTO tbl_event (event,description,image) VALUES ('$event','$description','$filename')";
            $query_run = mysqli_query($connection, $query);

            if ($query_run) {
                $_SESSION['status'] = "Event added";
                header('location: reservation.php');
            } else {
                $_SESSION['message'] = "Event not added";
                header('location: reservation.php');
            }
        }
    }
}


// Update Event

if (isset($_POST['event_update'])) {

    $id = mysqli_real_escape_string($connection, $_POST['ID']);
    $event = mysqli_real_escape_string($connection, $_POST['event']);
    $description = mysqli_real_escape_string($connection, $_POST['description']);
    $status = mysqli_real_escape_string($connection, $_POST['status']);
    $image = mysqli_real_escape_string($connection, $_FILES['image']['name']);

    $allowed_extension = array('gif', 'png', 'jpg', 'jpeg');
    $filename = $_FILES['image']['name'];
    $file_extension = pathinfo($filename, PATHINFO_EXTENSION);

    if (!in_array($file_extension, $allowed_extension)) {
        $_SESSION['message'] = "Invalid File Format" . $filename;
        header('location: reservation.php');
    } else {

        $query = "UPDATE tbl_event SET event='$event', description = '$description', image = '$image' WHERE ID='$id' ";
        $query_run = mysqli_query($connection, $query);

        if ($query_run) {
            move_uploaded_file($_FILES['image']['tmp_name'], "img/event_image/" . $_FILES['image']['name']);
            $_SESSION['status'] = "Event Succesfully Updated";
            header('location: reservation.php');
        } else {
            $_SESSION['message'] = "Sorry! Event is Not Updated";
            header('location: reservation.php');
        }
    }
}


// Reservation

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
        header('location: reservation.php');
    } else {
        $new = "Not Conform";
        $newUser = "INSERT INTO `tbl_reservation`(`firstname`, `lastname`, `mail`, `contact`, `Event`, `checkin`, `checkout`, `status`, `days`) VALUES ('$_POST[firstname]','$_POST[lastname]','$_POST[mail]','$_POST[contact]','$_POST[Event]','$_POST[checkin]','$_POST[checkout]','$new',datediff('$_POST[checkout]','$_POST[checkin]'))";

        if (mysqli_query($connection, $newUser)) {
            $_SESSION['status'] = "Your Booking Application Has been sent!";
            header('location: reservation.php');
        } else {
            $_SESSION['message'] = "Please Try again!";
            header('location: reservation.php');
        }
    }
}

/////////////////////////// End of Reservation //////////////////////

// Contact Viewing Data

if (isset($_POST['contact_update'])) {

    // $id = $_POST['id'];
    $id = mysqli_real_escape_string($connection, $_POST['id']);
    // $customer = $_POST['customer'];
    $customer = mysqli_real_escape_string($connection, $_POST['customer']);
    // $address = $_POST['address'];
    $address = mysqli_real_escape_string($connection, $_POST['address']);
    // $email = $_POST['email'];
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    // $temperature = $_POST['temperature'];
    $temperature = mysqli_real_escape_string($connection, $_POST['temperature']);

    $query = "UPDATE tbl_covid19 SET customer='$customer', address='$address', email='$email', temperature='$temperature' WHERE ID='$id' ";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['status'] = "Your Data is Updated";
        header('location: index.php');
    } else {
        $_SESSION['message'] = "Your Data is Not Updated";
        header('location: index.php');
    }
}

//////////////////////////// End Of Contact Tracing /////////////////////////

// Equipment

if (isset($_POST['add_equipment'])) {

    $id = mysqli_real_escape_string($connection, $_POST['ID']);
    $equipment = mysqli_real_escape_string($connection, $_POST['equipment']);
    $pieces = mysqli_real_escape_string($connection, $_POST['pieces']);
    $data_added = mysqli_real_escape_string($connection, $_POST['data_added']);
    $status = mysqli_real_escape_string($connection, $_POST['status']);
    $note = mysqli_real_escape_string($connection, $_POST['note']);

    $query = "INSERT INTO tbl_equipment (equipment,pieces,data_added,status,note) VALUES ('$equipment','$pieces','$data_added','$status','$note')";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['status'] = "Equipment Added";
        header('location: equipment.php');
    } else {
        $_SESSION['message'] = "Equipment Not Added";
        header('location: equipment.php');
    }
}

// Equipment Update

if (isset($_POST['equipment_update'])) {
    // $id = $_POST['ID'];
    $id = mysqli_real_escape_string($connection, $_POST['ID']);
    // $status = $_POST['status'];
    $status = mysqli_real_escape_string($connection, $_POST['status']);

    $query = "UPDATE tbl_equipment SET status='$status' WHERE ID='$id' ";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['status'] = "Equipment Updated Successfully";
        header('location: equipment.php');
    } else {
        $_SESSION['message'] = "Sorry Equipment Not Updated Successfully";
        header('location: equipment.php');
    }
}

//////////////////////// End of Equipment //////////////////////////////

//////////////////////// Add Trainer  //////////////////////////////

if (isset($_POST['add_trainer'])) {

    $id = mysqli_real_escape_string($connection, $_POST['ID']);
    $trainer = mysqli_real_escape_string($connection, $_POST['trainer']);

    $query = "INSERT INTO tbl_trainer (trainer) VALUES ('$trainer')";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['status'] = "Successfully Added";
        header('location: dashboard.php');
    } else {
        $_SESSION['message'] = "Sorry Try Again!";
        header('location: dashboard.php');
    }
}


//////////////////////// Update Trainer //////////////////////////////

if (isset($_POST['update_tariner'])) {

    $id = mysqli_real_escape_string($connection, $_POST['ID']);
    $trainer = mysqli_real_escape_string($connection, $_POST['trainer']);

    $query = "UPDATE tbl_trainer SET trainer='$trainer' WHERE ID='$id' ";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['status'] = "Updated Successfully";
        header('location: dashboard.php');
    } else {
        $_SESSION['message'] = "Sorry Not Updated Successfully";
        header('location: dashboard.php');
    }
}

if (isset($_post['archive'])) {
    $query = mysqli_query($conn, "SELECT * FROM `tbl_admin`");
    $date = date("Y-m-d");
    while($fetch = mysqli_fetch_array($query)){
        if($fecth === 0){
            mysqli_query($conn, "INSERT INTO `tbl_archive` VALUES('', '$fetch[username]', '$fetch[email]', '$fetch[password]', '$fetch[level]', '$fetch[status]','$fetch[contact]' ,'$fetch[lastname]' ,'$fetch[firstname]', '$fetch[image]','$fetch[created]')") or die(mysqli_error($connection));
            mysqli_query($conn, "DELETE FROM `tbl_admin` WHERE `ID` = '$fetch[ID]'") or die(mysqli_error($connection));
        }
    }
}

// profile

if (isset($_POST['profile_edit'])) {

    $id = mysqli_real_escape_string($connection, $_POST['ID']);
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
        header('location: profile.php');
    } else {

        $query = "UPDATE tbl_admin SET firstname='$firstname', lastname='$lastname', email='$email', contact='$contact', image='$image' WHERE ID='$id' ";
        $query_run = mysqli_query($connection, $query);

        if ($query_run) {
            move_uploaded_file($_FILES['image']['tmp_name'], "img/customer_image/" .$_FILES['image']['name']);
            $_SESSION['status'] = "Successfully Updated";
            header('location: profile.php');
        } else {
            $_SESSION['message'] = "Sorry Try again!";
            header('location: profile.php');
        }
    }
}

?>