<?php
require "../header.php";
require 'dbh.inc.php';

//php function to delete all the foods of a menu
function deletemenufoods($menufoodsid){
    require 'dbh.inc.php';
    $deletemenufoodssql = "DELETE FROM menu_foods WHERE menu_id =$menufoodsid";
    if (mysqli_query($conn, $deletemenufoodssql)) {
        mysqli_close($conn);
        return true;
    } else {
        mysqli_close($conn);
        return false;
    }
}


//update reservation done by admin
if(isset($_GET['update-submit'])) {
    $action =  $_GET['action'];
    $reservation_id = $_GET['reserv_id'];
    $sql = "UPDATE reservation SET status='".$action."' WHERE reserv_id =$reservation_id";
    if (mysqli_query($conn, $sql)) {
        header("Location: ../view_reservations.php?update=success&action=".$action."&sql=".$sql);
        exit;
    } else {
        header("Location: ../view_reservations.php?update=error&action=".$action."&sql=".$sql);
        exit;
    }
} 


//delete réservation un user ou admin peut supprimer sa propre réservation saisie auparavant
if(isset($_GET['delete-submit'])) {
    $reservation_id = $_GET['reserv_id'];
    $sql = "DELETE FROM reservation WHERE reserv_id =$reservation_id";
    if (mysqli_query($conn, $sql)) {
        header("Location: ../view_reservations.php?delete=success");
        exit;
    } else {
        header("Location: ../view_reservations.php?delete=error");
        exit;
    }
} 


// ******************** delete tables ******************** //
if(isset($_POST['delete-table'])) {
    $tables_id = $_POST['tables_id'];
    $sql = "DELETE FROM tables WHERE tables_id =$tables_id";
    if (mysqli_query($conn, $sql)) {
        header("Location: ../view_tables.php?delete=success");
        exit;
    } else {
        header("Location: ../view_tables.php?delete=error");
        exit;
    }
}


// ******************* delete a food  ******************* //
if(isset($_GET['fooddelete-submit'])) {
    $action =  $_GET['action'];
    $foodid = $_GET['food_id'];
    $sql = "DELETE FROM foods WHERE Id =$foodid";
    if (mysqli_query($conn, $sql)) {
        header("Location: ../manage.food.inc.php?fooddelete=success");
        exit;
    } else {
        header("Location: ../manage.food.inc.php?fooddelete=error");
        exit;
    }
}


// ******************* delete a menu  ******************* //
if(isset($_GET['menudelete-submit'])) {
    $action =  $_GET['action'];
    $menuid = $_GET['menu_id'];
    $sql = "DELETE FROM menu WHERE Id =$menuid";
    if (mysqli_query($conn, $sql)) {
        header("Location: ../manage.menu.inc.php?menudelete=success");
        exit;
    } else {
        header("Location: ../manage.menu.inc.php?menudelete=error");
        exit;
    }
} 



// ************* delete all food of a menu  ************** //
if(isset($_GET['menufoodsdelete'])) {
    $action =  $_GET['action'];
    $menuid = $_GET['menu_id'];
    
    //check the existance of foods assigned to a menu
    $menufoodssql = "SELECT * FROM menu_foods WHERE Id = $menuid"; 
    $menufoodsresult = $conn->query($sql);
    if ($menufoodsresult->num_rows > 0) {
        $menufoodsalreadexist=true;
        while($row = $menufoodsresult->fetch_assoc()) {
            if ($row['menu_id'] > 0) {deletemenufoods($menuid);}
        }
    }

    $sql = "DELETE FROM menu WHERE Id =$menuid";
    if (mysqli_query($conn, $sql)) {
        header("Location: ../manage.menu.inc.php?menu_delete=success");
        exit;
    } else {
        header("Location: ../manage.menu.inc.php?menu_delete=error");
        exit;
    }
} 



mysqli_close($conn);
?>

    


