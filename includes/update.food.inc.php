<?php
//require "../header.php";
session_start();
error_reporting(0);   //Désactiver tous les rapports d'erreurs

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



if(isset($_POST['submit-editfood'])) {//check whether the  submit button is clicked in the reservation page
    // connection to mysql database
    require 'dbh.inc.php';

    $user= $_SESSION['user_id'];
    $food_id= $_POST['food_id'];
    $foodname= $_POST['foodname'];
    $foodimage= $_POST['foodimage'];
    $foodprice= $_POST['foodprice'];
    $foodcategory = $_POST['foodcategory'];
    if ($_POST['foodsignature'] == 'on') {$foodsignature = 1;} else {$foodsignature = 0;}
    
    if(empty($foodname) || empty($foodimage) || empty($foodprice) || empty($foodcategory) ) {
        header("Location: ..\manage.food.inc.php?error6=emptyfields&submit-editfood=1");
        exit();
    } 
    else if(!preg_match("/^[a-z0-9áàâçéèêëïôöùü\s\-\,\!\?\.\;\/\:\%\*\(\)\"\'\&\+\=\°\€\£\$\@\_]+$/i", $foodname) || !between($foodname,2,200)) {
        header("Location: ..\manage.food.inc.php?error6=invalidfoodname&submit-editfood=1");
        exit();
    } else if(!preg_match(('/^[0-9]+(\.[0-9]{1,2})?$/'), $foodprice) || !between($foodprice,0,20)) {
        header("Location: ..\manage.food.inc.php?error6=invalidprice&submit-editfood=1");
        exit();
    } else if(!between($menuimage,0,200) || !(is_filepath($menuimage))  ) {  
        header("Location: ..\manage.food.inc.php?error6=invalidimage&submit-editfood=1");
        exit();
    } else {
        /* ******************************** checking whether the true  ******************************** */
        if (false){
            header("Location: ..\manage.food.inc.php?error6=price&submit-editfood=1&numbtable=".$price);
        }
        else {
            $sql = "UPDATE foods SET name = '$foodname', price = '$foodprice' , image = '$foodimage', signature = '$foodsignature', category_id = '$foodcategory' WHERE Id = $food_id ";
            if ($conn->query($sql) ) {
                header("Location: ..\manage.food.inc.php?updatefood=success&submit-editfood=1&signature=".$_POST['foodsignature']);
                exit();
            }else {
                $sqlerror = $conn->error;
                header("Location: ..\manage.food.inc.php?updatefood=sqlerror1&submit-editfood=1&sqlerror=".$sqlerror);
                exit();
            }
        }
    } 
} else {
    header("Location: ..\manage.food.inc.php?updatefood=notsubmitted&submit-editfood=1");
    exit();
}

mysqli_stmt_close($stmt);
mysqli_close($conn);

