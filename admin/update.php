<?php
include('dbcon.php');
$get_id = $_GET['id'];


mysqli_query($conn,"update schedule set status = 'Done', payment_status = 'paid' where id = '$get_id' ")or die(mysqli_error($conn));
header('location:schedule.php'); 
?>