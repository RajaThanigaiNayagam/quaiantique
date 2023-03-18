<?php
require "header.php";
?>

<br><br><br>
<div class="container">
    <h4 class="text-center"><br>Modifier l'horaire<br></h4>
    <div class="col-md-8 offset-md-2">
    <?php 
    if(isset($_SESSION['user_id'])){
        if($_SESSION['role']==2){
            echo '<p class="text-white bg-dark text-center schedulehour">Définir le calendrier pour une date précise</p><br>';
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

                        require 'includes/dbh.inc.php';// connection to mySQL Server
                        //SQL query to read all datas from the table "schedule"
                        $sql = "SELECT * FROM schedule"; 
                        $result = $conn->query($sql);
                        echo"<div>";
                        if ($result->num_rows > 0) {
                            echo" 
                            <div class='row schedulehour'>
                                <div class='col sheduleday'>Jour</div>
                                <div class='col sheduleday'></div>
                                <div class='col sheduleday'>Horaire d'ouverture</div>
                                <div class='col sheduleday'>Heure de fermeture</div>
                            </div>";
                            while($row = $result->fetch_assoc()) {
                                if ( ($row['open_time'] == '00:00:00' && $row['close_time'] == '00:00:00') || ( $row['eveningopentime'] == '00:00:00' && $row['eveningclosetime'] == '00:00:00' ) ) {
                                    echo " 
                                    <div class='row schedulehour'>
                                            <div class='col sheduleday'>". $row['day'] . "</div>
                                            <div class='col'>Matin</div>";
                                            if ( ($row['open_time'] == '00:00:00' && $row[ 'close_time'] == '00:00:00') ) {
                                                echo"<div class='col scheduleData'></div>
                                                <div class='col scheduleData'>ferme</div>";
                                            } else {
                                                echo "<div class='col scheduleData'>".$row['open_time']."</div>
                                                <div class='col scheduleData'>".$row['close_time']."</div>";
                                            }

                                    echo " </div>
                                    <div class='row schedulehour'>
                                            <div class='col'><em> </em></div>
                                            <div class='col'>Après midi</div>";
                                            if ( $row['eveningopentime'] == '00:00:00' && $row['eveningclosetime'] == '00:00:00' )  {
                                                echo "<div class='col scheduleData'></div>
                                                <div class='col scheduleData'>fermé</div>"; 
                                            }else {
                                                echo "<div class='col scheduleData'>".$row['eveningopentime']."</div>
                                                <div class='col scheduleData'>".$row['eveningclosetime']."</div>";
                                            }
                                    echo " </div>";
                                }
                                else{
                                    echo " 
                                    <div class='row schedulehour'>
                                                <div class='col sheduleday'>". $row['day'] . "</div>
                                                <div class='col'>Matin</div>
                                                <div class='col scheduleData'>".$row['open_time']."</div>
                                                <div class='col scheduleData'>".$row['close_time']."</div>
                                    </div>
                                    <div class='row schedulehour'>
                                                <div class='col'><em> </em></div>
                                                <div class='col'>Après midi</div>
                                                <div class='col scheduleData'>".$row['eveningopentime']."</div>
                                                <div class='col scheduleData'>".$row['eveningclosetime']."</div>
                                    </div>";
                                }//echo"<br>";
                            }
                        }
                        else{
                            echo"
                            <table class='table table-sm table-striped table-dark text-center'>
                                <thead>
                                    <tr>
                                    <th scope='col'>Jour</th>
                                    <th scope='col'>Horaire d'ouverture</th>
                                    <th scope='col'>Heure de fermeture</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    <th scope='row'><em>". $date . "</em></th>
                                    <td>12:00</td>
                                    <td>22:00</td>
                                    </tr>
                                </tbody>
                            </table>";
                        }
                        echo"</div>";
                        //close connection
                        mysqli_close($conn);

            // FORM DATA GETS THE DATA FROM THE ADMIN AND SEND TO SCHEDULE.INC.PHP
            echo'  
            <br>
            <div class="signup-form">
                <form action="includes/schedule.inc.php" method="post">
                    <div class="form-group schedulehour">
                        <label for="weekdays" class="form-label">Enter le jour</label>
                        <input class="form-control" list="dayOptions" id="weekdays" name="day" placeholder="jour de la semaine" required="required">
                        <datalist id="dayOptions">
                            <option selected>Sélectionner le jour</option>
                            <option value="lundi">lundi</option>
                            <option value="mardi">mardi</option>
                            <option value="mercredi">mercredi</option>
                            <option value="jeudi">jeudi</option>
                            <option value="vendredi">vendredi</option>
                            <option value="samedi">samedi</option>
                            <option value="dimanche">dimanche</option>
                        </datalist>
                    </div>
                    <div class="form-group schedulehour">
                        <h4>Les horaires d\'aprèsmidi</h4>
                    </div>
                    <div class="form-group schedulehour">
                        <label>Heure d\'ouverture</label>
                        <input type="time" class="form-control" name="opentime" required="required">
                    </div>
                    <div class="form-group schedulehour">
                        <label>L\'heur de fermeture</label>
                        <input type="time" class="form-control" name="closetime" required="required">
                    </div>
                    <div class="form-group schedulehour">
                        <h4>Les horaires du soir</h4>
                    </div>
                    <div class="form-group schedulehour">
                        <label>Ouverture du soir</label>
                        <input type="time" class="form-control" name="eveningopentime" required="required">
                    </div>
                    <div class="form-group schedulehour">
                        <label>Fermeture du soir</label>
                        <input type="time" class="form-control" name="eveningclosetime" required="required">
                    </div>
                    <div class="form-group schedulehour">
                        <button type="submit" name="schedule" class="btn btn-dark btn-lg btn-block">Soumettre l\'horaire</button>
                    </div>
                </form>
                <br><br>
            </div>';       
        }            
    }       
    else {
        echo '<p class="text-center"><br>Vous n\'êtes pas autorisé<br><br></p>';  
    }           
?>
        
    </div>
</div>
<br><br>

<?php
require "footer.php";
?>