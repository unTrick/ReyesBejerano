<?php
    include('dbcon.php');
    $id=$_POST['id'];
    $comments=$_POST['comments'];
    $data=$_POST['data'];
    $user_query=mysqli_query($conn,"SELECT * FROM dental_records WHERE member_id='$id'")or die(mysqli_error($conn));
    if($row=mysqli_fetch_array($user_query)) {
        mysqli_query($conn,"UPDATE dental_records SET canvas_data='$data', comments='$comments' WHERE member_id='$id'") or die(mysqli_error($conn));
    }
    else{
        mysqli_query($conn,"INSERT INTO dental_records (comments, canvas_data, member_id) VALUES ('$comments', '$data', '$id')") or die(mysqli_error($conn));
    }
?>