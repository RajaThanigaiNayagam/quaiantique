<?php
require "header.php";
?>
    
<br><br>
<div class="container">
    <h4 class="text-center menuTitle"><br>Voir les menus</h4>    
    <div class="col-md-10 offset-md-1"> 
        <?php
        if(isset($_SESSION['user_id'])){
            if(isset($_GET['delete'])){
                if($_GET['delete'] == "error") {   //deletion error
                    echo '<h5 class="bg-danger text-center">Erreur!</h5>';
                }
                if($_GET['delete'] == "success"){
                    echo '<h5 class="bg-success text-center">La suppression d\'un menu a réussi</h5>';
                }
            }          
            if(isset($_GET['edit'])){
                if($_GET['edit'] == "error") {   //deletion error
                    echo '<h5 class="bg-danger text-center">Erreur!</h5>';
                }
                if($_GET['edit'] == "success"){ 
                    echo '<h5 class="bg-success text-center">La modification de menu est réussie.</h5>';
                }
            }          
            require 'manage.menu.inc.php';   
        }   
        else {
            echo '<p class="text-center"><br>Vous n\'avez aucune autorisation<br><br></p>';  
        }
        ?>
    </div>
</div>
<br><br>
<?php
require "footer.php";
?>