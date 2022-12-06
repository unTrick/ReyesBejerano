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
		</div>
		<div class="row">
			<div class="span6" style="float: none; margin: auto; padding: auto;">
				<div class="alert alert-info">Select a Schedule of Appointment Date and Service</div>
				<div id="schedule-selection">
					<form class="form-horizontal" method="POST">
						<div class="control-group">
							<label class="control-label" for="inputEmail">Date</label>
							<div class="controls">
								<input type="text" id="date" class="w8em format-d-m-y highlight-days-67 range-low-today" name="date" id="sd" maxlength="10" style="border: 3px double #CCCCCC;" required/>
							</div>
						</div>	
					
						<div id="content-selection-group">
							<div class="full-grid" id="time-selection-group" style="display: none;">
								<div class="control-group time-selection" id="time9">
									<label for="timeSelection1">9:00 AM</label>
									<div class="controls">
										<input class="" type="radio" name="timeSelection" value="9" id="timeSelection1" style="display: none">
									</div>
								</div>
								<div class="control-group time-selection" id="time10">
									<label for="timeSelection2">10:00 AM</label>
									<div class="controls">
										<input class="" type="radio" name="timeSelection" value="10" id="timeSelection2" style="display: none">
									</div>
								</div>
								<div class="control-group time-selection" id="time11">
									<label for="timeSelection3">11:00 AM</label>
									<div class="controls">
										<input class="" type="radio" name="timeSelection" value="11" id="timeSelection3" style="display: none">
									</div>
								</div>
								<div class="control-group time-selection" id="time13">
									<label for="timeSelection4">1:00 PM</label>
									<div class="controls">
										<input class="" type="radio" name="timeSelection" value="13" id="timeSelection4" style="display: none">
									</div>
								</div>
								<div class="control-group time-selection" id="time14">
									<label for="timeSelection5">2:00 PM</label>
									<div class="controls">
										<input class="" type="radio" name="timeSelection" value="14" id="timeSelection5" style="display: none">
									</div>
								</div>
								<div class="control-group time-selection" id="time15">
									<label for="timeSelection6">3:00 PM</label>
									<div class="controls">
										<input class="" type="radio" name="timeSelection" value="15" id="timeSelection6" style="display: none">
									</div>
								</div>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="inputPassword">Service</label>
							<div class="controls">
								<select name="service" required>
									<option></option>
									<?php $query=mysqli_query($conn,"select * from service")or die(mysqli_error($conn));
										while($row=mysqli_fetch_array($query)){ ?>
											<option value="<?php echo $row['service_id']; ?>"><?php echo $row['service_offer'] ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="control-group">
							<div class="controls">
								<button type="submit" name="sub" class="btn btn-info" id="scheduleSubmit"></i>&nbsp;Submit</button>
							</div>
						</div>
					</form>

					<div class="alert alert-info">List of Services</div>
					<table class="table  table-bordered">
						<thead>
							<tr>
								<th>Service Offer</th>
								<th>Price</th>      
							</tr>
						</thead>
						<tbody>
							
							<?php $user_query=mysqli_query($conn,"select * from service")or die(mysqli_error($conn));
							while($row=mysqli_fetch_array($user_query)){
								$id=$row['service_id']; ?>
								<tr class="del<?php echo $id ?>">
									<td><?php echo $row['service_offer']; ?></td> 
									<td><?php echo $row['price']; ?></td>
								</tr>                    
							<?php } ?>
					
						</tbody>
					</table>
				</div>
				<?php
					if (isset($_POST['sub'])){

						echo '<script type="text/JavaScript"> $("#schedule-selection").hide(); </script>';

						$date = $_POST['date'];
						$service = $_POST['service'];
						$time = $_POST['timeSelection'];

						$queryService=mysqli_query($conn,"SELECT * FROM service WHERE service_id = '".$service."' ")or die(mysqli_error($conn));
						while($rowService=mysqli_fetch_array($queryService)){ ?>

							<div class="question" style="margin-bottom: 20px;" id="appointment-confirmation">
								<div class="alert alert-success">
									<span>This is a schedule for <?php echo  $rowService["service_offer"]; ?> on </span>
									<strong>
										<?php echo  $date; ?> at <?php echo  date('h:i A', strtotime($time.":00")); ?>
									</strong>
								</div>
								<form method="POST" action="yes.php">
									<input type="hidden" name="session_id" value="<?php echo $session_id; ?>" >
									<input type="hidden" name="date1" value="<?php echo $date; ?>" >
									<input type="hidden" name="time1" value="<?php echo $time; ?>" >
									<input type="hidden" name="service1" value="<?php echo $service; ?>" >
									<input type="hidden" name="service_price" value="<?php echo $rowService["price"]; ?>" >
									<div class="control-group">
										<label for="payment-option">How would you like to pay?</label>
										<div class="controls">
											<select name="payment_option" id="payment-option">
												<option value="Cash">Cash at the counter</option>
												<option value="Card" disabled>Card Payment</option>
											</select>
										</div>
									</div>
									<p>Are you sure you want to set your Appointment on this date?</p>
									<button type="submit" name="yes" class="btn btn-success"><i class="icon-check icon-large"></i>&nbsp;Yes</button> &nbsp;  <a href="dasboard.php" class="btn"><i class="icon-remove"></i>&nbsp;No</a>
								</form>
							</div>
				<?php }}?>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function(){

		
		$("#scheduleSubmit").on("click", function(){
			// time selection validation
			const option = $("input[name='timeSelection']");
			if(!option[0].checked && !option[1].checked && !option[2].checked && !option[3].checked && !option[4].checked && !option[5].checked){
				alert("please select a time");
			}
		});

		timeSelection(); // for re-initialization
        function timeSelection (){
            // time selection button style
            for(x=1;x<7;x++){
                $("#timeSelection" + x).on("click", function(){
                    let button = $('.time-selection');
                    if(button.hasClass("btn-primary")){
                        button.removeClass("btn-primary");
                    }
                    let selection = $(this).closest(".control-group");
                    $(selection).addClass("btn-primary");
                });
            }
        }

		// display available schedule
		$("#date").on("change", function(){
			let selectedDate = $("#date").val();
			
			$.ajax({ // get schedules ...
				type: "GET",
				url: "get_schedules.php",
				cache: false,
				success: function(data){

					// reload the selection group div first
                    $("#content-selection-group").load(window.location.href + " #time-selection-group", function() {
                       
					   // make time selection visible
					   $("#time-selection-group").attr("style","display:block; margin-bottom: 10px");
					   let availableCount = 6;
					   let schedule = JSON.parse(data); // convert json to javascript array

					   // hide the time if it's already taken
					   schedule.forEach(function(index) {
						   if(index.date == selectedDate){
							   $("#time" + index.time).attr("style","display:none;");
							   availableCount -= 1;
						   }
					   });
					   
					   // hide the time selection if there are no available schedules for that day
					   // then disable the submit button
					   if(availableCount == 0){
						   $("#time-selection-group").append("<div class='full-grid' id='noAvail' style='text-align: center;'><span> FULLY BOOKED. PLEASE SELECT A DIFFERENT DAY.</span></div>");
						   $("#scheduleSubmit").attr("disabled", true);
					   }
					   else {
						   $("#noAvail").remove();
						   $("#scheduleSubmit").removeAttr("disabled");
					   }

					   timeSelection(); // re-initialize
				   });
				} 
			});
		});
	});
</script>