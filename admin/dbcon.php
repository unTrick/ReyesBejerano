<?php
$conn = mysqli_connect("localhost", "root", "", "u528708661_JEclinicdb");
if(!$conn){
	echo "Connection Failed: ".mysqli_error($conn);
	exit;
}
?>
