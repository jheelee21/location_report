<?php
    include "db.php";
    // using time zone for Seoul for fetching time
    date_default_timezone_set("Asia/Seoul");
    $curr_time = time();

    // function with parameter site, location and time for updating student location information to the database when registered
    function regi($c_site, $c_location, $curr_time) {
       
        $c_time = date("H:i:s",$curr_time);

        // time boundaries for 3 registerations
        $regi1_start = strtotime("13:15:00");
        $regi1_end = strtotime("13:45:00");
        $regi2_start = strtotime("16:15:00");
        $regi2_end = strtotime("16:45:00");
        $regi3_start = strtotime("19:15:00");
        $regi3_end = strtotime("19:45:00");

        // registering location for Saturday
        if (date('w', $curr_time) == 6) {
            if ($regi1_start <= $curr_time && $curr_time <= $regi2_start) {
                // registration session 1
                if ($curr_time <= $regi1_end) {
                    // if student registered within the time boundary for session 1, then 1 is entered for time1 in the database
                    $is_late = 1;
                } else {
                    // if student registered outside the time boundary for session 2, then 2 is entered for time1 in the database
                    $is_late = 2;
                }
                // update student location to the database
                $sql = mq("UPDATE  `registrationSat` SET location1='".$c_location."', site1=".$c_site.", time1=".$is_late." WHERE studentID='".$_SESSION['user_id']."'");
            } else if ($regi2_start <= $curr_time && $curr_time <= $regi3_start) {
                // registration session2
                if ($curr_time <= $regi2_end) {
                    $is_late = 1;
                } else {
                    $is_late = 2;
                }
                // update student location to the database
                $sql = mq("UPDATE `registrationSat` SET location2='".$c_location."', site2=".$c_site.", time2=".$is_late." WHERE studentID='".$_SESSION['user_id']."'");
            } else {
                // registration session 3
                if ($curr_time <= $regi3_end) {
                    $is_late = 1;
                } else {
                    $is_late = 2;
                }
                // update student location to the database
                $sql = mq("UPDATE `registrationSat` SET location3='".$c_location."', site3=".$c_site.", time3=".$is_late." WHERE studentID='".$_SESSION['user_id']."'");
            } 
            echo "<script>alert('Location registered!'); location.href='logout.php';</script>";
        } else if (date('w', $curr_time) == 0) {
            // registering location for Sunday
            if ($regi1_start <= $curr_time && $curr_time <= $regi2_start) {
                // session 1
                if ($curr_time <= $regi1_end) {
                    $is_late = 1;
                } else {
                    $is_late = 2;
                }
                // update student location to the database
                $sql = mq("UPDATE `registrationSun` SET location1='".$c_location."', site1=".$c_site.", time1=".$is_late." WHERE studentID='".$_SESSION['user_id']."'");
            } else if ($regi2_start <= $curr_time && $curr_time <= $regi3_start) {
                // session 2
                if ($curr_time <= $regi2_end) {
                    $is_late = 1;
                } else {
                    $is_late = 2;
                }
                // update student location to the database
                $sql = mq("UPDATE `registrationSun` SET location2='".$c_location."', site2=".$c_site.", time2=".$is_late." WHERE studentID='".$_SESSION['user_id']."'");
            }
            echo "<script>alert('Location registered!'); location.href='logout.php';</script>";
        } else {
            // error message when the student is trying to enter data during week days
            // the program is used only for the weekend
            echo "<script>alert('Today is not the weekend. This is registering program for weekends.'); location.href='/';</script>"; 
        }
    }

    // when submit button for insite location is clicked
    if (isset($_POST['insite_btn'])) {
        // if location is insite, then location column in the database is entered as 1
        $curr_site = 1;
        $curr_location = $_POST['insite_location'];
        // function regi is called with the inputted data
        regi($curr_site, $curr_location, $curr_time);
    } 

    // when submit button for offsite location is clicked
    if (isset($_POST['offsite_btn'])) {
        // if location is offsite, then location column in the database is entered as 2
        $curr_site = 2;
        $curr_location = $_POST['offsite_location'];
        // function regi is called with the inputted data
        regi($curr_site, $curr_location, $curr_time);
    }
?>