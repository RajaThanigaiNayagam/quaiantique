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


if(isset($_POST['submit-addmenu'])) {//check whether the  submit button is clicked in the reservation page
    // connection to mysql database
    require 'dbh.inc.php';

    $user= $_SESSION['user_id'];
    $menuid = $_POST['menuid'];
    $menuname= $_POST['menuname'];
    $menuimage= $_POST['menuimage'];
    $menuprice= $_POST['menuprice'];
    $menufood = $_POST['menufood'];

    //check the existance of foods assigned to a menu
    $sql = "SELECT * FROM menu_foods WHERE Id = $menuid"; 
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $menufoodsalreadexist=true;
        while($row = $result->fetch_assoc()) {

            //echo '<option value="' . $row['Id'] . '">' . $row['name'] . '</option>';
        }
    }


    if(empty($menuname) || empty($menuimage) || empty($menuprice) || empty($menufood) ) {
        header("Location: ..\manage.menu.inc.php?error6=emptyfields");
        exit();
    } 
    else if(!preg_match('/^[a-z0-9áàâçéèêëïôöùü\s\-\,\!\?\.\;\/\:\%\*\(\)\"\'\&\+\=\°\€\£\$\@\_]+$/i', $menuname) || !between($menuname,2,200)) {
        header("Location: ..\manage.menu.inc.php?error6=invalidmenuname");
        exit();
    } else if(!preg_match(('/^[0-9]+(\.[0-9]{1,2})?$/'), $menuprice) || !between($menuprice,0,20)) {
        header("Location: ..\manage.menu.inc.php?error6=invalidprice");
        exit();
    } else if(!between($menuimage,0,200) || !(is_filepath($menuimage))  ) {
        header("Location: ..\manage.menu.inc.php?error6=invalidimage");
        exit();
    } else {

        /* ******************************** checking whether the true  ******************************** */
        $sql = "INSERT INTO menu(name, price, image) VALUES(?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ..\manage.menu.inc.php?error6=sqlerror1");
            exit();
        }
        else {       
            mysqli_stmt_bind_param($stmt, "sss", $menuname, $menuprice, $menuimage);
            if (mysqli_stmt_execute($stmt) ) {
                $menuid = mysqli_stmt_insert_id($stmt);
                if ( count($menufood) > 0 ) {
                    $stmtmenufoods = $conn->prepare("INSERT INTO menu_foods(menu_id, food_id) VALUES(?, ?)" );
                    for ($i=0; $i<count($menufood); $i++) {  //****** multiple food inserted for a menu.   One menu contains different varieties of foods*/
                        $foodid = $menufood[$i];
                        if ($foodid>0){
                            $stmtmenufoods->bind_param('ss', $menuid, $foodid );
                            $stmtmenufoods->execute();
                        }
                    }
                    header("Location: ..\manage.menu.inc.php?addmenu=success");
                } else {
                    header("Location: ..\manage.menu.inc.php?error6=sqlerror1");
                    exit();
                }
            } else {
                header("Location: ..\manage.menu.inc.php?addmenu=sqlerror1");
                exit();
            }
        }
    } 
} else {
    header("Location: ..\manage.menu.inc.php?addmenu=notsubmitted");
    exit();
}

mysqli_stmt_close($stmt);
mysqli_close($conn);

