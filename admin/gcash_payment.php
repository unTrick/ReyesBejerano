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
							<th>Member</th>
							<th>Date</th>
							<th>Time</th>   
							<th>Price</th>                                 
							<th>Reference #</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						
						<?php $user_query=mysqli_query($conn,"select * from pending_payment")or die(mysqli_error($conn));
							while($row=mysqli_fetch_array($user_query)){
								$id=$row['pending_id'];
								$member_id = $row['member_id'];
								/* member query  */
								$member_query = mysqli_query($conn,"select * from members where member_id = ' $member_id'")or die(mysqli_error($conn));
								$member_row = mysqli_fetch_array($member_query);
								
								$date = date("Y/m/d", strtotime($row['date']));
								$time = date('h:i A', strtotime($row['date']))
						?>
								
								<tr class="del<?php echo $id ?>">
									<td><?php echo $member_row['firstname']." ".$member_row['lastname']; ?></td> 
									<td><?php  echo $date;  ?></td> 
									<td><?php  echo $time; ?></td> 
									<td><?php  echo $row['total_amount'];  ?></td> 
									<td>#<?php  echo $row['reference_number'];  ?></td> 
									<td><?php  echo $row['status'];  ?></td>
									<td width="135">
										<a href="qr_payment_approval.php<?php echo '?id='.$id.'&member_id='.$member_id.'&date='.$date.'&reference_number='.$row['reference_number'].'&amount_paying='.$row['total_amount']; ?>"  class="btn btn-info"><i class="icon-check icon-large"></i></a>
									</td>
								</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
<?php include('footer.php') ?>