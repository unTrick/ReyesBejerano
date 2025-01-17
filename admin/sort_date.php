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

				<div class="alert alert-info">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong><i class="icon-user icon-large"></i>&nbsp;Service Table</strong>
				</div>
				<!-- form sort -->
				<form method="POST" action="sort_date.php">
					<input type="text"  class="w8em format-d-m-y highlight-days-67 range-low-today" name="date" id="sd" maxlength="10" style="border: 3px double #CCCCCC;" required/>
					<button name="sort" class="btn btn-success" style="margin-left: 20px;"><i class="icon-filter icon-large"></i>Sort</button>
				</form>
				<!-- end form -->
				<?php
				if (isset($_POST['sort'])){
					$date = $_POST['date']; ?>
				
					<table cellpadding="0" cellspacing="0" border="0" class="table  table-bordered" id="example">
						<thead>
							<tr>
								<th>Number</th>
								<th>Member</th>
								<th>Date</th>  
								<th>Time</th>
								<th>Service</th>                                 
								<th>Price</th>                                 
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							
							<?php $user_query=mysqli_query($conn,"select * from schedule where date = '$date' ")or die(mysqli_error($conn));
								while($row=mysqli_fetch_array($user_query)){
									$id=$row['id'];
									$member_id = $row['member_id'];
									$service_id = $row['service_id'];
									/* member query  */
									$member_query = mysqli_query($conn,"select * from members where member_id = ' $member_id'")or die(mysqli_error($conn));
									$member_row = mysqli_fetch_array($member_query);
									/* service query  */
									$service_query = mysqli_query($conn,"select * from service where service_id = '$service_id' ")or die(mysqli_error($conn));
									$service_row = mysqli_fetch_array($service_query); ?>
							
									<tr class="del<?php echo $id ?>">
										<td><?php  echo $row['Number'];  ?></td>
										<td><?php echo $member_row['firstname']." ".$member_row['lastname']; ?></td> 
										<td><?php  echo $row['date'];  ?></td> 
										<td><?php  echo date('h:i A', strtotime($row['time'].":00")); ?></td> 
										<td><?php  echo $service_row['service_offer'];  ?></td> 
										<td><?php  echo $service_row['price'];  ?></td> 
										<td width="135">
											<a href="delete_schedule.php<?php echo '?id='.$id.'&service_id='.$service_id.'&date='.$row['date'].'&time='.$row['time']; ?>" rel="tooltip"  title="Delete" id="<?php echo $id; ?>" class="btn btn-danger"><i class="icon-trash icon-large"></i></a>
											<a href="edit_schedule.php<?php echo '?id='.$id; ?>" rel="tooltip"  title="Edit" id="e<?php echo $id; ?>" class="btn btn-success"><i class="icon-pencil icon-large"></i></a>
											<a href="update.php<?php echo '?id='.$id; ?>"  class="btn btn-info"><i class="icon-check icon-large"></i></a>
										</td>
									</tr>
							<?php } ?>
					
						</tbody>
					</table>
				<?php } ?>
		</div>
    </div>
<?php include('footer.php') ?>