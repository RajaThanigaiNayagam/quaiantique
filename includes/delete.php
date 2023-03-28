<?php
//require "../header.php";
require 'dbh.inc.php';
error_reporting(0);   //Désactiver tous les rapports d'erreurs

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



//Insert into any table by sending table as array, data name as array and data values as array
function inserttable( $table, $dataname, $menuid, $datavalue){
    require 'dbh.inc.php';
    if (!empty($table)){
        $tables="";
        $counttables=sizeof($table);
        for ($i=0; $i<$counttables; $i++) {  //****** multiple food inserted for a menu.   One menu contains different varieties of foods*/
            if ($i<$counttables-1){$tables = $tables . $table[$i].", ";} else {$tables = $tables . $table[$i];}
        }
        $tables = $tables . ' ';
    }
    if (!empty($dataname)){
        $datanames="";
        $countdatanames=sizeof($dataname);
        for ($i=0; $i<$countdatanames; $i++) {  //****** multiple food inserted for a menu.   One menu contains different varieties of foods*/
            if ( !empty($dataname[$i]) ){
                if ($i<$countdatanames-1){$datanames = $datanames . $dataname[$i].", ";} else {$datanames = $datanames . $dataname[$i];}
            }
        }
        $datanames = $datanames . ' ';
    }
    echo '<h5 class="bg-success text-center">1 The table = '. $table .'  dataname = '. $dataname .' datavalue = '. $datavalue .' menuid = '. $menuid .'</h5>';

    if (!empty($datavalue)){
        $datavalues = $menuid. ", ";
        $countdatavalues=sizeof($datavalue);
        if ($countdatavalues <> 1){
            for ($i=0; $i<$countdatavalues; $i++) {  //****** multiple food inserted for a menu.   One menu contains different varieties of foods*/
                if ( !empty($datavalue[$i]) ){
                    if ($i<$countdatavalues-1){$datavalues = $datavalues . $datavalue[$i].", "; } else {$datavalues = $datavalues . $datavalue[$i];}
                    //$datavalueq=$datavalueq.'?';
                }
            }
        } else {
            $datavalues = $datavalues . $datavalue;
        }
        $datavalues = $datavalues . ' ';
    }                            
    
    echo '<h5 class="bg-success text-center">2 The table = '. $table .'  dataname = '. $dataname .' datavalue = '. $datavalue .' menuid = '. $menuid .'</h5>';

    if ( (!empty($tables)) && (!empty($datanames)) && (!empty($datavalues)) && (!empty($menuid)) ){
        $insertsql = 'INSERT INTO ' . $tables . '(' . $datanames . ') VALUES('.  $datavalues .')';
        $conn->query($insertsql);
        //mysqli_close($conn);
        return true;
    } else {
        //mysqli_close($conn);
        return false;
    }
    mysqli_close($conn);
}


//update reservation done by admin
if(isset($_GET['update-submit'])) {
    $action =  $_GET['action'];
    $reservation_id = $_GET['reserv_id'];
    $sql = "UPDATE reservation SET status='".$action."' WHERE reserv_id =$reservation_id";
    if (mysqli_query($conn, $sql)) {
        mysqli_close($conn);
        header("Location: ../view_reservations.php?update=success&action=".$action."&sql=".$sql);
        exit;
    } else {
        mysqli_close($conn);
        header("Location: ../view_reservations.php?update=error&action=".$action."&sql=".$sql);
        exit;
    }
} 


//delete réservation un user ou admin peut supprimer sa propre réservation saisie auparavant
if(isset($_GET['delete-submit'])) {
    $reservation_id = $_GET['reserv_id'];
    $sql = "DELETE FROM reservation WHERE reserv_id =$reservation_id";
    if (mysqli_query($conn, $sql)) {
        mysqli_close($conn);
        header("Location: ../view_reservations.php?delete=success");
        exit;
    } else {
        mysqli_close($conn);
        header("Location: ../view_reservations.php?delete=error");
        exit;
    }
} 


// ******************** delete tables ******************** //
if(isset($_POST['delete-table'])) {
    $tables_id = $_POST['tables_id'];
    $sql = "DELETE FROM tables WHERE tables_id =$tables_id";
    if (mysqli_query($conn, $sql)) {
        mysqli_close($conn);
        header("Location: ../view_tables.php?delete=success");
        exit;
    } else {
        mysqli_close($conn);
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
        mysqli_close($conn);
        header("Location: ../manage.food.inc.php?fooddelete=success&submit-editfood=1");
        exit;
    } else {
        mysqli_close($conn);
        header("Location: ../manage.food.inc.php?fooddelete=error&submit-editfood=1");
        exit;
    }
}


// ******************* delete a menu  ******************* //
if(isset($_GET['menudelete-submit'])) {
    $action =  $_GET['action'];
    $menuid = $_GET['menu_id'];
    $sql = "DELETE FROM menu WHERE Id =$menuid";
    if (mysqli_query($conn, $sql)) {
        mysqli_close($conn);
        header("Location: ../manage.menu.inc.php?menudelete=success&submit-editmenu=1");
        exit;
    } else {
        mysqli_close($conn);
        header("Location: ../manage.menu.inc.php?menudelete=error&submit-editmenu=1");
        exit;
    }
} 



// ************* delete all food of a menu  ************** //
if(isset($_GET['menufoodsdelete'])) {
    $action =  $_GET['action'];
    $menuid = $_GET['menu_id'];
    
    //check the existance of foods assigned to a menu
    $menufoodssql = "SELECT * FROM menu_foods WHERE Id = $menuid"; 
    $menufoodsresult = $conn->query($menufoodssql);
    if ($menufoodsresult->num_rows > 0) {
        $menufoodsalreadexist=true;
        while($row = $menufoodsresult->fetch_assoc()) {
            if ($row['menu_id'] > 0) {deletemenufoods($menuid);}
        }
    }

    $sql = "DELETE FROM menu WHERE Id =$menuid";
    if (mysqli_query($conn, $sql)) {
        mysqli_close($conn);
        header("Location: ../manage.menu.inc.php?menu_delete=success&submit-editmenu=1");
        exit;
    } else {
        mysqli_close($conn);
        header("Location: ../manage.menu.inc.php?menu_delete=error&submit-editmenu=1");
        exit;
    }
} 



mysqli_close($conn);
?>

    


