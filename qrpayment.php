<?php include('header.php'); ?>
<?php include('session.php'); ?>
<?php include('dbcon.php'); ?>
<?php include('navbar_dasboard.php'); ?>

<?php
$session_id = $_POST['session_id'];
$date = $_POST['date1'];
$time = $_POST['time1'];
$service = $_POST['service1'];
$payment_option = $_POST['payment_option'];
$service_price = $_POST['service_price'];
?>

<div class="container">
	<div class="margin-top">
		<div class="row">
			<div class="full-grid" style="text-align: center;">
				<img src="img/dr.png">
			</div>
			<div class="span6" style="float: none; margin: auto; padding: auto;">
			<div class="alert alert-info">Appointment Payment</div>
			<div class="question" style="height: 350px;">
			    <div style="width: 50%; float: left;">
			        <img src="images/gcash.jpg" style="border-radius: 8px;">
			    </div>
			    <div style="width: 50%; float: right;">
			        <div style="margin: 5px;">
			            <form method="POST" action="yes.php">
			                <input type="hidden" name="session_id" value="<?php echo $session_id; ?>" >
							<input type="hidden" name="date1" value="<?php echo $date; ?>" >
							<input type="hidden" name="time1" value="<?php echo $time; ?>" >
							<input type="hidden" name="service1" value="<?php echo $service; ?>" >
							<input type="hidden" name="service_price" value="<?php echo $service_price; ?>" >
							<input type="hidden" name="payment_option" value="<?php echo $payment_option; ?>" >
			                <input type="hidden" name="payment" value="settled" >
    			            <h5>Please Scan the QR Code and input the reference number below</h5>
    			            <div class="control-group">
    							<label for="reference_number" class="control-label">Reference #: </label>
    							<div class="controls">
    								<input type="text" name="reference_number" placeholder="123456789" style="border: 3px double #CCCCCC;" required>
    							</div>
    						</div>
    						<p>Please make sure the reference number is correct.</p>
    						<p>We will send you an email once the payment is confirmed.</p>
    						<button type="submit" name="yes" class="btn btn-success"><i class="icon-check icon-large"></i>&nbsp;Yes</button> &nbsp;  <a href="dasboard.php" class="btn"><i class="icon-remove"></i>&nbsp;No</a>
    			        </form>
			        </div>
			    </div>
			</div>
			</div>
		</div>
	</div>
</div>
