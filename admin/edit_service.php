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
			<?php $user_query=mysqli_query($conn,"SELECT * FROM service WHERE service_id = ".$_GET['id']."")or die(mysqli_error($conn));
				while($row=mysqli_fetch_array($user_query)){ ?>
					<div id="edit<?php echo $_GET["id"]; ?>">
						<div class="full-grid" style="text-align: center;">
							<div class="alert alert-info"><strong>Edit Service</strong></div>
							<form class="form-horizontal" method="post">
								<div class="control-group">
									<label style="display: inline-block; width: 100px; text-align: left;" for="inputEmail">Service Offer</label>
									<input type="hidden" id="inputEmail" name="id" value="<?php echo $row['service_id']; ?>">
									<input type="text" id="inputEmail" name="service" value="<?php echo $row['service_offer']; ?>" required>
								</div>
								<div class="control-group">
									<label style="display: inline-block; width: 100px; text-align: left;" for="inputPassword">Price</label>
									<input type="text" name="price" id="inputPassword" value="<?php echo $row['price']; ?>" required>
								</div>
								<button name="edit" type="submit" class="btn btn-success"><i class="icon-save icon-large"></i>&nbsp;Update</button>
							</form>
						</div>
					</div>
			<?php } ?>
		</div>
	</div>
</div>
	
<?php
	if (isset($_POST['edit'])){

		$user_id=$_POST['id'];
		$service=$_POST['service'];
		$price=$_POST['price'];

		mysqli_query($conn,"update service set service_offer='$service', price='$price' where service_id='$user_id'")or die(mysqli_error($conn)); ?>
		<script>
			window.location="service.php";
		</script>
<?php } ?>

<?php include('footer.php') ?>