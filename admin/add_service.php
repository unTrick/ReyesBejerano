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
			
			<div id="add_service" >
				<div class="full-grid" style="text-align: center;">
					<div class="alert alert-info"><strong>Add Service</strong></div>
					<form class="form-horizontal" method="POST">
						<div class="control-group">
							<label style="display: inline-block; width: 100px; text-align: left;" for="inputEmail">Service</label>
							<input type="text" name="service" id="inputEmail" placeholder="Service" required>
						</div>
						<div class="control-group">
							<label style="display: inline-block; width: 100px; text-align: left;" for="inputPassword">Price</label>
							<input type="text" name="price" id="inputPassword" placeholder="Price" required>
						</div>
						<button type="submit" name="ad" class="btn btn-info">Add</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
	
<?php

if (isset($_POST['price'])){
	$service=$_POST['service'];
	$price=$_POST['price'];

	mysqli_query($conn,"insert into service (service_offer,price) values('$service','$price')")or die(mysqli_error($conn)); ?>
	<script>
		window.location="service.php";
	</script>
<?php } ?>

<?php include('footer.php') ?>