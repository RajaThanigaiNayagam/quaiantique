
<?php
require "header.php";
//error_reporting(0);   //Désactiver tous les rapports d'erreurs
?>
<div class="container"><br><br><br><br><br><br>
    <h2 class="text-center menuTitle"><br>Notre carte<br></h2>
    <div class="col-md-12">
        <h3 class="text-center  menuSubTitle">Nos menus<br></h3>
        <?php 
        require 'includes/dbh.inc.php';
        //<----------------------------------------------------------->
        //<--                    Card section                 -------->
        //<----------------------------------------------------------->
        echo '
        <div class="container-fluid">';
            //SQL query to read all datas from the table "menu" to display in the menu
            $menusql = "SELECT * FROM menu";
            $menuresult = $conn->query($menusql); 
            if ($menuresult->num_rows > 0) {    
                while($menurow = $menuresult->fetch_assoc()) {
                    $menuid=$menurow['Id'];
                    //SELECT sum(r.num_tables) AS res_tables FROM reservation AS r LEFT JOIN reservation_time_slot AS rt ON r.res_time_slot_id=rt.Id  WHERE rdate='".$date."'AND res_time_slot_id = '". $rest_time_slot_id . "'" ;
                    $sql = "SELECT m.image AS menuimage, m.name AS menuname, m.price AS menuprice, f.name AS foodname, c.name as categoryname  FROM menu AS m INNER JOIN menu_foods AS mf ON mf.menu_id = m.Id INNER JOIN foods AS f ON mf.food_id=f.Id INNER JOIN category AS c ON f.category_id = c.Id WHERE m.Id=$menuid" ;
                    //$sql = "SELECT * FORM menu";
                    $counterstarter=0;
                    $counterburger=0;
                    $countermaincourse=0;
                    $counterdessert=0;
                    $counterboisson=0;
                    $menuname=$menurow['name'];
                    $menuprice=$menurow['price'];
                    $menuimage=$menurow['image'];

                    $result = $conn->query($sql); 
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                                if ($row['categoryname'] == 'Entrées') {$foodstarters[$counterstarter]=$row['foodname']; $counterstarter++;}
                                if ($row['categoryname'] == 'Burgers') {$foodburgers[$counterburger]=$row['foodname']; $counterburger++;}
                                if ($row['categoryname'] == 'Plats') {$foodmaincourses[$countermaincourse]=$row['foodname']; $countermaincourse++;}
                                if ($row['categoryname'] == 'Desserts') {$fooddesserts[$counterdessert]=$row['foodname']; $counterdessert++;}
                                if ($row['categoryname'] == 'Boisson') {$foodboissions[$counterboisson]=$row['foodname']; $counterboisson++;}
                        }
                    }
                    echo '
                    <section id="home">
                        <div  class="row">
                            <div class="col-lg-6 col-md-6 col-12 order-1 pt-5">
                                <h1 class="display-5 horaireSubTitle">' . $menuname . '</span> </h1>';
                                if ( $counterstarter > 0 ) {
                                    echo '<h3 class="display-5 sheduledaycenter"> Choix d\'une entrée</span> </h3>';
                                    for ($i=0; $i<$counterstarter; $i++) {
                                        echo '<h4 class="display-5 schedulehour">' . $foodstarters[$i] . '</span> </h4>';
                                    }
                                }
                                
                                if ( ( $counterburger > 0) ||  $countermaincourse > 0 ){
                                    echo '<h3 class="display-5 sheduledaycenter"> Choix d\'un plat</span> </h3>';
                                    for ($i=0; $i<$counterburger; $i++) {
                                        echo '<h4 class="display-5 schedulehour">' . $foodburgers[$i] . '</span> </h4>';
                                    }
                                    for ($i=0; $i<$countermaincourse; $i++) {
                                        echo '<h4 class="display-5 schedulehour">' . $foodmaincourses[$i] . '</span> </h4>';
                                    }
                                }
                                
                                if ( $counterdessert ){
                                    echo '<h3 class="display-5 sheduledaycenter"> Choix d\'un dessert</span> </h3>';
                                    for ($i=0; $i<$counterdessert; $i++) {
                                        echo '<div class="display-5 schedulehour">' . $fooddesserts[$i] . '</span> </div>';
                                    }
                                }

                                if ( $counterboisson > 0){
                                    echo '<h3 class="display-5 sheduledaycenter"> Choix d\'un boisson</span> </h3>';
                                    for ($i=0; $i<$counterboisson; $i++) {
                                        echo '<div class="display-5" schedulehour>' . $foodboissions[$i] . '</span> </div>';
                                    }
                                }

                                echo '<h4 class="my-lg-2 my-3 sheduledaycenter">prix du menu  : &nbsp;&nbsp;' . $menuprice . '</h4>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 py-lg-0 py-3 order-sm-2"><br><br><br>
                                <img src="' . $menuimage . '" class="img-fluid">
                            </div>
                        </div>
                    </section>';
                }
            } else { echo '<h5 class="bg-danger text-center">Travaux sur le site. Veuillez réessaie plus tard....</h5>'; }



            //SQL query to read all datas from the table "plat" to display in the menu
            echo ' <br><br><h1 class="text-center">Nos Plats</h1> 
            <section id="service">
                <div class="row">';
                    $sql = "SELECT * FROM foods" ;
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        $compteur=1;
                        while($row = $result->fetch_assoc()) {
                            echo '
                            <div class="col-md-4">
                                <div class="card shadow">
                                    <img src="' . $row['image'] . '" class="rounded ">
                                    <div class="card-body">
                                        <h5 class="card-title">' . $row['name'] . '</h5>
                                        <div class="card-text">Prix : ' . $row['price'] . '</div>
                                    </div>
                                </div>';
                                //$compteur=$compteur+1; card-img-top menuimage
                                //if ( fmod($compteur, 3)  == 0 ) {echo'</div>  <div class="row">';}
                                echo '
                            </div>';
                        }
                    }
                echo '</div>
             </section>   
        </div> 
    </div>
</div>';
?>;
<br><br>
