<?php
$conn = mysqli_connect("localhost", "u389128113_JEclinic", "JEclinic12@", "u389128113_JEclinicdb");
//$conn = mysqli_connect("localhost", "root", "", "u528708661_JEclinicdb");
if(!$conn){
	echo "Connection Failed: ".mysqli_error($conn);
	exit;
}
?>
