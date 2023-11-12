<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require '../PHPMailer/src/Exception.php';
    require '../PHPMailer/src/PHPMailer.php';
    require '../PHPMailer/src/SMTP.php';

    include('dbcon.php');
    $get_id = $_GET['id'];
    $member_id = $_GET['member_id'];
    $date = $_GET['date'];
    $reference_number = $_GET['reference_number'];
    $amount_paying = $_GET['amount_paying'];
    
    mysqli_query($conn,"INSERT INTO payment_history (amount,date,mode_of_payment,member_id) values('$amount_paying','$date', 'QR','$member_id')")or die(mysqli_error($conn)); 
    mysqli_query($conn,"update pending_payment set status = 'done' where pending_id = '$get_id' ")or die(mysqli_error($conn));
    mysqli_query($conn,"update schedule set payment_status = 'paid' where id = '$get_id' ")or die(mysqli_error($conn));
    
    $payment_balance=mysqli_query($conn,"SELECT * FROM payment_balance WHERE member_id = '$member_id' ")or die(mysqli_error($conn)); 
    
    while($row_payment_balance=mysqli_fetch_array($payment_balance)) { 
        $total_balance = $row_payment_balance["total_amount"] - $amount_paying; 
        mysqli_query($conn,"UPDATE payment_balance SET total_amount='$total_balance' WHERE member_id='$member_id' ")or die(mysqli_error($conn)); 
    }
    
    $member_information=mysqli_query($conn,"SELECT * FROM members WHERE member_id = '$member_id' ")or die(mysqli_error($conn)); 
    while($row_member_information=mysqli_fetch_array($member_information)) { 
        $member_fname = $row_member_information["firstname"]; 
        $member_lname = $row_member_information["lastname"]; 
        $member_email = $row_member_information["email"]; 
    }
    
    // EMAIL 
    $htmlEmailBody = '
        <html>
            <head>
              <style type="text/css">
                body {font-family: sans-serif;}
              </style>
            </head>
            <body>
              <div style="padding: 20px;text-align: center;background-color: #056595;color:white">
                <h2>J&E Dental Clinic Payment Approved !</h2>
              </div>
              <div>
                <h5>Dear '.$member_fname.' '.$member_lname.',</h5>
                <h5>Our administrator has confirmed your payment thru Gcash with reference number #'.$reference_number.'.</h5>
                <h5>Thank You!</h5>
                <br>
                <h5>J&E Dental Clinic</h5>
                <br>
                <p><i>for more concerns please contact us via 0915 767 8041</i></p>
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
        $mail->Subject = 'Payment Approval';
        $mail->Body    = $htmlEmailBody;
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    
    // EMAIL END
    
    header('location:gcash_payment.php'); 
?>