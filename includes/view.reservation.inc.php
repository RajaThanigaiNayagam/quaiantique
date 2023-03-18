<?php

if(isset($_SESSION['user_id'])){
    
    require 'includes/dbh.inc.php';
    $user = $_SESSION['user_id'];
    $role = $_SESSION['role'];
    
    //role user
    if($role==1){
    $sql = "SELECT * FROM reservation WHERE user_fk = $user";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo
        '<table class="table table-hover table-responsive-sm text-center">
                <thead>
                    <tr>
                        <th scope="col">Nom et prénom</th>
                        <th scope="col">Invités</th>
                        <th scope="col">Date de réservation</th>
                        <th scope="col">Fuseau horaire</th>
                        <th scope="col">Téléphone</th>
                        <th scope="col">Date d\'enregistrement</th>
                        <th scope="col">commentaires</th>
                        <th scope="col">État</th>
                        <th class="table-danger" scope="col"></th>
                    </tr>
                </thead>';
            while($row = $result->fetch_assoc()) {
                echo
                "<tbody>
                    <tr>
                        <form action='includes/delete.php' method='POST'>
                            <input name='reserv_id' type='hidden' value=".$row["reserv_id"].">
                            <th scope='row'>".$row["f_name"]." ".$row["l_name"]."</th>
                            <td>".$row["num_guests"]."</td>
                            <td>".$row["rdate"]."</td>
                            <td>".$row["time_zone"]."</td>
                            <td>".$row["telephone"]."</td>
                            <td>".$row["reg_date"]."</td>
                            <td><textarea readonly>".$row["comment"]."</textarea></td>
                            <td>".$row["status"]."</td>
                            <td class='table-danger'><button type='submit' name='delete-submit' class='btn btn-danger btn-sm'>Annuler</button></td>
                        </form>
                    </tr>
                </tbody>";
            }   
        echo "</table>";
    }
    else {    echo "<p class='text-white text-center bg-danger'>Your reservation list is empty!<p>"; }
    }
    
    
    //role Admin 
    
    else if($role==2){
    $sql = "SELECT * FROM reservation";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo'
        <table class="table table-hover table-responsive-sm text-center">
            <thead>
                <tr>
                    <th scope="col" class="schedulehour">ID</th>
                    <th scope="col" class="schedulehour">Nom et prénom</th>
                    <th scope="col" class="schedulehour">Invités</th>
                    <th scope="col" class="schedulehour">Tables</th>
                    <th scope="col" class="schedulehour">Date de réservation</th>
                    <th scope="col" class="schedulehour">Fuseau horaire</th>
                    <th scope="col" class="schedulehour">Téléphone</th>
                    <th scope="col" class="schedulehour">Date d\'enregistrement</th>
                    <th scope="col" class="schedulehour">commentaires</th>
                    <th scope="col" class="schedulehour">État</th>
                </tr>
            </thead> ';
        while($row = $result->fetch_assoc()) {
            echo"
            <tbody>
                <tr>
                    <form action='includes/delete.php' method='POST'>
                        <input name='reserv_id' type='hidden' value=".$row["reserv_id"].">
                        <th scope='row' class='schedulehour'>".$row["reserv_id"]."</th> 
                        <td class='schedulehour'>".$row["f_name"]." ".$row["l_name"]."</td>
                        <td class='schedulehour'>".$row["num_guests"]."</td>
                        <td class='schedulehour'>".$row["num_tables"]."</td>
                        <td class='schedulehour'>".$row["rdate"]."</td>
                        <td class='schedulehour'>".$row["time_zone"]."</td>
                        <td class='schedulehour'>".$row["telephone"]."</td>
                        <td class='schedulehour'>".$row["reg_date"]."</td>
                        <td class='schedulehour'><textarea readonly>".$row["comment"]."</textarea></td>";
                        if ($row["status"] == 'Annulée') {
                            echo "<td class='schedulehour'><button class='reservupdatebutton' type='button'><a href=includes/delete.php?update-submit=1&reserv_id=".$row["reserv_id"]."&action=Approuvée>Annulée</button></td>";
                        }else{
                            echo "<td class='schedulehour'><button class='reservupdatebutton' type='button'><a href=includes/delete.php?update-submit=1&reserv_id=".$row["reserv_id"]."&action=Annulée>Approuvée</button></td>";
                        }
                    "</form>
                </tr>
            </tbody>";
            
        }   
        echo "</table>";
    }
    else {    
        echo "<p class='text-white text-center bg-danger'>Votre liste de réservation est vide !<p>"; }
    
    }
    
mysqli_close($conn);
}


