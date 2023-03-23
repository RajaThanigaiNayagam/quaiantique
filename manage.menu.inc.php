<?php
require "header.php";
//error_reporting(0);   //Désactiver tous les rapports d'erreurs


require 'includes/dbh.inc.php';
?>
<div class="container">
    <h4 class="text-center menuSubTitle">Gérer le menu<br></h4>
    <div class="col-md-12 offset-md-0">
    
    <?php      
    echo" <div style='text-align: right;'><button class='foodaddbutton' type='button'><a href='#menuform'>Ajouter le Menu</button></a></div><br><br>";
    /************************************************************************************/
    /*********************************  Liste des menu  *********************************/
    /************************************************************************************/
    if(isset($_SESSION['role']) ){$role=($_SESSION['role']); };  
    if( (isset($_SESSION['user_id']) && (isset($_SESSION['role']))  )) {
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
                            <td class='schedulehour'><button class='reservupdatebutton' type='button'><a href=edit.menu.inc.php?menuedit-submit=1&menu_id=".$row["Id"]."&signature=".$row["signature"]."&action=update>Éditer</button></td>
                            <td class='schedulehour'><button class='reservupdatebutton' type='button'><a href=includes/delete.php?menudelete-submit=1&menu_id=".$row["Id"]."&action=delete>Supprimer</button></td>
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
    /*********************************  Create new menu *********************************/     
    /************************************************************************************/
    if(isset($_SESSION['user_id'])){
        if($_SESSION['role']==2){
            if( isset($_POST['submit-addmenu'] ) ){
                echo '<h5 class="bg-danger text-center">Le nom du bouton "submit-addmenu" est cliqué</h5>';
            } else {
                if(isset($_GET['error6'])){
                    if($_GET['error6'] == "sqlerror1") {   //SQL Execution error
                        echo '<h5 class="bg-danger text-center">Erreur d\'ajouter le menu. Problème technique. Veuillez réessayer plus tard. !</h5>';
                    }
                    if($_GET['error6'] == "emptyfields") {  
                        echo '<h5 class="bg-danger text-center">Erreur, champs vides. '.$_GET['errormenufoods'] . ' </h5>';
                    }
                    if($_GET['error6'] == "invalidmenuname") {  
                        echo '<h5 class="bg-danger text-center">Erreur, champs vides</h5>';
                    }
                    if($_GET['error6'] == "invalidprice") {  
                        echo '<h5 class="bg-danger text-center">Erreur, champs vides</h5>';
                    }
                    if($_GET['error6'] == "invalidimage") {  
                        echo '<h5 class="bg-danger text-center">Erreur, champs vides</h5>';
                    }
                }
                if(isset($_GET['menu_delete'])){
                    if($_GET['menu_delete'] == "success") {   
                        echo '<h5 class="bg-success text-center">Le plat a été supprimé avec succès</h5>';
                    }
                    else if($_GET['menu_delete'] == "error") {   
                        echo '<h5 class="bg-success text-center">Erreur d\'ajouter la plat. Problème technique. Veuillez réessayer plus tard. !</h5>';
                    }
                }
                if(isset($_GET['updatemenu'])){
                    if($_GET['updatemenu'] == "success") {   
                        echo '<h5 class="bg-success text-center">Le plat a été soumis avec succès</h5>';
                    }
                    else if($_GET['updatemenu'] == "notsubmitted") {   
                        echo '<h5 class="bg-success text-center">Le plat n\'a pas été soumis avec succès</h5>';
                    }
                    else if($_GET['updatemenu'] == "sqlerror1") {   
                        echo '<h5 class="bg-success text-center">Erreur de modification du menu. Erreur technique. Veuillez réessayer plus tard. sqlerror !</h5>';
                    }
                    else if($_GET['updatemenufoods'] == "success") {   
                        echo '<h5 class="bg-success text-center">Le plat a été soumis avec succès...  Et aussi, les plats correspondent à ce menu...</h5>';
                    }
                }


                // FORM DATA GETS THE DATA OF THE NEW MENU FROM THE USER AND SEND IT TO MANAGE.MENU.INC.PHP
                echo'  
                <div class="menu-form">
                    <form action="includes\menu.inc.php" id="menuform" method="post">
                        <div class="row form-group">
                            <div class="col"><h4>Ajouter un nouveau menu</h4> </div>';   
                            //<div class="col" style="margin:0;text-align: right;"><button class="menutofood reservupdatebutton" type="button"><a href="manage.menu.inc.php">Gérer les plat</button></a></div>
                            echo'</div>
                        <input type="hidden" class="form-control" name="menuid" value="'. $_SESSION['user_id'] .'" required="required">
                        <div class="form-group">
                            <label>Entrez le nom du nouveau menu</label>
                            <input type="text" class="form-control" name="menuname" id="menuname" required="required">
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
                            <input class="form-control" list="foodOptions" id="foodid" name="menufood[]" placeholder="Les plats">
                            <select multiple id="foodoptions"  name="menufood[]">
                                <option selected>Sélectionner un ou plusieur plats</option>';

                            require 'includes/dbh.inc.php';  // connection to mySQL Server
                            //SQL query to read all datas from the table "foods"
                            //So that a menu can have multiple "main course" or "dessert" or "starter" or "Burger"
                            $sql = "SELECT f.name AS fname, f.Id AS id, c.name AS cname FROM foods f LEFT JOIN category AS c ON f.category_id=c.Id"; 
                            //$sql = "SELECT f.name AS fname, f.Id AS id FROM foods f "; 
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo '<option value="' . $row['Id'] . '">' . $row['cname'] .'&nbsp;&nbsp;&nbsp;&nbsp; '. $row['fname'] . '</option>';
                                }
                            }
                            echo'
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="submit-addmenu" id="submit-addmenu" class="btn btn-dark btn-lg btn-block">Ajouter le menu</button>
                        </div>
                    </form>
                    
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
