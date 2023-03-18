<?php
//require "../header.php";

//update reservation done by admin
if(isset($_GET['update-submit'])) {
    require 'dbh.inc.php';
    $action =  $_GET['action'];
    $reservation_id = $_GET['reserv_id'];
    $sql = "UPDATE reservation SET status='".$action."' WHERE reserv_id =$reservation_id";
    //var_dump($sql);
    if (mysqli_query($conn, $sql)) {
        header("Location: ../view_reservations.php?update=success&action=".$action."&sql=".$sql);
    } else {
        header("Location: ../view_reservations.php?update=error&action=".$action."&sql=".$sql);
    }
}


//delete réservation un user ou admin peut supprimer sa propre réservation saisie auparavant
if(isset($_POST['delete-submit'])) {
    require 'dbh.inc.php';
    $reservation_id = $_POST['reserv_id'];
    $sql = "DELETE FROM reservation WHERE reserv_id =$reservation_id";
    if (mysqli_query($conn, $sql)) {
        header("Location: ../view_reservations.php?delete=success");
    } else {
        header("Location: ../view_reservations.php?delete=error");
    }
}


//delete tables
if(isset($_POST['delete-table'])) {
    require 'dbh.inc.php';
    $tables_id = $_POST['tables_id'];
    $sql = "DELETE FROM tables WHERE tables_id =$tables_id";
    if (mysqli_query($conn, $sql)) {
        header("Location: ../view_tables.php?delete=success");
    } else {
        header("Location: ../view_tables.php?delete=error");
    }
}


mysqli_close($conn);
?>

    


