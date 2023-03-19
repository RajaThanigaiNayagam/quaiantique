
<?php
//require "header.php";
error_reporting(0);   //Désactiver tous les rapports d'erreurs
?>
<div class="container">
    <h3 class="text-center menuTitle"><br>Gérer le plat<br></h3>
    <div class="col-md-8 offset-md-2">
    
    <br>
    <?php 
    
    /************************************************************************************/
    /*********************************  Liste des menu  *********************************/
    /************************************************************************************/
    if(isset($_SESSION['role']) ){$role=($_SESSION['role']);};  
    if( (isset($_SESSION['user_id']) && (isset($_SESSION['role']))  )) {
        require 'includes/dbh.inc.php';
        if($role==2){
            $sql = "SELECT * FROM foods";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                echo'
                <table class="table table-hover table-responsive-sm text-center">
                    <thead>
                        <tr>
                            <th scope="col" class="schedulehour">Id</th>
                            <th scope="col" class="schedulehour">Nom </th>
                            <th scope="col" class="schedulehour">Prix de menu</th>
                            <th scope="col" class="schedulehour">Images</th>
                            <th scope="col" class="schedulehour">Date de creation</th>
                            <th scope="col" class="schedulehour">Éditer</th>
                            <th scope="col" class="schedulehour">Supprimer</th>
                        </tr>
                    </thead> ';
                while($row = $result->fetch_assoc()) {
                    echo"
                    <tbody>
                        <tr>
                            <th scope='row' class='schedulehour'>".$row["Id"]."</th> 
                            <td class='schedulehour'>".$row["name"]."</td>
                            <td class='schedulehour'>".$row["price"]."</td>
                            <td class='schedulehour'>".$row["image"]."</td>
                            <td class='schedulehour'>".$row["creationdate"]."</td>
                            <td class='schedulehour'><button class='reservupdatebutton' type='button'><a href=edit.food.inc.php?foodedit-submit=1&menu_id=".$row["Id"]."&action=update>Éditer</button></td>
                            <td class='schedulehour'><button class='reservupdatebutton' type='button'><a href=includes\delete.php?fooddelete-submit=1&menu_id=".$row["Id"]."&action=delete>Supprimer</button></td>
                        </tr>
                    </tbody>";
                    
                }   
                echo "</table>";
            }
            else {    
                echo "<p class='text-white text-center bg-danger'>Votre liste de réservation est vide !<p>"; 
            }
        }
    }   

    /************************************************************************************/
    /*********************************  Create new food *********************************/
    /************************************************************************************/
    if(isset($_SESSION['user_id'])){
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
                if(isset($_GET['platdelete'])){
                    if($_GET['menudelete'] == "success") {   
                        echo '<h5 class="bg-success text-center">Le plat a été supprimé avec succès</h5>';
                    }
                    else if($_GET['platdelete'] == "error") {   
                        echo '<h5 class="bg-success text-center">Le plat n\'a pas été soumis avec succès</h5>';
                    }
                    else if($_GET['addmenu'] == "error") {   
                        echo '<h5 class="bg-success text-center">Erreur d\'ajouter la plat. Problème technique. Veuillez réessayer plus tard. !</h5>';
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
                // FORM DATA GETS THE DATA OF THE NEW FOOD FROM THE USER AND SEND IT TO MANAGE.FOOD.INC.PHP
                echo'  
                <div class="menu-form">
                    <form action="includes\food.inc.php" id="foodform" method="post">
                        <div class="form-group">
                            <h4>Ajouter un nouveau plat</h4>
                        </div>
                        <div class="form-group">
                            <label>Entrez le nom du nouveau plat</label>
                            <input type="text" class="form-control" name="foodname" id="foodname" required="required">
                        </div>
                        <div class="form-group">
                            <label>Entrez l\'image du plat avec le chemin complet</label>
                            <input type="text" class="form-control" name="foodimage" id="foodimage" required="required">
                        </div>
                        <div class="form-group">
                            <label for="menuprice">Prix du plat</label>
                            <input type="number" class="form-control" name="foodprice" id="foodprice" step="any" required="required">
                        </div>
                        <div class="form-group">
                            <label for="categoryoptions" class="form-label">Choisissez une catégorie</label>';
                            //<input class="form-control" list="categoryOptions" id="categoryid" name="foodcategory" placeholder="Catégorie." required="required">
                            echo '<select class="form-control" id="categoryoptions" name="foodcategory">
                                <option selected>Sélectionner un catégorie</option>';

                                require 'includes/dbh.inc.php';  // connection to mySQL Server
                                //SQL query to read all datas from the table "category"
                                //So that a menu can have multiple "main course" or "dessert" or "starter" or "Burger"
                                $sql = "SELECT * FROM category"; 
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        echo '<option value="' . $row['Id'] . '">' . $row['name'] . '</option>';
                                    }
                                }
                            echo '</select>
                        </div>  
                        <div class="form-group">
                            <label class="form-check-label" for="foodsignature">Voulez vous ajouter l\'image de plat sur le favori ?...</label>
                            <input type="checkbox" class="form-check-input" name="foodsignature" id="foodsignature" script="margin : right;";>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="submit-addfood" id="addfood" class="btn btn-dark btn-lg btn-block">Ajouter le plat</button>
                        </div>
                    </form>
                    
                    
                    <script>
                        $("#addfood").on(
                            "change",
                            function(event) {
                                console.log($("#foodprice").val());
                                if( document.querySelector("foodform").checkValidity() ) {
                                    console.log($("#foodprice").val());

                                    var foodprice_to_2_decimals =
                                        parseFloat($("#foodprice").val()).toFixed(2);

                                    console.log(foodprice_to_2_decimals);
                                    $("#foodprice").val(foodprice_to_2_decimals);
                                } 
                            } 
                        );
                    </script>
                    <br><br>
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
