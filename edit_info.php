<?php include('header.php'); ?>
<?php include('session.php'); ?>
<?php include('dbcon.php'); ?>
<?php include('navbar_dasboard.php'); ?>
    <div class="container">
		<div class="margin-top">
			<div class="row">
				
				<div class="span3">
					   
					
						</ul>
					
				 <div class=""></div>
				 
                        
                   
			
				<div class=""></div>
				<div class=""></div>
				<div class="">
					
					</div>		
				</div>
				<div class="span6">
				
					
				<div class="alert alert-info">Edit Personal Information</div>
	<?php 
	$member_query = mysqli_query($conn,"select * from members where member_id='$session_id'")or die(mysqli_error($conn));
	$member_row= mysqli_fetch_array($member_query);
	?>
	 <form class="form-horizontal" method="POST">
		<div class="control-group">
			<label class="control-label" for="inputEmail">Firstname</label>
			<div class="controls">
			<input type="text" value="<?php echo $member_row['firstname']; ?>" name="firstname" id="inputEmail" placeholder="Firstname" required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="inputPassword">Lastname</label>
			<div class="controls">
			<input type="text" name="lastname" id="inputPassword" placeholder="Lastname" value="<?php echo $member_row['lastname']; ?>" required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="inputPassword">Middlename</label>
			<div class="controls">
			<input type="text" name="middlename" id="inputPassword" value="<?php echo $member_row['middlename']; ?>" placeholder="Middlename" required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="inputPassword">Address</label>
			<div class="controls">
			<input type="text" name="address" value="<?php echo $member_row['address']; ?>" id="inputPassword" placeholder="Address" required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="inputPassword">Email</label>
			<div class="controls">
			<input type="text" name="email" id="inputPassword" value="<?php echo $member_row['email']; ?>" placeholder="Email" required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="inputPassword">Age</label>
			<div class="controls">
			<input type="text" name="age" class="span1" value="<?php echo $member_row['age']; ?>" id="inputPassword" placeholder="Age" required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="inputPassword">Gender</label>
			<div class="controls">
			<select class="span2" name="gender" required>
			<option><?php echo $member_row['gender']; ?></option>
			<option>Male</option>
			<option>Female</option>
			</select>
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
			<button type="submit" name="update" class="btn btn-success"><i class="icon-pencil"></i>&nbsp;Update</button>
			</div>
		</div>
    </form>
	
	<?php
	if (isset($_POST['update'])){
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$middlename = $_POST['middlename'];
	$address = $_POST['address'];
	$age = $_POST['age'];
	$gender = $_POST['gender'];
	$email = $_POST['email'];
		
	mysqli_query($conn,"update members set firstname='$firstname' , lastname='$lastname' , middlename='$middlename' , address='$address' ,
	age='$age' , gender='$gender' , email='$email' where member_id='$session_id' ") or die(mysqli_error($conn));
	?>
	<script>
	window.location = 'edit_info.php'; 
	</script>
	<?php
	}	
	?>

	
	
	
				</div>
			
						
			
			
			
				
				
                            
                                
                            
                           
                              
                      
			
				</div>
				
			</div>
		</div>
    </div>
