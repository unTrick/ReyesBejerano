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
                <div class="alert alert-info">Schedule Deletion</div>

                <div class="full-grid" id="deletion-message">
                    <div class="full-grid" style="margin-top: 50px;">
                        <span style="font-size: xx-large; width: 100%;">Are you sure you want to delete this schedule?</span>
                    </div>
                    
                    <form class="form-horizontal" method="POST">
                        <input type="hidden" value="<?php  echo $_GET['id'];  ?>" name="schedule_id">
                        <div class="control-group" style="margin-top: 50px;">
                            <button type="submit" name="delete" class="btn btn-danger" id="scheduleDelete"></i>&nbsp;Delete</button>
                            <a href="schedule.php" class="btn btn-primary">No</a>
                        </div>
                    </form>

                    <div class="full-grid" style="text-align: left; margin-top: 80px;">
                        <span >
                            <?php
                                $schedule_id = $_GET['id'];
                                $service_id = $_GET['service_id'];
                                $date = $_GET['date'];
                                $time = $_GET['time'];

                                $service_query=mysqli_query($conn,"SELECT * FROM service WHERE service_id='$service_id'")or die(mysqli_error($conn)); 
                                while($service_row=mysqli_fetch_array($service_query)){ 
                                    print_r("Note: This schedule has been update for ".$service_row['service_offer']." on ".$date." at ".date('h:i A', strtotime($time.":00")));
                                }
                            ?>
                        </span> 
                    </div>
                </div>

                <?php
                    if (isset($_POST['delete'])){

                        echo '<script type="text/JavaScript"> $("#deletion-message").hide(); </script>';

                        $schedule_id = $_POST['schedule_id'];

                        mysqli_query($conn,"DELETE FROM schedule WHERE id = '$schedule_id' ")or die(mysqli_error($conn));
                        
                        print_r("This schedule been deleted !");
                }?>
            </div>
		</div>
	</div>
</div>

<?php include('footer.php') ?>