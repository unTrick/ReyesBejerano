	<div id="edit<?php echo $id; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-body">
			<div class="alert alert-info"><strong>Edit User</strong></div>
	<form class="form-horizontal" method="post">
			<div class="control-group">
				<label class="control-label" for="inputEmail">Service Offer</label>
				<div class="controls">
				<input type="hidden" id="inputEmail" name="id" value="<?php echo $row['service_id']; ?>" required>
				<input type="text" id="inputEmail" name="service" value="<?php echo $row['service_offer']; ?>" required>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="inputPassword">Price</label>
				<div class="controls">
				<input type="text" name="price" id="inputPassword" value="<?php echo $row['price']; ?>" required>
				</div>
			</div>
			<div class="control-group">
				<div class="controls">
				<button name="edit" type="submit" class="btn btn-success"><i class="icon-save icon-large"></i>&nbsp;Update</button>
				</div>
			</div>
    </form>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove icon-large"></i>&nbsp;Close</button>
		</div>
    </div>
	
	<?php
	if (isset($_POST['edit'])){
	
	$user_id=$_POST['id'];
	$service=$_POST['service'];
	$price=$_POST['price'];
	
	mysqli_query($conn,"update service set service_offer='$service', price='$price' where user_id='$user_id'")or die(mysqli_error($conn)); ?>
	<script>
	window.location="service.php";
	</script>
	<?php
	}
	?>