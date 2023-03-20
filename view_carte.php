
<?php
require "header.php";
error_reporting(0);   //Désactiver tous les rapports d'erreurs
?>
<div class="container">
    <h3 class="text-center menuTitle"><br>Notre carte<br></h3>
    <div class="col-md-12">
        <h4 class="text-center menuTitle"><br>Notre menus<br></h4>
        <br>
        <?php 
        require 'includes/dbh.inc.php';
        //<----------------------------------------------------------->
        //<--                    Home section                 -------->
        //<----------------------------------------------------------->
        echo '
        <div class="container-fluid">';
            //SQL query to read all datas from the table "menu" to display in the menu
            //SELECT sum(r.num_tables) AS res_tables FROM reservation AS r LEFT JOIN reservation_time_slot AS rt ON r.res_time_slot_id=rt.Id  WHERE rdate='".$date."'AND res_time_slot_id = '". $rest_time_slot_id . "'" ;
            $sql = "SELECT m.image, m.name, m.price FROM menu AS m INNER JOIN menu_foods AS mf ON mf.Id = m.Id INNER JOIN foods AS f mf.id=f.Id INNER JOIN category AS c f.Id = c.Id" ;
            //$sql = "SELECT * FORM menu";
            //var_dump($sql);
            $result = $conn->query($sql); 
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                var_dump($row['Id']);
                var_dump($row['name']);
                    echo '
                    <section id="home">
                        <div >
                            <div>
                                <h1 class="display-5">' . $row['name'] . '</span> </h1>



                                <p class="my-lg-2 my-3">' . $row['price'] . '</p>
                            </div>
                            <div>
                                <img src="' . $row['image'] . '" class="img-fluid">
                            </div>
                        </div>
                    </section>';
                }
            }

            //SQL query to read all datas from the table "plat" to display in the menu
            echo ' <h1 class="text-center">Notre Plat</h1> 
            <section id="service">
                <div class="row">';
                    $sql = "SELECT * FROM foods" ;
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        $compteur=1;
                        while($row = $result->fetch_assoc()) {
                            echo '
                            <div class="card shadow col">
                                <div class="card-body">
                                    <h5 class="card-title">' . $row['name'] . '</h5>
                                    <div class="card-text">Prix : ' . $row['price'] . '</div>
                                    <img src="' . $row['image'] . '" class="card-img-top rounded">
                                </div>
                            </div>';
                            $compteur=$compteur+1;
                            if ( fmod($compteur, 3)  == 0 ) {echo'</div>  <div class="row">';}
                        }
                    }
                echo '</div>
             </section>   
        </div> 
    </div>
</div>';
?>;
<br><br>
