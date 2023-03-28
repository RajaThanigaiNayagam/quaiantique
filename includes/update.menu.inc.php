<?php
//require "../header.php";
//session_start();
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




if(isset($_POST['submit-editmenu'])) {//check whether the  submit button is clicked in the reservation page
    // connection to mysql database
    require 'dbh.inc.php';

    $user= $_SESSION['user_id'];
    $menu_id= $_POST['menu_id'];
    $menuname= $_POST['menuname'];
    $menuimage= $_POST['menuimage'];
    $menuprice= $_POST['menuprice'];
    $menufood= $_POST['menufood'];
    
    if(empty($menuname) || empty($menuimage) || empty($menuprice) || empty($menufood) ) {
        $errormenufoods="Mais les plats sont remplis.";
        echo '<h5 class="bg-danger text-center">1.1 some field not found!</h5>';
        //if(empty($menufood) ) {$errormenufoods="Les plats sont vides.";}  
        echo '<h5 class="bg-danger text-center">1.2 some field not found!</h5>';
        header("Location: ..\manage.menu.inc.php?error6=emptyfields&submit-editmenu=1&errormenufoods=".$errormenufoods);
        exit();
    } 
    else if(!preg_match("/^[a-z0-9áàâçéèêëïôöùü\s\-\,\!\?\.\;\/\:\%\*\(\)\"\'\&\+\=\°\€\£\$\@\_]+$/i", $menuname) || !between($menuname,2,200)) {
                            
        echo '<h5 class="bg-danger text-center">2 menu name error!</h5>';
        header("Location: ..\manage.menu.inc.php?error6=invalidmenuname&submit-editmenu=1");
        exit();
    } else if(!preg_match(('/^[0-9]+(\.[0-9]{1,2})?$/'), $menuprice) || !between($menuprice,0,20)) {
        echo '<h5 class="bg-danger text-center">3 menu price error!</h5>';
        header("Location: ..\manage.menu.inc.php?error6=invalidprice&submit-editmenu=1");
        exit();
    } else if(!between($menuimage,0,200) || !(is_filepath($menuimage))  ) {  
        echo '<h5 class="bg-danger text-center">4 menu image error!</h5>';
        header("Location: ..\manage.menu.inc.php?error6=invalidimage&submit-editmenu=1");
        exit();
    } else {
        /* ******************************** checking whether the true  ******************************** */
            $sql = "UPDATE menu SET name = '$menuname', price = '$menuprice' , image = '$menuimage' WHERE Id = $menu_id ";
            if ($conn->query($sql) ) {
                if (!empty($menufood)){
                    $countermenufoods=count($menufood);
                    $countermenufoodsupdated=0;
                    $menufoodsupdated= false;
                    if ($countermenufoods>0){
                        require "delete.php";
                        if ( deletemenufoods($menu_id) ) {
                            echo '<h5 class="bg-success text-center">The food exist in the menu deleted number of foods to add are = '. $countermenufoods .'  </h5>';
                        } else {
                            echo '<h5 class="bg-success text-center">There is no food exist in the menu deleted number of foods to add are = '. $countermenufoods .'  </h5>';
                        };
                        // Inserting all the food items of a menu  -  in the table "menu_foods"
                        $tables[0]='menu_foods';
                        
                        $dataname[0]='menu_id';
                        $dataname[1]='food_id';
                        $menuid = ($menu_id);
                        $countdatanames=count($dataname);       
                        $someFoodsAddedToMenu[0]='';
                        for ($i=0; $i<$countermenufoods; $i++) {  //****** multiple food inserted for a menu.   One menu contains different varieties of foods*/
                            $foodid = $menufood[$i];  //intval($menufood[$i]); 
                            if ( inserttable( $tables, $dataname, $menuid, $foodid) ) {
                                echo '<h5 class="bg-success text-center">some foods added to the menu...</h5>';
                            } else {
                                echo '<h5 class="bg-success text-center">There is no food added to the menu...</h5>';
                            };
                        }
                        mysqli_close($conn);
                        header("Location: ..\manage.menu.inc.php?updatemenu=success&submit-editmenu=1"); 
                        exit();
                    }
                }
                mysqli_close($conn);
                header("Location: ..\manage.menu.inc.php?updatemenu=success&submit-editmenu=1");   //&signature=".$_POST['menusignature']);
                exit();
            } else {
                $sqlerror = $conn->error;
                mysqli_close($conn);
                header("Location: ..\manage.menu.inc.php?updatemenu=sqlerror1&submit-editmenu=1&sqlerror=".$sqlerror);
                exit();
            }
    } 
} else {
    mysqli_close($conn);
    header("Location: ..\manage.menu.inc.php?updatemenu=notsubmitted&submit-editmenu=1");
    exit();
}

mysqli_stmt_close($stmt);
mysqli_close($conn);

