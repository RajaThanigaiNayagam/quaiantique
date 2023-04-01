<?php

if(isset($_SESSION['user_id'])){
    
    require 'includes/dbh.inc.php';
    $user = $_SESSION['user_id'];
    $role = $_SESSION['role'];

    //role user
    if ( ($role==1) || ($_GET['ownreservation']==1) ){
    $sql = "SELECT r.reserv_id AS reserv_id, r.num_guests AS num_guests, r.num_tables AS num_tables, r.rdate AS rdate, r.reg_date AS reg_date, r.comment AS comment, r.status AS status, u.f_name AS f_name, u.l_name AS l_name, u.telephone AS telephone FROM reservation AS r INNER JOIN users AS u ON r.user_fk = u.user_id WHERE r.user_fk = $user";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo
        '<table class="table table-hover table-responsive-sm text-center">
                <thead>
                    <tr>
                        <th scope="col" class="schedulehour">Nom et prénom</th>
                        <th scope="col" class="schedulehour">Invités</th>
                        <th scope="col" class="schedulehour">Date de réservation</th>
                        <th scope="col" class="schedulehour">Fuseau horaire</th>
                        <th scope="col" class="schedulehour">Téléphone</th>
                        <th scope="col" class="schedulehour">Date d\'enregistrement</th>
                        <th scope="col" class="schedulehour">commentaires</th>
                        <th scope="col" class="schedulehour">État</th>
                        <th class="schedulehour" scope="col"></th>
                    </tr>
                </thead>';
            while($row = $result->fetch_assoc()) {
                echo
                "<tbody>
                    <tr>
                        <form action='includes/delete.php' method='POST'>
                            <input name='reserv_id' type='hidden' value=".$row["reserv_id"].">
                            <th scope='row'>".$row["f_name"]." ".$row["l_name"]."</th>
                            <td class='schedulehour'>".$row["num_guests"]."</td>
                            <td class='schedulehour'>".$row["rdate"]."</td>
                            <td class='schedulehour'>".$row["time_zone"]."</td>
                            <td class='schedulehour'>".$row["telephone"]."</td>
                            <td class='schedulehour'>".$row["reg_date"]."</td>
                            <td class='schedulehour'><textarea readonly>".$row["comment"]."</textarea></td>
                            <td class='schedulehour'>".$row["status"]."</td>
                            <td class='schedulehour'>
                                <button class='reservupdatebutton' type='button' onclick='return confirm('Etes-vous sûr que vous voulez supprimer?');'><a href=includes/delete.php?delete-submit=1&reserv_id=".$row["reserv_id"]."&action=delete>Supprimer
                                </button>
                            </td>
                        </form>
                    </tr>
                </tbody>";
            }   
        echo "</table>";
    }
    else {    echo "<p class='text-white text-center bg-danger'>Votre réservation est vide !<p>"; }
    }
    
    
    //role Admin 
    
    else if( ($role==2) && ($_GET['ownreservation']<>1) ){
    $sql = "SELECT r.reserv_id AS reserv_id, r.num_guests AS num_guests, r.num_tables AS num_tables, r.rdate AS rdate, r.reg_date AS reg_date, r.comment AS comment, r.status AS status, u.f_name AS f_name, u.l_name AS l_name, u.telephone AS telephone FROM reservation AS r INNER JOIN users AS u ON r.user_fk = u.user_id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo'
        <table class="table table-hover table-responsive-sm text-center">
            <thead>
                <tr>
                    <th scope="col" class="schedulehour">Nom et prénom</th>
                    <th scope="col" class="schedulehour">Invités</th>
                    <th scope="col" class="schedulehour">Tables</th>
                    <th scope="col" class="schedulehour">Date de réservation</th>
                    <th scope="col" class="schedulehour">Téléphone</th>
                    <th scope="col" class="schedulehour">Date d\'enregistrement</th>
                    <th scope="col" class="schedulehour">commentaires</th>
                    <th scope="col" class="schedulehour">État</th>
                    <th scope="col" class="schedulehour">Supprimer</th>
                </tr>
            </thead> ';
        while($row = $result->fetch_assoc()) {
            echo"
            <tbody>
                <tr>
                    <form action='includes/delete.php' method='POST'>
                        <input name='reserv_id' type='hidden' value=".$row["reserv_id"].">
                        <td class='schedulehour'>".$row["f_name"]." ".$row["l_name"]."</td>
                        <td class='schedulehour'>".$row["num_guests"]."</td>
                        <td class='schedulehour'>".$row["num_tables"]."</td>
                        <td class='schedulehour'>".$row["rdate"]."</td>
                        <td class='schedulehour'>".$row["telephone"]."</td>
                        <td class='schedulehour'>".$row["reg_date"]."</td>
                        <td class='schedulehour'><textarea readonly>".$row["comment"]."</textarea></td>";
                        if ($row["status"] == 'Annulée') {
                            echo "<td class='schedulehour'><button class='reservupdatebutton' type='button'><a href=includes/delete.php?update-submit=1&reserv_id=".$row["reserv_id"]."&action=Approuvée>Annulée</button></td>";
                        }else{
                            echo "<td class='schedulehour'><button class='reservupdatebutton' type='button'><a href=includes/delete.php?update-submit=1&reserv_id=".$row["reserv_id"]."&action=Annulée>Approuvée</button></td>";
                        }                            
                        echo "<td class='schedulehour'>
                            <button class='reservupdatebutton' type='button' onclick='return confirm('Etes-vous sûr que vous voulez supprimer?');'><a href=includes/delete.php?delete-submit=1&reserv_id=".$row["reserv_id"]."&action=delete>Supprimer
                            </button>
                        </td>";
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


