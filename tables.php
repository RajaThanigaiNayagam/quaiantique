<?php
require "header.php";
?>

<br><br>
<div class="container">
    <h4 class="text-center"><br>Modifier les tables<br></h4>
    <div class="col-md-6 offset-md-3">
        <?php 
        if(isset($_SESSION['user_id'])){
            if($_SESSION['role']==2){
                echo '<p class="text-white bg-dark text-center">Définir le nombre de tables pour une date précise</p><br>';
                if(isset($_GET['error4'])){
                    if($_GET['error4'] == "sqlerror1") {   //erreur SQL
                        echo '<h5 class="bg-danger text-center">Erreur</h5>';
                    }
                    if($_GET['error4'] == "emptyfields") {  
                        echo '<h5 class="bg-danger text-center">Erreur, champs vides</h5>';
                    }
                }
                if(isset($_GET['tables'])){
                    if($_GET['tables'] == "success") {   
                        echo '<h5 class="bg-success text-center">Les tableaux ont été soumis avec succès</h5>';
                    }
                }
                echo'                                 
                <div class="signup-form">
                    <form action="includes/tables.inc.php" method="post">
                        <div class="form-group">
                            <label>Entrez la date</label>
                            <input type="date" class="form-control" name="date_tables" placeholder="Date">
                        </div>
                        <div class="form-group">
                            <label>Nombre de tables</label>
                            <input type="number" class="form-control" min="1" name="num_tables" required="required">
                            <small class="form-text text-muted">Le nombre par défaut est 20</small>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="tables" class="btn btn-dark btn-lg btn-block">Soumettre des tables</button>
                        </div>
                    </form>
                    <br><br>
                </div> ';
            }
        }                
        else {
            echo '	<p class="text-center"><br>Vous n\'avez aucune autorisation!<br><br></p>';          
        }      
        ?>
    </div>
</div>
<br><br>

<?php
require "footer.php";
?>