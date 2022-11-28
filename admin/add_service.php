						    <!-- Button to trigger modal -->
    <a href="#add_service" role="button" class="btn btn-info" data-toggle="modal"><i class="icon-plus icon-large"></i>&nbsp;Add Service</a>
     <br>
     <br>
    <!-- Modal -->
    <div id="add_service" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
	<div class="alert alert-info">Add Service</div>
    </div>
    <div class="modal-body">
		<form class="form-horizontal" method="POST">
			<div class="control-group">
			<label class="control-label" for="inputEmail">Service</label>
			<div class="controls">
			<input type="text" name="service" id="inputEmail" placeholder="Service" required>
			</div>
			</div>
			<div class="control-group">
			<label class="control-label" for="inputPassword">Price</label>
			<div class="controls">
			<input type="text" name="price" id="inputPassword" placeholder="Price"  required>
			</div>
			</div>
			<div class="control-group">
			<div class="controls">
			<button type="submit" name="ad" class="btn btn-info">Add</button>
			</div>
			</div>
	</form>
	</div>
    <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    </div>
    </div>
	
	<?php
	
	if (isset($_POST['price'])){
	$service=$_POST['service'];
	$price=$_POST['price'];
	
	mysqli_query($conn,"insert into service (service_offer,price) values('$service','$price')")or die(mysqli_error($conn));
	?>
	<script>
	window.location="service.php";
	</script>
	<?php
	}
	?>