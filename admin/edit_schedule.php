<?php include('header.php'); ?>
<?php include('session.php'); ?>

<div class="container">
	<div class="row">	
        <div class="full-grid" style="text-align: center;">
            <img src="../img/dr.png" class="img-rounded">
        </div>
		<div class="span3">
            <?php include('sidebar.php'); ?>
        </div>
		<div class="span9">
			<?php include('navbar_dasboard.php') ?>
			<div class="full-grid" style="float: none; margin: auto; padding: auto; text-align: center;">

                <div class="alert alert-info">Edit the Schedule of the Appointment Date and Service</div>
				<div id="schedule-selection">
					<form class="form-horizontal" method="POST">
                        <input type="hidden" name="schedule_id" value="<?php echo $_GET['id']; ?>">
						<div class="control-group">
							<label style="display: inline-block; width: 100px; text-align: left; padding-left: 23px !important;" for="input_date">Date</label>
                            <input type="text" id="input_date" class="w8em format-d-m-y highlight-days-67 range-low-today" name="date" id="sd" maxlength="10" style="border: 3px double #CCCCCC;" required/>
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
							<label style="display: inline-block; width: 100px; text-align: left;" for="service-selection">Service</label>
                            <select name="service" id="service-selection" required>
                                <option></option>
                                <?php $query=mysqli_query($conn,"select * from service")or die(mysqli_error($conn));
                                    while($row=mysqli_fetch_array($query)){ ?>
                                        <option value="<?php echo $row['service_id']; ?>"><?php echo $row['service_offer'] ?></option>
                                <?php } ?>
                            </select>
						</div>
						<div class="control-group">
                            <button type="submit" name="sub" class="btn btn-success" id="scheduleSubmit"></i>&nbsp;Submit</button>
						</div>
					</form>
				</div>

                <?php
					if (isset($_POST['sub'])){

                        echo '<script type="text/JavaScript"> $("#schedule-selection").hide(); </script>';

                        $schedule_id = $_POST['schedule_id'];
                        $date = $_POST['date'];
                        $time = $_POST['timeSelection'];
                        $service = $_POST['service'];

						mysqli_query($conn,"UPDATE schedule SET date='$date', time='$time', service_id='$service' WHERE member_id='$session_id' ")or die(mysqli_error($conn));
                        
                    
                        $service_query=mysqli_query($conn,"SELECT * FROM service WHERE service_id='$service'")or die(mysqli_error($conn)); 
                        while($service_row=mysqli_fetch_array($service_query)){ 
                            print_r("This schedule has been update for ".$service_row['service_offer']." on ".$date." at ".date('h:i A', strtotime($time.":00")));
                        }
				}?>

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
		$("#input_date").on("change", function(){
			let selectedDate = $("#input_date").val();
			
			$.ajax({ // get schedules ...
				type: "GET",
				url: "../get_schedules.php",
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

<?php include('footer.php') ?>