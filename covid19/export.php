<?php
// session_start();
// $server = "localhost";
// $username="root";
// $password="";
// $dbname="db_gymreservation";

// $conn = new mysqli($server,$username,$password,$dbname);

// if($conn->connect_error){
//     die("Connection failed" .$conn->connect_error);
// }
include('../security.php');

$filename = 'ContactTracing-'.date('Y-m-d').'.csv';

$query = "SELECT * FROM tbl_covid19";
$result = mysqli_query($connection,$query);

$array = array();

$file = fopen($filename,"w");
$array = array("ID","CUSTOMER NAME","EMAIL","CONTACT NUMBER","TEMPERATURE","TIME IN ","TIME OUT","LOG DATE");
fputcsv($file,$array);

while($row = mysqli_fetch_array($result)){
    $ID =$row['ID'];
    $CUSTOMER =$row['customer'];
    $EMAIL = $row['email'];
    $NUMBER = $row['number'];
    $TEMPERATURE = $row['temperature'];
    $TIMEIN =$row['timein'];
    $TIMEOUT =$row['timeout'];
    $LOGDATE =$row['logdate'];

    $array = array($ID,$CUSTOMER,$EMAIL,$TEMPERATURE,$TIMEIN,$TIMEOUT,$LOGDATE);
    fputcsv($file,$array);
}
fclose($file);

header("Content-Description: File Transfer");
header("Content-Disposition: Attachment; filename=$filename");
header("Content-type: application/csv;");
readfile($filename);
unlink($filename);
exit();

?>