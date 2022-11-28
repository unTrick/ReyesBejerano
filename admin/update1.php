<?php
include('dbcon.php');
$get_id = $_GET['id'];


mysqli_query($conn,"update schedule set status = 'Done' where id = '$get_id' ")or die(mysqli_error($conn));
header('location:sched_today.php'); 
?>