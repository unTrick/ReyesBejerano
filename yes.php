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
					$payment_option = $_POST['payment_option'];
					$service_price = $_POST['service_price'];
					
					// check first to avoid duplication
					$isScheduleAvailable = true;
					$user_query=mysqli_query($conn,"SELECT * FROM schedule")or die(mysqli_error($conn)); 
					while($row=mysqli_fetch_array($user_query)){ 
						if($row["date"] == $date1 && $row["time"] == $time1){
							$isScheduleAvailable = false;
						}
					}

					if($isScheduleAvailable){
						$isPaymentFulfilled = "unpaid";
						$total_balance = $service_price;

						if($payment_option == "Card"){
							$isPaymentFulfilled = "paid";
							$total_balance = "0";
							mysqli_query($conn,"insert into payment_history (amount,date,mode_of_payment,member_id) values('$service_price','$date1', '$payment_option','$session_id')")or die(mysqli_error($conn));
						}

						$payment_balance=mysqli_query($conn,"SELECT * FROM payment_balance WHERE member_id = '$session_id' ")or die(mysqli_error($conn)); 
						$row_payment_balance=mysqli_fetch_array($payment_balance);

						if($row_payment_balance){
							while($row_payment_balance){ 
								$total_balance = $row_payment_balance["total_amount"] + $total_balance;
								mysqli_query($conn,"UPDATE payment_balance SET total_amount='$total_balance' WHERE member_id='$session_id' ")or die(mysqli_error($conn));
							}
						}
						else {
							mysqli_query($conn,"INSERT INTO payment_balance (total_amount, member_id) VALUES('$total_balance', '$session_id')")or die(mysqli_error($conn));
						}
						
						mysqli_query($conn,"insert into schedule (member_id,date, time,service_id,number,payment_status,status) values('$session_id','$date1', '$time1','$service1','1', '$isPaymentFulfilled','Pending')")or die(mysqli_error($conn));
						
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
