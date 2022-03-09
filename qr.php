<?php
$qr_string = '"Name1","Name2","Name3","Name4","Name5","Name6","Name7","I am here to ruin your day, am I not?","24"" (inch) TV"';

$array = str_getcsv($qr_string );

print_r( $array );
?>