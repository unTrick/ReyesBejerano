<?php
include('dbcon.php');
$get_id = $_GET['id'];
mysqli_query($conn,"delete from schedule where id = '$get_id' ")or die(mysqli_error($conn));
header('location:schedule.php');
?>