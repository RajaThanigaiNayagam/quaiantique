<?php
//require "../header.php";
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
//******************************** FIN DES FONCTION ********************* */


if(isset($_POST['submit-addfood'])) {//check whether the  submit button is clicked in the reservation page
    // connection to mysql database
    require 'dbh.inc.php';

    $user= $_SESSION['user_id'];
    $foodname= $_POST['foodname'];
    $foodimage= $_POST['foodimage'];
    $foodprice= $_POST['foodprice'];
    $foodcategory = $_POST['foodcategory'];
    $foodsignature = $_POST['foodsignature'];
    if ($_POST['foodsignature'] == 'on') {$foodsignature = 1;} else {$foodsignature = 0;}
    
    if(empty($foodname) || empty($foodimage) || empty($foodprice) || empty($foodcategory) ) {
        header("Location: ..\manage.food.inc.php?error6=emptyfields&submit-editfood=1");
        exit();
    } 
    else if(!preg_match('/^[a-z0-9áàâçéèêëïôöùü\s\-\,\!\?\.\;\/\:\%\*\(\)\"\'\&\+\=\°\€\£\$\@\_]+$/i', $foodname) || !between($foodname,2,200)) {
        header("Location: ..\manage.food.inc.php?error6=invalidfoodname&submit-editfood=1");
        exit();
    } else if(!preg_match(('/^[0-9]+(\.[0-9]{1,2})?$/'), $foodprice) || !between($foodprice,0,20)) {
        header("Location: ..\manage.food.inc.php?error6=invalidfoodprice&submit-editfood=1");
        exit();
    } else if(!between($foodimage,0,200) || !(is_filepath($foodimage))  ) {
        header("Location: ..\manage.food.inc.php?error6=invalidfoodimage&submit-editfood=1");
        exit();
    } else {
        
        var_dump($foodname);
        var_dump($foodimage);
        var_dump($foodprice);
        var_dump($foodcategory);
        var_dump($foodsignature);
        /* ******************************** checking whether the true  ******************************** */
        
        $tables[0]='foods';
                        
        $dataname[0]='name';
        $dataname[1]='price';
        $dataname[2]='image';
        $dataname[3]='signature';
        $dataname[4]='category_id';
        $menuid = "";
        $valueses[0]=$foodname;
        $valueses[1]=$foodprice;
        $valueses[2]=$foodimage;
        $valueses[3]=$foodsignature;
        $valueses[4]=$foodcategory;

        var_dump($tables);
        var_dump($dataname);
        var_dump($valueses);
        require "delete.php";
        if ( $inserttable($tables, $dataname, $menuid, $valueses)) {  
            header("Location: ..\manage.food.inc.php?addfood=success&submit-editfood=1");
            exit();
        } else {
            header("Location: ..\manage.food.inc.php?addfood=sqlerror1&submit-editfood=1");
            exit();
        }
        //$sql = "INSERT INTO foods(name, price, image, signature, category_id) VALUES(?, ?, ?, ?, ?)";
        //$stmt = mysqli_stmt_init($conn);
        //if(!mysqli_stmt_prepare($stmt, $sql)){
        //    header("Location: ..\manage.food.inc.php?error6=sqlerror1&submit-editfood=1");
        //    exit();
        //}
        //else {       
        //    mysqli_stmt_bind_param($stmt, "sssss", $foodname, $foodprice, $foodimage, $foodsignature, $foodcategory);
        //    if (mysqli_stmt_execute($stmt) ) {
        //        header("Location: ..\manage.food.inc.php?addfood=success&submit-editfood=1");
        //        exit();
        //    } else {
        //        header("Location: ..\manage.food.inc.php?addfood=sqlerror1&submit-editfood=1");
        //        exit();
        //    }
        //}
    } 
} else {
    header("Location: ..\manage.food.inc.php?addfood=notsubmitted&submit-editfood=1");
    exit();
}

mysqli_stmt_close($stmt);
mysqli_close($conn);

