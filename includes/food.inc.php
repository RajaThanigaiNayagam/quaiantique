<?php
require "../header.php";
session_start();
//error_reporting(0);   //Désactiver tous les rapports d'erreurs

//php function to check, if the characters of the variable "$val" are within the limits of "$x" and "$y"
function between($val, $x, $y){
    $val_len = strlen($val);
    return ($val_len >= $x && $val_len <= $y)?TRUE:FALSE;
}

//the function is_filepath($path) is to check the file path of the image entered
function is_filepath($path)
{
    $path = trim($path);
    if(preg_match('/^[^*?"<>|:]*$/',$path)) return true; // good to go

    if(!defined('WINDOWS_SERVER'))
    {
        $tmp = dirname(__FILE__);
        if (strpos($tmp, '/', 0)!==false) define('WINDOWS_SERVER', false);
        else define('WINDOWS_SERVER', true);
    }
    /*first, we need to check if the system is windows*/
    if(WINDOWS_SERVER)
    {
        if(strpos($path, ":") == 1 && preg_match('/[a-zA-Z]/', $path[0])) // check if it's something like C:\
        {
            $tmp = substr($path,2);
            $bool = preg_match('/^[^*?"<>|:]*$/',$tmp);
            return ($bool == 1); // so that it will return only true and false
        }
        return false;
    }
    //else // else is not needed
         return false; // that t
}



if(isset($_POST['submit-addfood'])) {//check whether the  submit button is clicked in the reservation page
    // connection to mysql database
    require 'dbh.inc.php';

    $user= $_SESSION['user_id'];
    $foodname= $_POST['foodname'];
    $foodimage= $_POST['foodimage'];
    $foodprice= $_POST['foodprice'];
    $foodcategory = $_POST['foodcategory'];
    $foodsignature = $_POST['foodsignature'];
    var_dump($foodname);
    var_dump($foodimage);
    var_dump($foodprice);
    var_dump($foodcategory);
    if(empty($foodname) || empty($foodimage) || empty($foodprice) || empty($foodcategory) ) {
        header("Location: ..\manage.food.inc.php?error6=emptyfields");
        exit();
    } 
    else if(!preg_match("/^[a-zA-Z ]*$/", $foodname) || !between($foodname,2,200)) {
        header("Location: ..\manage.food.inc.php?error6=invalidfoodname");
        exit();
    } else if(!preg_match(('/^[0-9]+(\.[0-9]{1,2})?$/'), $foodprice) || !between($foodprice,0,20)) {
        header("Location: ..\manage.food.inc.php?error6=invalidprice");
        exit();
    } else if(!between($foodimage,0,200) || !(is_filepath($foodimage))  ) {
        header("Location: ..\manage.food.inc.php?error6=invalidimage");
        exit();
    } else {
        ///* ************************* To count the count record in the table "food"  ************************* */
        //$sql = "SELECT sum(r.num_tables) AS res_tables FROM menu AS r LEFT JOIN menu_foods AS rt ON r.res_time_slot_id=rt.Id  WHERE rdate='".$date."'AND res_time_slot_id = '". $rest_time_slot_id . "'" ;
        //$sql = "SELECT count(Id) AS tot_tables FROM foods";
        //$result = $conn->query($sql);
        //if ($result->num_rows > 0) {
        //    while($row = $result->fetch_assoc()) {
        //        $nb_tables=intval($row['tot_tables']);
        //    }
        //}
        ///* ********************** End of the count record in the table "food"  ********************** */

        /* ******************************** checking whether the true  ******************************** */
        if (false){
            header("Location: ..\manage.food.inc.php?error6=price&numbtable=".$price);
        }
        else {
            $sql = "INSERT INTO foods(name, price, image, signature, category_id) VALUES(?, ?, ?, ?, ?)";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)){
                var_dump($mysqli_stmt_prepare);
                header("Location: ..\manage.food.inc.php?error6=sqlerror1");
                exit();
            }
            else {       
                mysqli_stmt_bind_param($stmt, "sssss", $foodname, $foodprice, $foodimage, $foodsignature, $foodcategory);
                if (mysqli_stmt_execute($stmt) ) {
                    header("Location: ..\manage.food.inc.php?addmenu=success");
                    exit();
                } else {
                    header("Location: ..\manage.food.inc.php?addmenu=sqlerror1");
                    exit();
                }
            }
        }
    } 
} else {
    header("Location: ..\manage.food.inc.php?addmenu=notsubmitted");
    exit();
}

mysqli_stmt_close($stmt);
mysqli_close($conn);

