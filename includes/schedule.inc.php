<?php

//post schedule
if(isset($_POST['schedule'])){    
    require 'dbh.inc.php';
    $day= $_POST['day'];
    $opentime = $_POST['opentime'];
    $closetime = $_POST['closetime'];
    $eveningopentime = $_POST['eveningopentime'];
    $eveningclosetime = $_POST['eveningclosetime'];
    //if(empty($day) || empty($opentime) || empty($closetime) || empty($eveningclosetime) || empty($eveningopentime)) {
    if(empty($day)) {
        header("Location: ../schedule.php?error5=emptyfields");
        exit();
    }
    else{
        $sql = "SELECT day FROM schedule WHERE day=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../schedule.php?error5=sqlerror1");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $day);     //check if the day is already written!
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if($resultCheck != 0){
                $sql = "UPDATE schedule SET open_time=?, close_time=?, eveningopentime=?, eveningclosetime=? WHERE day=?";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)){  // error sql returns
                    header("Location: ../schedule.php?error5=sqlerror1");
                    exit();
                }                     
                mysqli_stmt_bind_param($stmt, "sssss", $opentime, $closetime, $eveningopentime, $eveningclosetime, $day);
                mysqli_stmt_execute($stmt);
                header("Location: ../schedule.php?schedule=success");
                exit();
            }
            else{
                $sql = "INSERT INTO schedule(day, open_time, close_time, eveningopentime, eveningclosetime) VALUES(?, ?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("Location: ../schedule.php?error5=sqlerror1");
                    exit();
                }                     
                mysqli_stmt_bind_param($stmt, "sssss", $day, $opentime, $closetime, $eveningopentime, $eveningclosetime);
                mysqli_stmt_execute($stmt);
                header("Location: ../schedule.php?schedule=success");
                exit();
            }
        }
    }
    //I close the connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}