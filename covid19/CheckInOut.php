<?php
include('../security.php');
include('../generate/libs/phpqrcode/qrlib.php');

function getUsernameFromEmail($email)
{
	$find = '@';
	$pos = strpos($email, $find);
	$username = substr($email, 0, $pos);
	return $username;
}

    if($connection->connect_error){
        die("Connection failed" .$connection->connect_error);
    }

	$code=base64_decode($_GET['covid']);
	list($customer,$email,$address,$number)=explode(',',$code);
	
	if (isset($_GET['covid'])) {
      if ($customer!="" and $email!="" and $address!="" and $number!="")
	  {

		// Start 
		$tempDir = 'temp/';
		$filename = getUsernameFromEmail($email);
		$temp =  $number;
		$codeContents = ''.$customer.',' . $email . ',' . urlencode($address) . ',' . urlencode($temp);
		QRcode::png($codeContents, $tempDir . '' . $filename . '.png', QR_ECLEVEL_L, 5);

		$array = str_getcsv($codeContents );
		print_r( $array );
		// End
		
		//$voice = new com("SAPI.SpVoice");
		$voice = new COM("SAPI.SpVoice");
		
		$text = $_POST['text'];
		$message = "Hi there!, Your QR code is successfully added! Thank you! ";
		//$voice->Speak($message);
		date_default_timezone_set('Asia/manila');
		$date = date('Y-m-d');
		$time = date('H:i:s');
	
		$sql = "SELECT * from tbl_covid19 WHERE customer = '$customer' AND logdate='$date' AND STATUS='0'";
		$query=$connection->query($sql);

		if ($query->num_rows>0){
			$sql = "UPDATE tbl_covid19 SET TIMEOUT=NOW(), STATUS='1' WHERE customer='$customer' AND logdate='$date'";
			$query=$connection->query($sql); 
			$voice = new COM("SAPI.SpVoice");
			$_SESSION['success'] = 'SUCCESSFULLY OUT';
			$voice->speak($_SESSION['success']);
		}
		else {
			$sql = "INSERT INTO tbl_covid19 (customer,email, address, timein, logdate, status) VALUES ('$customer','$email','$address ','$time', '$date', '0')";
			if ($connection->query($sql) ===TRUE){
				$voice->speak($message);
				$_SESSION['success'] = 'SUCCESSFULLY ADDED';
			}
			else {
				$_SESSION['error'] = $connection -> error;
			} 
		}
	}
	else { 
		$voice = new COM("SAPI.SpVoice");
		$_SESSION['error'] = 'QR Code is Invalid! Please try it again!';
		$voice->speak($_SESSION['error']);
	}

     }
	 else
	 {
		$voice = new COM("SAPI.SpVoice");
		$voice->speak($_SESSION['error']);
		$_SESSION['error'] = 'QR Code is Invalid! Please try it again';
	 } 

		header('location: ../index.php');
	$connection->close();
	
	?>