
<div class="container">
    <h3 class="text-center menuTitle"><br>Gérer le plat<br></h3>
    <div class="col-md-8 offset-md-2">
        
    <?php 
    /************************************************************************************/
    /*********************************  Create new food *********************************/
    /************************************************************************************/
    if(isset($_SESSION['user_id'])){
        if($_SESSION['role']==2){
            if( isset($_POST['submit-addmenu'] ) ){
                echo '<h5 class="bg-danger text-center">Le nom du bouton "submit-addfood" est cliqué</h5>';
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
                        echo '<h5 class="bg-success text-center">Le plat a été soumis avec succès</h5>';
                    }
                }
                // FORM DATA GETS THE DATA OF THE NEW FOOD FROM THE USER AND SEND IT TO MANAGE.FOOD.INC.PHP
                echo'  
                <div class="menu-form">
                    <form action="includes/view.menu.php" id="menufood" method="post">
                        <div class="form-group">
                            <h4>Ajouter un nouveau plat</h4>
                        </div>
                        <div class="form-group">
                            <label>Entrez le nom du nouveau plat</label>
                            <input type="text" class="form-control" name="foodname" id="foodname" required="required">
                        </div>
                        <div class="form-group">
                            <label>Entrez l\'image du plat avec le chemin complet</label>
                            <input type="text" class="form-control" name="platimage" id="platimage" required="required">
                        </div>
                        <div class="form-group">
                            <label for="menuprice">Prix du plat</label>
                            <input type="number" class="form-control" name="foodprice" id="foodprice" step="any" required="required">
                        </div>
                        <div class="form-group">
                            <label for="categoryid" class="form-label">Choisissez une catégorie</label>
                            <input class="form-control" list="categoryOptions" id="categoryid" name="category" placeholder="Catégorie.">
                            <select multiple id="categoryoptions">
                                <option selected>Sélectionner un catégorie</option>';

                            require 'includes/dbh.inc.php';  // connection to mySQL Server
                            //SQL query to read all datas from the table "category"
                            //So that a menu can have multiple "main course" or "dessert" or "starter" or "Burger"
                            $sql = "SELECT * FROM category"; 
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
