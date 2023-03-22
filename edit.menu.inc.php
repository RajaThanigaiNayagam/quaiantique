<?php
require "header.php";
//error_reporting(0);   //Désactiver tous les rapports d'erreurs

?>
<br><br><br><br>
<div class="container">
    <h3 class="text-center menuTitle"><br>Éditer le plat<br></h3>
    <div class="col-md-12 offset-md-0">
    <br>
    <?php 
    /************************************************************************************/
    /**********************************  Edit new menu **********************************/
    /************************************************************************************/
    if( isset($_SESSION['user_id'])  && isset($_GET['menuedit-submit'])  ){
        if($_SESSION['role']==2){
            if( isset($_POST['submit-addmenu'] ) ){
                echo '<h5 class="bg-danger text-center">Le nom du bouton "submit-addmenu" est cliqué</h5>';
            } else {
                if(isset($_GET['error6'])){
                    // Display the messages to the user where he entered the wrong info in the reservation FORM
                    if($_GET['error6'] == "sqlerror1") {   // Reservation form error handling
                        echo '<h5 class="bg-danger text-center">Erreur d\'ajouter la plat. Problème technique. Veuillez réessayer plus tard. !</h5>';
                    }if($_GET['error6'] == "emptyfields") {   // Reservation form error handling
                        echo '<h5 class="bg-danger text-center">Remplissez tous les champs, veuillez réessayer !</h5>';
                    }
                    else if($_GET['error6'] == "invalidmenuname") {   
                        echo '<h5 class="bg-danger text-center">Le nom de plat est invalide, veuillez réessayer!</h5>';
                    }
                    else if($_GET['error6'] == "invalidprice") {   
                        echo '<h5 class="bg-danger text-center">Le prix du plat est invalide, veuillez réessayer!</h5>';
                    }
                    else if($_GET['error6'] == "menuimage") {   
                        echo '<h5 class="bg-danger text-center">Le nom ou le chemin de l\'image est invalide, veuillez réessayer!</h5>';
                    }
                }
                if(isset($_GET['addmenu'])){
                    if($_GET['addmenu'] == "success") {   
                        echo '<h5 class="bg-success text-center">Le plat a été soumis avec succès</h5>';
                    }
                    else if($_GET['addmenu'] == "notsubmitted") {   
                        echo '<h5 class="bg-success text-center">Le plat n\'a pas été soumis avec succès</h5>';
                    }
                    else if($_GET['addmenu'] == "sqlerror1") {   
                        echo '<h5 class="bg-success text-center">Erreur d\'ajouter la plat. Problème technique. Veuillez réessayer plus tard. !</h5>';
                    }
                }
                
                if (  isset($_GET['menu_id']) ) { $menuid = $_GET['menu_id']; } else {
                    header("Location: ..\manage.menu.inc.php?error6=invalidmenuname");
                    exit();
                }

                require 'includes/dbh.inc.php';  // connection to mySQL Server
                $sql = "SELECT * FROM menu WHERE Id=$menuid "; 
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($menurow = $result->fetch_assoc()) {
                        if ( $menurow['Id'] == $menuid ) {
                            // FORM DATA GETS THE DATA OF THE NEW MENU FROM THE USER AND SEND IT TO MANAGE.MENU.INC.PHP
                            echo'  
                            <div class="menu-form">
                                <form action="includes\update.menu.inc.php" id="menuform" method="post">
                                    <input type="hidden" class="form-control" name="menu_id" id="menu_id" value='. $_GET['menu_id'] .'>
                                
                                    <div class="form-group">
                                        <h4>Ajouter un nouveau plat</h4>
                                    </div>
                                    <div class="form-group">
                                        <label>Entrez le nom du nouveau plat</label>
                                        <input type="text" class="form-control" name="menuname" id="menuname" required="required" value="' . $menurow['name'] . '">
                                    </div>
                                    <div class="form-group">
                                        <label>Entrez l\'image du plat avec le chemin complet</label>
                                        <input type="text" class="form-control" name="menuimage" id="menuimage" required="required"  value="' . $menurow["image"] . '">
                                    </div>
                                    <div class="form-group">
                                        <label for="menuprice">Prix du plat</label>
                                        <input type="number" class="form-control" name="menuprice" id="menuprice" step="any" required="required" value="' . $menurow["price"] . '">
                                    </div>'; 
                                    
                                    //SQL query to read all datas of a given 'menu id' from the tables "menufoods" and "foods". The table "menufoods" is a temporary table  
                                    //because the tables "menu" and "foods" have m to n correspondence.
                                    //So that a "menu" can have multiple "main course" or "dessert" or "starter" or "Burger" of the table "foods" can many different foods.
                                    $counterfoods=0;
                                    $foodsinmenusql = "SELECT mf.food_id AS foodid FROM menu AS m INNER JOIN menu_foods AS mf ON mf.menu_id = m.Id WHERE m.Id=$menuid ORDER BY mf.food_id" ;
                                    $foodsinmenuresult = $conn->query($foodsinmenusql);
                                    if ($foodsinmenuresult->num_rows > 0) {
                                        while($foodsinmenurow = $foodsinmenuresult->fetch_assoc()) {
                                            $foodsinmenu[$counterfoods]=$foodsinmenurow['foodid']; 
                                            $counterfoods++;
                                        }
                                    }
                                    
                                    echo'
                                    <div class="form-group">
                                        <label for="foodid" class="form-label">Choisissez un ou plusieurs plats pour le menu</label>
                                        <input class="form-control" list="foodOptions" id="foodid" name="menufood[]" placeholder="Les plats">
                                        <select multiple id="foodoptions"  name="menufood[]">
                                            <option selected>Sélectionner un ou plusieur plats</option>';
                                            $foodssql = "SELECT * FROM foods ORDER BY Id"; 
                                            $foodsresult = $conn->query($foodssql);
                                            if ($foodsresult->num_rows > 0) {
                                                while($row = $foodsresult->fetch_assoc()) {
                                                    $foodsinmenifound=false;
                                                    for ($i=0; $i<$counterfoods; $i++) {
                                                        if ($foodsinmenu[$i] == $row['Id']) {
                                                            $foodsinmenifound=true;
                                                        }
                                                    }
                                                    if ($foodsinmenifound)  {
                                                        echo '<option value="' . $row["Id"] . '" selected >' . $row["name"] . '</option>';
                                                    } else {
                                                        echo '<option value="' . $row["Id"] . '">' . $row["name"] . '</option>';
                                                    }
                                                }
                                            }
                                        echo '</select>
                                    </div>  
                                    <div class="form-group">
                                        <button type="submit" name="submit-editmenu" id="addmenu" class="btn btn-dark btn-lg btn-block">Éditer le plat</button>
                                    </div>
                                </form>';
                            }
                        }
                    }
                    echo '<br><br>
                </div>';       
            }   
        }
        else {
            echo '<p class="text-center"><br>Vous n\'avez aucune autorisation<br><br></p>';  
        }  
    }   
    //var_dump($foodsinmenu);
    //for ($i=0; $i<$counterfoods; $i++) {
    //    var_dump($foodsinmenu[$i]);
    //    if ($foodsinmenu[$i] == $row['Id']) {
    //        $foodsinmenifound=true;
    //    } 
    //}        
?>
    </div>
</div>
<br><br>
