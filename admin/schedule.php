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
				
				<!-- form sort -->
				<form method="POST" action="sort_date.php">
					<input type="text"  class="w8em format-d-m-y highlight-days-67 range-low-today" name="date" id="sd" maxlength="10" style="border: 3px double #CCCCCC;" required/>
					<button name="sort" class="btn btn-success" style="margin-left: 20px;"><i class="icon-filter icon-large"></i>Sort</button>
				</form>
				<!-- end form -->
				<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered" id="example">
					<thead>
						<tr>
							<th>Number</th>
							<th>Member</th>
							<th>Date</th>  
							<th>time</th>                                 
							<th>Service</th>                                 
							<th>Price</th>                                 
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						
						<?php $user_query=mysqli_query($conn,"select * from schedule")or die(mysqli_error($conn));
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
									<td>
										<?php // null checking
											if(empty($service_row['service_offer'])){
												echo "Service Unavailable";
											}
											else {
												echo $service_row['service_offer'];
											}
										?>
									</td> 
									<td>
										<?php // null checking
											if(empty($service_row['price'])){
												echo "Service Unavailable";
											}
											else {
												echo $service_row['price'];
											}
											
										?>
									</td> 
									<td><?php  echo $row['status'];  ?></td> 
									<td width="100">
										<a href="edit_schedule.php<?php echo '?id='.$id; ?>" rel="tooltip"  title="Edit" id="e<?php echo $id; ?>" data-toggle="modal" class="btn btn-success"><i class="icon-pencil icon-large"></i></a>
										<a href="update.php<?php echo '?id='.$id; ?>"  class="btn btn-info"><i class="icon-check icon-large"></i></a>
									</td>
								</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
<?php include('footer.php') ?>