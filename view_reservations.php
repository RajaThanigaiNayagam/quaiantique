<?php
require "header.php";
?>
    
<br><br><br><br>
<div class="container">
    <h4 class="text-center  menuTitle"><br>Voir les réservations<br></h4>    
    <div class="col-md-12 offset-md-0"> 
    <?php
    if(isset($_SESSION['user_id'])){
        if(isset($_GET['delete'])){
            if($_GET['update'] == "error") {   //Checking - delete reservation
                echo '<h5 class="bg-danger text-center">Error!</h5>';
            }
            if($_GET['update'] == "success"){ 
                echo '<h5 class="bg-success text-center">La modification de l\'état de réservation a réussi.</h5>';
            }
        }  
        require 'includes/view.reservation.inc.php';
        
    }
    else {
        echo '	<p class="text-center text-danger"><br>Vous n\'êtes pas connecté!<br></p>
        <p class="text-center">Pour faire une réservation, vous devez créer un compte!<br><br><p>';   
    }    
    ?>
</div>
<br><br>

<?php
require "footer.php";
?>