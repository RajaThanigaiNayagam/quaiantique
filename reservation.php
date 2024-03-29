<?php
require "header.php";
?> 
<!-- end of nav bar -->
<br><br><br><br>
<div class="container">
    <h4 class="text-center"><br>Nouvelle réservation<br></h4>   
    <div class="row">
        <div class="col-md-8 formreservation ">  
            <?php
            if(isset($_SESSION['user_id'])){
                echo '<p class="text-white bg-dark text-center">Bienvenue '. $_SESSION['username'] .', Créez votre réservation ici!</p>';
                // Display the messages to the user where he entered the wrong info in the reservation FORM
                if(isset($_GET['error3'])){ 
                    if($_GET['error3'] == "sqlerror1") {   // Reservation form error handling
                        echo '<h5 class="bg-danger text-center">Erreur d\'exécuter la réservation. Problème technique. Veuillez réessayer plus tard. !</h5>';
                    }if($_GET['error3'] == "emptyfields") {   // Reservation form error handling
                        echo '<h5 class="bg-danger text-center">Remplissez tous les champs, veuillez réessayer !</h5>';
                    }
                    else if($_GET['error3'] == "invalidfname") {   
                        echo '<h5 class="bg-danger text-center">Prénom invalide, veuillez réessayer!</h5>';
                    }
                    else if($_GET['error3'] == "invalidlname") {   
                        echo '<h5 class="bg-danger text-center">Nom de famille invalide, veuillez réessayer!</h5>';
                    }
                    else if($_GET['error3'] == "invalidtele") {   
                        echo '<h5 class="bg-danger text-center">Numéro de téléphone invalide, veuillez réessayer!</h5>';
                    }
                    else if($_GET['error3'] == "invalidcomment") {   
                        echo '<h5 class="bg-danger text-center">Commentaire invalide, veuillez réessayer !</h5>';
                    }
                    else if($_GET['error3'] == "invalidguests") {   
                        echo '<h5 class="bg-danger text-center">Invités non valides, veuillez réessayer!</h5>';
                    }
                    else if($_GET['error3'] == "full") {   
                        echo '<h5 class="bg-danger text-center">Les réservations sont complètes pour cette date et ce fuseau horaire, veuillez réessayer!</h5>';
                    }
                    else if($_GET['error3'] == "restaurantclosed") {   
                        echo '<h5 class="bg-danger text-center">Le restaurant est fermé sur cette plage horaire. merci de choisir un autre horaire pour réserver votre table en consultant l\'horaire d\'ouverture</h5>';
                    }
                    else if($_GET['error3'] == "errornotimeslot") {   
                        echo '<h5 class="bg-danger text-center">Aucun créneau horaire n\'est trouvé pour votre heure de réservation préférée</h5>';
                    }
                    else if($_GET['error3'] == "errortimeslot") {   
                        echo '<h5 class="bg-danger text-center">Il y a une erreur dans le créneau horaire choisi</h5>';
                    }
                    else if($_GET['error3'] == "notsubmitted") {   
                        echo '<h5 class="bg-danger text-center">Le formulaire de réservation n\'est pas soumis en cliquant sur le bouton soumettre</h5>';
                    }
                }
                if(isset($_GET['reservation'])) {   
                    if($_GET['reservation'] == "success"){ 
                        echo '<h5 class="bg-success text-center">Votre réservation a réussi !</h5>';
                    }
                }
                echo'<br>
                <h6 class="text-center">Merci d\'avance de préciser en commentaire le nombre d\'enfants présent à table (s\'il y en a)!! 
                    Pour tout retard de plus de 20 min, votre table sera donnée à d\'autres clients !! Et aussi merci de nous indiquer 
                    si certains d\'entre vous ont des allergies a des aliments particuliers.</h6>';

                //reservation form  
                echo '   <div id="reservationform"></div><br><br>
                <div class="signup-form row formreservation">
                    <form action="includes/reservation.inc.php" method="post">
                    <div class="row formreservation">
                        <div class="form-group col-md-4">
                            <label>Entrez le nombre de Couverts</label>
                            <input type="number" class="form-control" min="1" name="num_guests" placeholder="Nombres des personnes" required="required">
                            <small class="form-text text-muted">La valeur minimale est 1</small>
                        </div><div style="width : 20px ;"></div>
                        <div class="form-group col-md-4">';
                            $currentDate = date('Y-m-d');
                            echo'<label>Entrez la date de reservation</label>
                            <input type="date" class="form-control" name="date" id="date" min="'.$currentDate.'" placeholder="Date" required="required">
                        </div>
                    </div>
                    <label>Cliquez sur le bouton en-bas pour choisir l\'heure de reservation</label>
                    <input name="time" type="text" id="reservresponse" value="">
                    <div class="row formreservation">';
                        require 'includes/dbh.inc.php';  // connection to mySQL Server
                        //SQL query to read all datas from the table "reservation_time_slot"
                        //So that the user can choose his time slot 
                        $midifirst = true;              //Variable to verify for the first time executioin do display the word "MIDI"
                        $midifirst = true;              //Variable to verify for the last time executioin do display the word "MIDI"
                        $soirfirst = true;              //Variable to verify for the first time executioin do display the word "SOIR"
                        $sql = "SELECT * FROM reservation_time_slot"; 
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            echo '<input name="nbtimeslot" type="hidden" id="nbtimeslot" value="' . $result->num_rows . '">';
                            while($row = $result->fetch_assoc()) {
                                if ( $row['midi'] ) {
                                    if ( $midifirst) { 
                                        echo 'MIDI &nbsp; &nbsp; &nbsp;';
                                        $midifirst = false;
                                    } 
                                    echo '<div class="form-group"> <button type="button" class="btn btn-danger btn-block" id="timebutton' . $row['Id'] . '" name="' . $row['Id'] . '">' . substr( $row['time_slot'], 0, -3) . '</button></div>&nbsp; &nbsp; &nbsp;';
                                } else {
                                    if ( $soirfirst) { 
                                        echo ' <div class="row formreservation">&nbsp;  SOIR &nbsp; &nbsp; ';
                                        $soirfirst = false;
                                    } 
                                    echo '<div class="form-group"> <button type="button" class="btn btn-danger btn-block" id="timebutton' . $row['Id'] . '" name="' . $row['Id'] . '">' . substr( $row['time_slot'], 0, -3) . '</button></div>&nbsp; &nbsp; &nbsp;';
                                }
                            }
                            echo '</div>';
                        }
                    echo ' </div></div>
                    <div class="row formreservation">
                        <div class="form-group">
                            <label>Entrez des commentaires supplémentaires</label>
                            <textarea class="form-control" name="comments" placeholder="commentaires" rows="3"></textarea>
                            <small class="form-text text-muted">Les commentaires doivent faire moins de 200 caractères</small>
                        </div> 
                    </div>     
                    <div class="row formreservation"">
                        <div class="form-group">
                            <label class="checkbox-inline"><input type="checkbox" required="required"> J\'accepte le <a href="#">Conditions d\'utilisation</a> &amp; <a href="#">politique de confidentialité</a></label>
                        </div>
                    </div>
                    <div class="row formreservation">
                        <div class="form-group">
                            <button type="submit" name="reserv-submit" id="reserv-submit" class="btn btn-dark">Soumettre la réservation</button>
                        </div>
                    </div>
                    </div>
                    </form>
                    <br><br>
                </div>  ';
            }
            else {
                echo '	<p class="text-center text-danger"><br>Vous n\'êtes pas connecté!<br></p>
                <p class="text-center">Pour faire une réservation, vous devez créer un compte!<br><br><p>';  
            }
            ?>    
        </div>
    </div>
</div>
<br><br>
<?php
require "footer.php";
?>