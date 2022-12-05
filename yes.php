<?php include('header.php'); ?>
<?php include('session.php'); ?>
<?php include('dbcon.php'); ?>
<?php include('navbar_dasboard.php'); ?>

<div class="container">
	<div class="margin-top">
		<div class="row">
			<div class="full-grid" style="text-align: center;">
				<img src="img/dr.png">
			</div>
			<div class="span6" style="float: none; margin: auto; padding: auto;">
			<div class="alert alert-info">Select Date of Appointment and Service Offer</div>
				<!-- reservation -->
				<?php if (isset($_POST['yes'])){ 

					$session_id = $_POST['session_id'];
					$date1 = $_POST['date1'];
					$time1 = $_POST['time1'];
					$service1 = $_POST['service1'];
					$equal = $_POST['equal'];
					
					// check first to avoid duplication
					$isAlreadyAssigned = true;
					$user_query=mysqli_query($conn,"SELECT * FROM schedule")or die(mysqli_error($conn)); 
					while($row=mysqli_fetch_array($user_query)){ 
				
						if($row["date"] == $date1 && $row["time"] == $time1){
							$isAlreadyAssigned = false;
						}
					}

					if($isAlreadyAssigned){
						mysqli_query($conn,"insert into schedule (member_id,date, time,service_id,number,status) values('$session_id','$date1', '$time1','$service1','$equal','Pending')")or die(mysqli_error($conn));
					}
				?>
				<div class="yes"><h3>Your appointment has been set on  <?php echo  $date1; ?>. THANK YOU</h3></div>
				<?php }else{ ?>
					<script>
						alert('error');
					</script>
				<?php } ?>
				<!-- end reservation -->
			</div>
		</div>
	</div>
</div>
