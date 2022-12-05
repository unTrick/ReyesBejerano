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
			<table cellpadding="0" cellspacing="0" border="0" class="table  table-bordered" id="example">
				<thead>
					<tr>
						<th>Number</th>
						<th>Member</th>
						<th>Date</th>         
						<th>Time</th>                          
						<th>Service</th>                                 
						<th>Price</th>                                 
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$new = date('d/m/Y');
						$user_query=mysqli_query($conn,"select * from schedule where date  like  '%$new%' ")or die(mysqli_error($conn));
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
								<td><?php  echo $row['status'];  ?></td> 
								<td width="100">
									<a rel="tooltip"  title="Edit" id="e<?php echo $id; ?>" href="#edit<?php echo $id; ?>" data-toggle="modal" class="btn btn-success"><i class="icon-pencil icon-large"></i></a>
									<a  href="update1.php<?php echo '?id='.$id; ?>"  class="btn btn-info"><i class="icon-check icon-large"></i></a>
								</td>
							</tr>
					<?php } ?>
			
				</tbody>
			</table>
		</div>
    </div>
<?php include('footer.php') ?>