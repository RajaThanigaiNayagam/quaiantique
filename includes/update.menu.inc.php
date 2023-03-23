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
        header("Location: ..\manage.menu.inc.php?error6=emptyfields&errormenufoods=".$errormenufoods);
        exit();
    } 
    else if(!preg_match("/^[a-z0-9áàâçéèêëïôöùü\s\-\,\!\?\.\;\/\:\%\*\(\)\"\'\&\+\=\°\€\£\$\@\_]+$/i", $menuname) || !between($menuname,2,200)) {
                            
        echo '<h5 class="bg-danger text-center">2 menu name error!</h5>';
        header("Location: ..\manage.menu.inc.php?error6=invalidmenuname");
        exit();
    } else if(!preg_match(('/^[0-9]+(\.[0-9]{1,2})?$/'), $menuprice) || !between($menuprice,0,20)) {
        echo '<h5 class="bg-danger text-center">3 menu price error!</h5>';
        header("Location: ..\manage.menu.inc.php?error6=invalidprice");
        exit();
    } else if(!between($menuimage,0,200) || !(is_filepath($menuimage))  ) {  
        echo '<h5 class="bg-danger text-center">4 menu image error!</h5>';
        header("Location: ..\manage.menu.inc.php?error6=invalidimage");
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
                        deletemenufoods($menu_id);
                        echo '<h5 class="bg-danger text-center">6 menu deleted</h5>';
                        $stmtmenufoods = $conn->prepare("INSERT INTO menu_foods(menu_id, food_id) VALUES(?, ?)" );
                        for ($i=0; $i<$countermenufoods; $i++) {  //****** multiple food inserted for a menu.   One menu contains different varieties of foods*/
                            
                            echo '<h5 class="bg-danger text-center">6.1 menu deleted</h5>';
                            $foodid = intval($menufood[$i]);
                            echo '<h5 class="bg-danger text-center">6.2 menu deleted</h5>';
                            $menuid = intval($menu_id);
                            if ($foodid>0){
                                echo '<h5 class="bg-danger text-center">7 adding menu.  The nmber of menu is </h5>'.$countermenufoodsupdated .' and the food id is... ' . $foodid;
                                $stmtmenufoods->bind_param('ss', $menuid, $foodid );
                                $stmtmenufoods->execute();
                                $countermenufoodsupdated++;
                            }
                        }
                        if ($countermenufoodsupdated >= $countermenufoods ) {
                            echo '<h5 class="bg-danger text-center">7 some field not found!</h5>';
                            header("Location: ..\manage.menu.inc.php?updatemenufoods=success&signature=".$_POST['menusignature']);
                            exit();
                        } else {
                            $sqlerror = $conn->error;
                            echo '<h5 class="bg-danger text-center">2 some field not found...!</h5>'.$sqlerror;
                            header("Location: ..\manage.menu.inc.php?updatemenu=sqlerror1&sqlerror=".$sqlerror);
                            exit();
                        }
                    }
                }
                echo '<h5 class="bg-danger text-center">10 the foods of menu is field not found!</h5>';
                header("Location: ..\manage.menu.inc.php?updatemenu=success&signature=".$_POST['menusignature']);
                exit();
            }else {
                $sqlerror = $conn->error;
                header("Location: ..\manage.menu.inc.php?updatemenu=sqlerror1&sqlerror=".$sqlerror);
                exit();
              }
    } 
} else {
    header("Location: ..\manage.menu.inc.php?updatemenu=notsubmitted");
    exit();
}

mysqli_stmt_close($stmt);
mysqli_close($conn);

