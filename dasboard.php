<?php include('header.php'); ?>
<?php include('session.php'); ?>
<?php include('dbcon.php'); ?>
<?php include('navbar_dasboard.php'); ?>
    <div class="container">
		<div class="margin-top">
			<div class="row">
				
				<div class="span3">
					    <ul class="nav nav-tabs nav-stacked">
							<li class="active">
							
							</li>
					
						</ul>
						<p><strong></strong></p>
				 <div class="">
                        
                        
                    </div>		
			
						
				
						
							
			
					
					
					
				<div class=""></div>
				<div class="">
				
					</div>		
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
		
		$query = mysqli_query($conn,"select * from schedule where date = '$date' and member_id = '$session_id' ")or die(mysqli_error($conn));
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
    <input type="text"  class="w8em format-d-m-y highlight-days-67 range-low-today" name="date" id="sd" maxlength="10" style="border: 3px double #CCCCCC;" required/>
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
    <button type="submit" name="sub" class="btn btn-info"></i>&nbsp;Submit</button>
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
				<div class=""></div>	
				
				</div>
				
			</div>
		</div>
    </div>
