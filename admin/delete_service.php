<?php
include('dbcon.php');
$id=$_POST['id'];
mysqli_query($conn,"delete from service where service_id='$id'") or die(mysqli_error($conn));
?>