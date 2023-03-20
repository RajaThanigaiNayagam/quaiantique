<?php
require "header.php";
//error_reporting(0);   //Désactiver tous les rapports d'erreurs

?>
<br><br><br><br>
<div class="container">
    <h3 class="text-center menuTitle"><br>Éditer le plat<br></h3>
    <div class="col-md-8 offset-md-2">
    
    <br>
    
    <?php 
    /************************************************************************************/
    /**********************************  Edit new food **********************************/
    /************************************************************************************/
    if( isset($_SESSION['user_id'])  && isset($_GET['foodedit-submit'])  ){
        if($_SESSION['role']==2){
            if( isset($_POST['submit-addmenu'] ) ){
                echo '<h5 class="bg-danger text-center">Le nom du bouton "submit-addfood" est cliqué</h5>';
            } else {
                if(isset($_GET['error6'])){
                    // Display the messages to the user where he entered the wrong info in the reservation FORM
                    if($_GET['error6'] == "sqlerror1") {   // Reservation form error handling
                        echo '<h5 class="bg-danger text-center">Erreur d\'ajouter la plat. Problème technique. Veuillez réessayer plus tard. !</h5>';
                    }if($_GET['error6'] == "emptyfields") {   // Reservation form error handling
                        echo '<h5 class="bg-danger text-center">Remplissez tous les champs, veuillez réessayer !</h5>';
                    }
                    else if($_GET['error6'] == "invalidfoodname") {   
                        echo '<h5 class="bg-danger text-center">Le nom de plat est invalide, veuillez réessayer!</h5>';
                    }
                    else if($_GET['error6'] == "invalidprice") {   
                        echo '<h5 class="bg-danger text-center">Le prix du plat est invalide, veuillez réessayer!</h5>';
                    }
                    else if($_GET['error6'] == "foodimage") {   
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
                
                if (  isset($_GET['food_id']) ) { $foodid = $_GET['food_id']; } else {
                    header("Location: ..\manage.food.inc.php?error6=invalidfoodname");
                    exit();
                }

                require 'includes/dbh.inc.php';  // connection to mySQL Server
                $sql = "SELECT * FROM foods WHERE Id=$foodid "; 
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($menurow = $result->fetch_assoc()) {
                        if ( $menurow['Id'] == $foodid ) {
                            // FORM DATA GETS THE DATA OF THE NEW FOOD FROM THE USER AND SEND IT TO MANAGE.FOOD.INC.PHP
                            echo'  
                            <div class="menu-form">
                                <form action="includes\update.food.inc.php" id="foodform" method="post">
                                    <input type="hidden" class="form-control" name="food_id" id="food_id" value='. $_GET['food_id'] .'>
                                
                                    <div class="form-group">
                                        <h4>Ajouter un nouveau plat</h4>
                                    </div>
                                    <div class="form-group">
                                        <label>Entrez le nom du nouveau plat</label>
                                        <input type="text" class="form-control" name="foodname" id="foodname" required="required" value="' . $menurow["name"] . '">
                                    </div>
                                    <div class="form-group">
                                        <label>Entrez l\'image du plat avec le chemin complet</label>
                                        <input type="text" class="form-control" name="foodimage" id="foodimage" required="required"  value="' . $menurow["image"] . '">
                                    </div>
                                    <div class="form-group">
                                        <label for="menuprice">Prix du plat</label>
                                        <input type="number" class="form-control" name="foodprice" id="foodprice" step="any" required="required" value="' . $menurow["price"] . '">
                                    </div>
                                    <div class="form-group">
                                        <label for="categoryoptions" class="form-label">Choisissez une catégorie</label>';
                                        //<input class="form-control" list="categoryOptions" id="categoryid" name="foodcategory" placeholder="Catégorie." required="required">
                                        echo '<select class="form-control" id="categoryoptions" name="foodcategory">
                                            <option selected>Sélectionner un catégorie</option>';

                                            //SQL query to read all datas from the table "category"
                                            //So that a menu can have multiple "main course" or "dessert" or "starter" or "Burger"
                                            $sql = "SELECT * FROM category"; 
                                            $result = $conn->query($sql);
                                            if ($result->num_rows > 0) {
                                                while($row = $result->fetch_assoc()) {
                                                    if ($row["Id"] == $menurow["category_id"] ) { $selected = "selected"; } else { $selected = ""; }
                                                    echo '<option value="' . $row["Id"] . '" '. $selected . ' >' . $row["name"] . '</option>';
                                                }
                                            }
                                            if ($menurow["signature"] == "1" ) {  $checked = "checked"; } else { $checked = ""; }
                                        echo '</select>
                                    </div>  
                                    <div class="form-group">
                                        <label class="form-check-label" >Ajouter l\'image de plat sur le favori ...        ?</label>
                                        <input type="checkbox" class="form-check-input" name="foodsignature" id="foodsignature" style="text-align : right;"; ' . $checked . '>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" name="submit-editfood" id="addfood" class="btn btn-dark btn-lg btn-block">Éditer le plat</button>
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
?>
    </div>
</div>
<br><br>
