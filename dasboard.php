<?php include('header.php'); ?>
<?php include('session.php'); ?>
<?php include('dbcon.php'); ?>
<?php include('navbar_dasboard.php'); ?>
    <div class="container">
		<div class="margin-top">
			<div class="row">
				
				<div class="span3">
					    <ul class="nav nav-tabs nav-stacked">
							<li class="active"></li>
						</ul>
						<p><strong></strong></p>
				 <div class=""></div>
				<div class=""></div>
				<div class=""></div>		
				</div>
				<div class="span6">
					<img src="img/dr.png">
					<br>
					<br>
					
				<div class="alert alert-info">Select a Schedule of Appointment Date and Service</div>
	
	
		<?php
		if (isset($_POST['sub'])){
		$date = $_POST['date'];
		$service = $_POST['service'];
		$time = $_POST['timeSelection'];
		
		$query = mysqli_query($conn,"select * from schedule where date = '$date' and time = '$time' and member_id = '$session_id' ")or die(mysqli_error($conn));
		$count = mysqli_num_rows($query);
	/* 	echo $count; */
		if ($count  > 0){ ?>
		<script>
		alert('You have already schedule on this date');
		</script>
		<?php
		}else{
		$equal = $count + 1 ;
		

		?>
		<div class="question">
		<div class="alert alert-success">Your the number <strong><?php echo $equal; ?></strong> client in this date <strong><?php echo  $date; ?></strong></div>
		<form method="POST" action="yes.php">
		<input type="hidden" name="session_id" value="<?php echo $session_id; ?>" >
		<input type="hidden" name="date1" value="<?php echo $date; ?>" >
		<input type="hidden" name="time1" value="<?php echo $time; ?>" >
		<input type="hidden" name="service1" value="<?php echo $service; ?>" >
		<input type="hidden" name="equal" value="<?php echo $equal; ?>" >
		<p>Are you sure you want to set your Appointment on this date?</p>
		<button name="yes" class="btn btn-success"><i class="icon-check icon-large"></i>&nbsp;Yes</button> &nbsp;  <a href="dasboard.php" class="btn"><i class="icon-remove"></i>&nbsp;No</a>
		</form>
	
		</div>
		<br>
		<br>
		<?php }}   ?>

	
	<form class="form-horizontal" method="POST">
		<div class="control-group">
			<label class="control-label" for="inputEmail">Date</label>
			<div class="controls">
				<input type="text" id="date" class="w8em format-d-m-y highlight-days-67 range-low-today" name="date" id="sd" maxlength="10" style="border: 3px double #CCCCCC;" required/>
			</div>
		</div>	
	
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

		<div class="control-group">
			<label class="control-label" for="inputPassword">Service</label>
			<div class="controls">
				<select name="service" required>
					<option></option>
				<?php $query=mysqli_query($conn,"select * from service")or die(mysqli_error($conn));
				while($row=mysqli_fetch_array($query)){
				?>
			
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
			<?php } ?>
	
		</tbody>
	</table>
	</div>
    </div>

	<script>
		$(document).ready(function(){

			// time selection validation
			$("#scheduleSubmit").on("click", function(){
				const option = $("input[name='timeSelection']");
				if(!option[0].checked && !option[1].checked && !option[2].checked && !option[3].checked && !option[4].checked && !option[5].checked){
					alert("please select a time");
				}
			});

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

			// display available schedule
			$("#date").on("change", function(){
				let selectedDate = $("#date").val();
				
				$.ajax({ // get schedules ...
					type: "GET",
					url: "get_schedules.php",
					cache: false,
					success: function(data){

						// make time selection visible
						$("#time-selection-group").attr("style","display:block; margin-bottom: 10px");

						let availableCount = 6;
						let schedule = JSON.parse(data); // convert json to javascript array
						schedule.forEach(function(index){
							 if(index.date == selectedDate){ // hide the time if it's already taken
								$("#time" + index.time).attr("style","display:none;");
								availableCount -= 1;
							 }
							 else{
								$("#time" + index.time).removeAttr("style");
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
					} 
				});
			});
		});
	</script>