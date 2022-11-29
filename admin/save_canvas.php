<?php
    include('dbcon.php');
    
    $id=$_POST['id'];
    $comments=mysqli_real_escape_string($conn, $_POST['comments']); // legalized special characters using mysqli_real_escape_string for the SQL to accept the inputed value  
    $data=mysqli_real_escape_string($conn, $_POST['data']); // legalized special characters using mysqli_real_escape_string for the SQL to accept the inputed value
    
    $user_query=mysqli_query($conn,"SELECT * FROM dental_records WHERE member_id='$id'")or die(mysqli_error($conn));
    
    // first check if the user already has previous records
    if($row=mysqli_fetch_array($user_query)) {
        mysqli_query($conn,"UPDATE dental_records SET canvas_data='$data', comments='$comments' WHERE member_id='$id'") or die(mysqli_error($conn));
    }
    else{
        mysqli_query($conn,"INSERT INTO dental_records (comments, canvas_data, member_id) VALUES ('$comments', '$data', '$id')") or die(mysqli_error($conn));
    }
?>