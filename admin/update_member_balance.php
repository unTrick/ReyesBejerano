<?php
    include('dbcon.php');
    $id=$_POST['member_id'];
    $balance_amount=$_POST['balance_amount'];
    $current_balance=$_POST['current_balance'];
    $total_balance = $current_balance + $balance_amount;

    mysqli_query($conn,"UPDATE payment_balance SET total_amount='$total_balance' WHERE member_id='$id'") or die(mysqli_error($conn));
    print_r($total_balance);
?>