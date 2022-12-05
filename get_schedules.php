<?php
    include('dbcon.php');

    //define schedule class
    class schedule {
        public $date;
        public $time;
    }
    $schedules = array();

    $user_query=mysqli_query($conn,"SELECT * FROM schedule")or die(mysqli_error($conn));
    while($row=mysqli_fetch_array($user_query)){

        // loop through schedule to iterate array data
        $scheduleData = new schedule();
        $scheduleData->date = $row["date"];
        $scheduleData->time = $row["time"];

        array_push($schedules, $scheduleData);
    }

    $js_array = json_encode($schedules); // convert php array to json
    print_r($js_array); // print out schedule array data
?>