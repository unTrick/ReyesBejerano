<?php
$conn = mysqli_connect("localhost", "u528708661_JEclinic", "JEclinic12@", "u528708661_JEclinicdb");
if(!$conn){
	echo "Connection Failed: ".mysqli_error($conn);
	exit;
}
?>
