<?php include('header.php'); ?>
<?php include('session.php'); ?>
<?php include('dbcon.php'); ?>
<?php include('navbar_dasboard.php'); ?>
    <div class="container">
		<div class="margin-top">
			<div class="row">
				
				<div class="span3">
					   
					
						</ul>
						<p><strong></strong></p>
				 <div class="">
                        <i class=""></i>
                       
                    </div>		
						<div class=""></div>
					
					
					
					
				<div class=""></div>
					
						
					
					
					
				<div class=""></div>
				<div class="">
				


					</p>
					</div>		
				</div>
				<div class="span6">
					<img src="img/dr.png">
					<br>
					<br>
					
				<div class="alert alert-info">Select Date of Appointment and Service Offer</div>

		<!-- reservation -->
		<?php if (isset($_POST['yes'])){ 
		$session_id = $_POST['session_id'];
		$date1 = $_POST['date1'];
		$time1 = $_POST['time1'];
		$service1 = $_POST['service1'];
		$equal = $_POST['equal'];
		mysqli_query($conn,"insert into schedule (member_id,date, time,service_id,number,status) values('$session_id','$date1', '$time1','$service1','$equal','Pending')")or die(mysqli_error($conn));
		?>
		<div class="yes"><h3>Your appointment has been set on  <?php echo  $date1; ?>. THANK YOU</h3></div>
		<?php }else{ ?>
		<script>
		alert('error');
		</script>
		<?php } ?>
		<br>
		<br>
	
	<!-- end reservation -->
	


	
	
	
			
				
				</div>
				
			</div>
		</div>
    </div>
