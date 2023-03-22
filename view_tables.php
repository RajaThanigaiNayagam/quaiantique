<?php
require "header.php";
?>
    
<br><br>
<div class="container">
    <h4 class="text-center menuTitle"><br>Voir les Tables<br></h4> 
    <?php
    if(isset($_SESSION['user_id'])){
        
        if(isset($_GET['delete'])){
            if($_GET['delete'] == "error") {   //deletion error
                echo '<h5 class="bg-danger text-center">Erreur!</h5>';
            }
            if($_GET['delete'] == "success"){ 
                echo '<h5 class="bg-success text-center">La suppression de la table a réussi</h5>';
            }
        }          
    require 'includes/view.tables.inc.php';   
    }   
    else {
        echo '<p class="text-center"><br>Vous n\'avez aucune autorisation<br><br></p>';  
    }
    ?>
</div>
<br><br>

<?php
require "footer.php";
?>