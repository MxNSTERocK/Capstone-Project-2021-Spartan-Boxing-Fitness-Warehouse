<link href="css/googleapis.css" rel="stylesheet" />
<link href="css/mdb.css" rel="stylesheet" />

<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'sendemail/vendor/PHPMailer/src/Exception.php';
require 'sendemail/vendor/PHPMailer/src/PHPMailer.php';
require 'sendemail/vendor/PHPMailer/src/SMTP.php';

session_start();

if(isset($_POST['send'])){
  
    $email = $_POST['emails'];
    $id = $_POST['ID'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

   
    //Load composer's autoloader

    $mail = new PHPMailer(true);                            
    try {
        //Server settings
        /*$mail->isSMTP();                                     
        $mail->Host = 'smtp.gmail.com';                      
        $mail->SMTPAuth = true;                             
        $mail->Username = 'mxnster2020@gmail.com';     
        $mail->Password = 'Newera2020';             
        $mail->SMTPOptions = array(
            'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
            )
        );                         
        $mail->SMTPSecure = 'ssl';                           
        $mail->Port = 465;                                   
        */

        $mail->isSMTP();
        $mail->SMTPSecure = 'tls';                                       
        $mail->Host = 'smtp.gmail.com';                      
        $mail->SMTPAuth = true;                             
        $mail->Username = 'mxnster2020@gmail.com';     
        $mail->Password = 'Newera2020';           

        $mail->SMTPOptions = array(
    'ssl' => array(
    'verify_peer' => false,
    'verify_peer_name' => false,
    'allow_self_signed' => true
     )
   );                         

        $mail->Port = 587;    
        //Send Email
        $mail->setFrom('mxnster2020@gmail.com');
        
        //Recipients
        $mail->addAddress($email);              
        $mail->addReplyTo('mxnster2020@gmail.com');
        
        //Content
        $mail->isHTML(true);                                  
        $mail->Subject = $subject;
        $mail->Body    = $message;

        $mail->send();
		
       $_SESSION['status'] = 'Message has been sent';
	//    $_SESSION['status'] = 'ok';

       //If the email is already sent set the notifications to Yes 
       require 'database/dbconfig.php';
    
       $stat='Yes';
       $status = 0;
       $query = "UPDATE tbl_membership SET notifications='$stat', status='$status'  WHERE ID='$id' ";
       $query_run = mysqli_query($connection, $query);


    } catch (Exception $e) {
	   $_SESSION['message'] = 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
	//    $_SESSION['status'] = 'error';
    }
	
	header("location: email.php?id=".$id."&emails=".$email."");
    
}
?>




