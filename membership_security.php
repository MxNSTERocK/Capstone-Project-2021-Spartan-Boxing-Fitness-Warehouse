<?php
session_start();
include('database/dbconfig.php');
if($connection)
{
    // echo "Database Connected";
}
else
{
    header("Location: database/dbconfig.php");
}

if(!$_SESSION['firstname'])

{
    header('Location: login_member.php');
}
?>