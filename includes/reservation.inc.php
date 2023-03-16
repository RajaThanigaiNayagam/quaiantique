<?php
require "../header.php";
session_start();

//between function.. checks if the characters are within the limits we set
function between($val, $x, $y){
    $val_len = strlen($val);
    return ($val_len >= $x && $val_len <= $y)?TRUE:FALSE;
}

if(isset($_POST['reserv-submit'])) {//check whether the  submit button is clicked in the reservation page
    // connection to mysql database
    require 'dbh.inc.php';

    $user= $_SESSION['user_id'];
    $date= $_POST['date'];
    $time= $_POST['time'];
    $guests= $_POST['num_guests'];
    $tele = $_POST['tele'];
    $comments = $_POST['comments'];

    if($guests==1 || $guests==2){
        $tables=1;
    }
    else{
        $tables=ceil(($guests-2)/2);
    }
    if(empty($date) || empty($time) || empty($guests) || empty($tele)) {
        header("Location: ../reservation.php?error3=emptyfields");
        exit();
    } else if(!preg_match("/^[0-9]*$/", $guests) || !between($guests,1,3)) {
        header("Location: ../reservation.php?error3=invalidguests");
        exit();
    } else if(!preg_match("/^[a-zA-Z0-9]*$/", $tele) || !between($tele,6,20)) {
        header("Location: ../reservation.php?error3=invalidtele");
        exit();
    } else if(!preg_match("/^[a-zA-Z 0-9]*$/", $comments) || !between($comments,0,200)) {
        header("Location: ../reservation.php?error3=invalidcomment");
        exit();
    } else {
        //changing the time format to hh:mm:ss, that the mysql can understand
        if (strlen($time) == 5) {
            $time = $time . ":00"; 
        } else if ( (strlen($time) < 5)  || (strlen($time) == 0) ) { 
            header("Location: ../reservation.php?error3=errortimeslot");  // **********done
            exit();
        };

        $rest_time_slot_id='';
        //SQL to retrive the id of the "reservation time slot" (fuseau horaire de réservation) form the table "reservation_time_slot"
        $sql = "SELECT Id FROM reservation_time_slot WHERE time_slot='$time'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $rest_time_slot_id =$row["Id"];
            }
        } else if( $result->num_rows = 0) {
            /************************will not enter in the this  part **********************/
            header("Location: ../reservation.php?error3=errornotimeslot");  // **********done
            exit();
            /************************will not enter in the above part **********************/
        }
    }  
    
    var_dump($rest_time_slot_id);
    var_dump($time);
    // check for the given date and given reservation slot time, find if the restaurant is opened of closed at that particular given time.
                                //  ***************todo
    //Here is to get the day of the date
    $timestamp = strtotime($date);
    $day = date('N', $timestamp);
    $dayoftheweek = array('lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche',);
    $jourdedate = $dayoftheweek[$day-1];
    
    $sql = "SELECT open_time, close_time, eveningopentime, eveningclosetime FROM schedule WHERE day='".$jourdedate."'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            // To verify the reservation period is in the "afternoon" of in the "evening"
            if ( $time < "16:00:00" ) { $afternoonperiod = true; $eveningperiod = false; } else { $eveningperiod = true; $afternoonperiod = false; }
            // To 
            if ( $afternoonperiod && (   ( ($row["open_time"]) == "00:00:00" )  && ( ($row["close_time"])  == "00:00:00")  )  ) {   //&&  ( (($row["open_time"]) <= $time ) || ($time <= ($row["close_time"])) ) ) {
                header("Location: ../reservation.php?error3=restaurantclosed" );
                exit();
            } else if  ( (   ( ($row["eveningopentime"]) == "00:00:00" )  && ( ($row["eveningclosetime"])  == "00:00:00")  )   ) {   //&&  ( (($row["eveningopentime"]) <= $time ) || ($time <= ($row["eveningclosetime"])) ) ) {
                header("Location: ../reservation.php?error3=restaurantclosed" );
                exit();
            }
        }
    }
    else{$a_tables=5;}


    //I check the unused tables (tables not reserved) per day
    $sql = "SELECT r.rdate, rt.time_slot FROM reservation AS r LEFT JOIN reservation_time_slot AS rt ON r.res_time_slot_id=rt.Id  WHERE t_date='".$date."'AND res_time_slot_id = '". $rest_time_slot_id . "'" ;
    $result = $conn->query($sql);
    var_dump($sql);
    var_dump($result);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $a_tables=$row["t_tables"];
        }
        header("Location: ../reservation.php?error3=full" );
        exit();
    }
    //I check the unused tables per day
    $sql = "SELECT t_tables FROM tables WHERE t_date='$date'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $a_tables=$row["t_tables"];
        }
    }
    else{$a_tables=20;} //default value
    //check tables up to 20  tables for each date
    
    $sql = "SELECT SUM(num_tables) FROM reservation WHERE rdate='$date' AND res_time_slot_id=' $rest_time_slot_id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $current_tables=$row["SUM(num_tables)"];
        }
    }
    if($current_tables + $tables > $a_tables){
        header("Location: ../reservation.php?error3=full");
    }
    else {
        $sql = "INSERT INTO reservation(num_guests, num_tables, rdate, time_zone, telephone, comment, user_fk, res_time_slot_id) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../reservation.php?error3=sqlerror1");
            exit();
        }
        else {       
            mysqli_stmt_bind_param($stmt, "ssssssss", $guests, $tables, $date, $time, $tele, $comments, $user, $id);
            mysqli_stmt_execute($stmt);
            header("Location: ../reservation.php?reservation=success");
            exit();
        }
    }
}

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

