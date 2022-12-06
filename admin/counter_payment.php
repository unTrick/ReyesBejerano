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
			<div class="full-grid" style="text-align: center;">
                <div class="alert alert-info"><strong>Counter Payment</strong></div>
                <form class="form-horizontal" method="post">
                    <div class="control-group">
                        <label style="display: inline-block; width: 100px; text-align: left;" for="member-selection">Member Name</label>
                        <select name="member_id" id="member-selection" required>
                            <option></option>
                            <?php
                                $user_query=mysqli_query($conn,"SELECT * FROM members")or die(mysqli_error($conn));
                                while($row=mysqli_fetch_array($user_query)){  
                                    $user_balance_query=mysqli_query($conn,"SELECT * FROM payment_balance WHERE member_id = '".$row['member_id']."'")or die(mysqli_error($conn));
                                    while ($row_balance=mysqli_fetch_array($user_balance_query)){
                                        if($row_balance['total_amount']>0){ ?>
                                            <option value="<?php echo $row['member_id']; ?>"><?php echo $row['firstname']." ".$row['lastname']; ?></option>
                            <?php }}} ?>
                         </select>
                    </div>
                    <div class="control-group">
                        <label style="display: inline-block; width: 100px; text-align: left;" for="amount-paying">Amount Paying</label>
                        <input type="number" name="amount_paying" id="amount-paying" required>
                    </div>
                    <button name="save" type="submit" class="btn btn-success"><i class="icon-save icon-large"></i>&nbsp;Save</button>
                </form>
            </div>

            <div class="full-grid" style="text-align: left; margin-top: 80px;">
                <span>Note: Payments are only available for clients with pending payments</span>
            </div>
		</div>
	</div>
</div>

<?php
	if (isset($_POST['save'])){

		$member_id=$_POST['member_id'];
		$amount_paying=$_POST['amount_paying'];
        $date = date("Y/m/d");

        mysqli_query($conn,"INSERT INTO payment_history (amount,date,mode_of_payment,member_id) values('$amount_paying','$date', 'Cash','$member_id')")or die(mysqli_error($conn));

        $payment_balance=mysqli_query($conn,"SELECT * FROM payment_balance WHERE member_id = '$member_id' ")or die(mysqli_error($conn)); 

        while($row_payment_balance=mysqli_fetch_array($payment_balance)){ 
            $total_balance = $row_payment_balance["total_amount"] - $amount_paying;
            mysqli_query($conn,"UPDATE payment_balance SET total_amount='$total_balance' WHERE member_id='$member_id' ")or die(mysqli_error($conn));
        } ?>
		<script>
			window.location="counter_payment_confirmation.php";
		</script>
<?php } ?>

<?php include('footer.php') ?>