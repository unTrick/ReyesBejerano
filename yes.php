<?php 
	
	if($_POST['payment_option'] == "QR" && $_POST['payment'] != "settled"){
        include('qrpayment.php');
		exit();
	}
	
	
	use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';
?>

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
			<div class="span6" style="float: none; margin: auto; padding: auto;">
			<div class="alert alert-info">Appointment Confirmed</div>
				<!-- reservation -->
				<?php if (isset($_POST['yes'])){ 
                    
					$session_id = $_POST['session_id'];
					$date1 = $_POST['date1'];
					$time1 = $_POST['time1'];
					$service1 = $_POST['service1'];
					$payment_option = $_POST['payment_option'];
					$service_price = $_POST['service_price'];
					$reference_number = $_POST['reference_number'];
					$service_name = "";
					
					// check first to avoid duplicatione
					$isScheduleAvailable = true;
					$user_query=mysqli_query($conn,"SELECT * FROM schedule")or die(mysqli_error($conn)); 
					while($row=mysqli_fetch_array($user_query)){ 
						if($row["date"] == $date1 && $row["time"] == $time1){
							$isScheduleAvailable = false;
						}
					}

					if($isScheduleAvailable){
						$isPaymentFulfilled = "unpaid";
						$balance = $service_price;
				
				        if($payment_option == "QR"){
				            $current_date = date("Y-m-d H:i:s");
				            mysqli_query($conn,"insert into pending_payment (total_amount,member_id,reference_number,date,status) values('$balance','$session_id', '$reference_number','$current_date','pending')")or die(mysqli_error($conn));
				        }

						$payment_balance=mysqli_query($conn,"SELECT * FROM payment_balance WHERE member_id = '$session_id' ")or die(mysqli_error($conn)); 

						if($row_payment_balance=mysqli_fetch_array($payment_balance)){
							$total_balance = $row_payment_balance['total_amount'] + $balance;
							mysqli_query($conn,"UPDATE payment_balance SET total_amount='$total_balance' WHERE member_id='$session_id' ")or die(mysqli_error($conn));
						}
						else {
							mysqli_query($conn,"INSERT INTO payment_balance (total_amount, member_id) VALUES('$balance', '$session_id')")or die(mysqli_error($conn));
						}
						
						mysqli_query($conn,"insert into schedule (member_id,date, time,service_id,number,payment_status,status) values('$session_id','$date1', '$time1','$service1','1', '$isPaymentFulfilled','Pending')")or die(mysqli_error($conn));
						$queryService=mysqli_query($conn,"SELECT * FROM service WHERE service_id = '".$service1."' ")or die(mysqli_error($conn));
						while($rowService=mysqli_fetch_array($queryService)){
							$service_name = $rowService["service_offer"];
						}
						
						
						$member_details=mysqli_query($conn,"SELECT * FROM members WHERE member_id = '$session_id' ")or die(mysqli_error($conn)); 
						while($rowMemberDetails=mysqli_fetch_array($member_details)){
							$member_email = $rowMemberDetails["email"];
							$member_fname = $rowMemberDetails["firstname"];
							$member_lname = $rowMemberDetails["lastname"];
						}
                        
                        $dateNewFormate = str_replace('/', '-', $date1);
                        $dateAppointment = date("F j, Y", strtotime($dateNewFormate));
                        $timeAppointement = date('h:i A', strtotime($time1.":00"));
                        $htmlEmailBody = '
                            <html>
                                <head>
                                  <style type="text/css">
                                    body {font-family: sans-serif;}
                                  </style>
                                </head>
                                <body>
                                  <div style="padding: 20px;text-align: center;background-color: #056595;color:white">
                                    <h2>J&E Dental Clinic Appointment Approved !</h2>
                                  </div>
                                  <div>
                                    <h5>Dear '.$member_fname.' '.$member_lname.',</h5>
                                    <h5>Our administrator has confirmed your appointment booking request!</h5>
                                    <h5>Your '.$service_name.' appointment is scheduled on '.$dateAppointment.' at '.$timeAppointement.'.</h5>
                                    <h5>Thank You!</h5>
                                    <br>
                                    <h5>J&E Dental Clinic</h5>
                                    <br>
                                    <p><i>for cancellation and rescheduling please contact us via 0915 767 8041</i></p>
                                  </div>
                                </body>
                            </html>
                        ';
                        
                        //Create an instance; passing `true` enables exceptions
                        $mail = new PHPMailer(true);
                        
                        try {
                            //Server settings
                            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                            $mail->isSMTP();                                            //Send using SMTP
                            $mail->Host       = 'smtp.hostinger.com';                   //Set the SMTP server to send through
                            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                            $mail->Username   = 'jedentalclinic@jeguardamanodentalcliniconline.com';                     //SMTP username
                            $mail->Password   = 'Bejeranoreyes12@';                               //SMTP password
                            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                        
                            //Recipients
                            $mail->setFrom('jedentalclinic@jeguardamanodentalcliniconline.com', 'J&E Dental Clinic');
                            $mail->addAddress($member_email, $member_fname.' '.$member_lname);     //Add a recipient
                            $mail->addAddress($member_email);               //Name is optional
                            $mail->addReplyTo('jedentalclinic@jeguardamanodentalcliniconline.com', 'J&E Dental Clinic');
                            //$mail->addCC('cc@example.com');
                            //$mail->addBCC('bcc@example.com');
                        
                            //Attachments
                            //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
                        
                            //Content
                            $mail->isHTML(true);                                  //Set email format to HTML
                            $mail->Subject = 'Appointment Approval';
                            $mail->Body    = $htmlEmailBody;
                            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                        
                            $mail->send();
                        } catch (Exception $e) {
                            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                        }
    
					}
				?>
				<div class="yes">
				    <h3>Your appointment for <?php echo $service_name; ?> has been set on <?php echo  $dateAppointment; ?> at <?php echo  date('h:i A', strtotime($time1.":00")); ?>. THANK YOU!</h3>
				    <p>An email has been sent to you.</p>
			    </div>
				<?php }else{ ?>
					<script>
						alert('error');
					</script>
				<?php } ?>
				<!-- end reservation -->
			</div>
		</div>
	</div>
</div>
