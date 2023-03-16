
<div class="container">
    <h3 class="text-center menuTitle"><br>Gérer le menu<br></h3>
    <div class="col-md-6 offset-md-3">
    
    <?php 

    
    /************************************************************************************/
    /*********************************  Create new menu *********************************/
    /************************************************************************************/
    if(isset($_SESSION['user_id'])){
        if($_SESSION['role']==2){
            if( isset($_POST['submit-addmenu'] ) ){
                echo '<h5 class="bg-danger text-center">The button name "submit-addmenu" is clicked </h5>';
            } else {
                if(isset($_GET['error5'])){
                    if($_GET['error5'] == "sqlerror1") {   //SQL Execution error
                        echo '<h5 class="bg-danger text-center">Erreur</h5>';
                    }
                    if($_GET['error5'] == "emptyfields") {  
                        echo '<h5 class="bg-danger text-center">Erreur, champs vides</h5>';
                    }
                }
                if(isset($_GET['schedule'])){
                    if($_GET['schedule'] == "success") {   
                        echo '<h5 class="bg-success text-center">L\'horaire a été soumis avec succès</h5>';
                    }
                }
                // FORM DATA GETS THE DATA OF THE NEW MENU FROM THE USER AND SEND IT TO MANAGE.MENU.INC.PHP
                echo'  
                <div class="menu-form">
                    <form action="includes/view.menu.php" id="menuform" method="post">
                        <div class="form-group">
                            <h4>Nouveau menu</h4>
                        </div>
                        <div class="form-group">
                            <label>Entrez le nom du nouveau menu</label>
                            <input type="text" class="form-control" name="manuname" id="manuname" required="required">
                        </div>
                        <div class="form-group">
                            <label>Entrez l\'image du menu avec le chemin complet</label>
                            <input type="text" class="form-control" name="menuimage" id="menuimage" required="required">
                        </div>
                        <div class="form-group">
                            <label for="menuprice">Prix du menu</label>
                            <input type="number" class="form-control" name="menuprice" id="menuprice" step="any" required="required">
                        </div>
                        <div class="form-group">
                            <label for="foodid" class="form-label">Choisissez un ou plusieurs plats principaux</label>
                            <input class="form-control" list="dayOptions" id="foodid" name="day" placeholder="Les plats principaux">
                            <select multiple id="dayOptions">
                                <option selected>Sélectionner le jour</option>';

                            require 'includes/dbh.inc.php';  // connection to mySQL Server
                            //SQL query to read all datas from the table "foods"
                            //So that a menu can have multiple "main course" or "dessert" or "starter" or "Burger"
                            $sql = "SELECT * FROM foods"; 
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                                }
                            }
                            echo'
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="submit-addmenu" id="addmenu" class="btn btn-dark btn-lg btn-block">Ajouter le menu</button>
                        </div>
                    </form>

                    
                    
                    <script>
                        $("#submit-addmenu").on(
                            "change",
                            function(event) {
                                console.log($("#menuprice").val());
                                if( document.querySelector("menuform").checkValidity() ) {
                                    console.log($("#menuprice").val());

                                    var menuprice_to_2_decimals =
                                        parseFloat($("#price_per_year").val()).toFixed(2);

                                    console.log(price_to_2_decimals);
                                    $("#price_per_year").val(menuprice_to_2_decimals);
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

<?php

?>