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
			<div class="span9" style="float: none; margin: auto; padding: auto;">
				<div class="alert alert-info">My Schedule</div>
				<table cellpadding="0" cellspacing="0" border="0" class="table  table-bordered" id="example">
					<thead>
						<tr>
							<th>My Number</th>
							<th>Date</th>    
							<th>Time</th>
							<th>Service</th>
							<th>Price</th>
						</tr>
					</thead>
					<tbody>
						<?php $user_query=mysqli_query($conn,"select * from schedule where member_id = '$session_id' ")or die(mysqli_error($conn));
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
									<td width="100"><?php  echo $row['Number'];?></td>
									<td><?php  echo $row['date'];  ?></td>
									<td><?php echo date('h:i A', strtotime($row['time'].":00"));?></td>
									<td><?php  echo $service_row['service_offer'];?></td>
									<td><?php  echo $service_row['price'];?></td>
								</tr>

							<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
