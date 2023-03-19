<?php
//require "../header.php";
require 'dbh.inc.php';

//update reservation done by admin
if(isset($_GET['update-submit'])) {
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
    $reservation_id = $_POST['reserv_id'];
    $sql = "DELETE FROM reservation WHERE reserv_id =$reservation_id";
    if (mysqli_query($conn, $sql)) {
        header("Location: ../view_reservations.php?delete=success");
    } else {
        header("Location: ../view_reservations.php?delete=error");
    }
}


// ******************** delete tables ******************** //
if(isset($_POST['delete-table'])) {
    $tables_id = $_POST['tables_id'];
    $sql = "DELETE FROM tables WHERE tables_id =$tables_id";
    if (mysqli_query($conn, $sql)) {
        header("Location: ../view_tables.php?delete=success");
    } else {
        header("Location: ../view_tables.php?delete=error");
    }
}



// ******************** update menu  ******************** //
if(isset($_POST['fooddelete-submit'])) {
    $action =  $_GET['action'];
    $menuid = $_POST['menu_id'];
    $sql = "DELETE FROM foods WHERE Id =$menuid";
    if (mysqli_query($conn, $sql)) {
        header("Location: ../manage.food.inc.php.php?platdelete=success");
    } else {
        header("Location: ../manage.food.inc.php.php?platdelete=error");
    }
}



mysqli_close($conn);
?>

    


