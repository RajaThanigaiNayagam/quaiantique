
<div class="container">
    <h3 class="text-center menuTitle"><br>Gérer le menu<br></h3>
    <div class="col-md-8 offset-md-2">
    
    <?php    
    /************************************************************************************/
    /*********************************  Liste des menu  *********************************/
    /************************************************************************************/
    if(isset($_SESSION['role']) ){$role=($_SESSION['role']);};  
    if(isset($_SESSION['user_id'])){
    if(isset($_SESSION['user_id'])){
        require 'includes/dbh.inc.php';
        if($role==2){
            $sql = "SELECT * FROM menu";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                echo'
                <table class="table table-hover table-responsive-sm text-center">
                    <thead>
                        <tr>
                            <th scope="col" class="schedulehour">ID</th>
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
                            <td class='schedulehour'><button class='reservupdatebutton' type='button'><a href=includes/delete.php?update-submit=1&reserv_id=".$row["_id"]."&action=Approuvée>Annulée</button></td>
                        </tr>
                    </tbody>";
                    
                }   
                echo "</table>";
            }
            else {    
                echo "<p class='text-white text-center bg-danger'>Votre liste de réservation est vide !<p>"; 
            }
        }
        
    /************************************************************************************/
    /*********************************  Create new menu *********************************/
    /************************************************************************************/
    if(isset($_SESSION['user_id'])){
        if($_SESSION['role']==2){
            if( isset($_POST['submit-addmenu'] ) ){
                echo '<h5 class="bg-danger text-center">Le nom du bouton "submit-addmenu" est cliqué</h5>';
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
                        echo '<h5 class="bg-success text-center">Le menu a été soumis avec succès</h5>';
                    }
                }
                // FORM DATA GETS THE DATA OF THE NEW MENU FROM THE USER AND SEND IT TO MANAGE.MENU.INC.PHP
                echo'  
                <div class="menu-form">
                    <form action="includes/view.menu.php" id="menuform" method="post">
                        <div class="row form-group">
                            <div class="col"><h4>Ajouter un nouveau menu</h4> </div>   
                            <div class="col" style="margin:0;text-align: right;"><button class="menutofood reservupdatebutton" type="button"><a href="view_food.php">Gérer les plat</button></a></div>
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
                            <label for="foodid" class="form-label">Choisissez un ou plusieurs plats pour le menu</label>
                            <input class="form-control" list="dayOptions" id="foodid" name="day" placeholder="Les plats">
                            <select multiple id="foodoptions">
                                <option selected>Sélectionner un ou plusieur plats</option>';

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
}    
}    
?>
    </div>
</div>
<br><br>
