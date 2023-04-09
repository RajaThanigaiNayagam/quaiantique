<?php
require "header.php";
?>

<div>here it is working at the level 1 ...</div>
<header class="header">
    <div class="row">
        <div class="col-md-12 text-center">
            <a class="logo"><img src="img/logo1.png" alt="logo"></a>
        </div>
        <div class="col-md-12 text-center">
            <button type="button" onclick="window.location.href='reservation.php'" class="btn btn-outline-light btn-lg"><em>Réserver votre table maintenant!</em></button>
        </div>
    </div>
</header>


<!--    ************  Read all the sinature dishes from the table "foods" ************    -->
<?php
$foodsignaturelist = array();
$foodnamelist = array();
$foodimagelist = array();
$foodlistcounter = 0;
require 'includes/dbh.inc.php';// connection to mySQL Server
//SQL query to read all datas from the table "schedule"
$sql = "SELECT name, image, signature FROM foods"; 
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $foodnamelist[$foodlistcounter] = $row['name'];
        $foodimagelist[$foodlistcounter] = $row['image'];
        $foodsignaturelist[$foodlistcounter] = $row['signature'];
        $foodlistcounter++;
    }
}
//close connection
mysqli_close($conn);
//--    ************  Read all the sinature dishes from the table "foods" ************    -->
?>


<!--about us section   ************************  A propos de nous ************************ -->
<section id="aboutus">
    <div class="container"><br><br>
        <h3 class="text-center"><br><br>Quai Antique - À propos de nous</h3>
        <div class="row">
            <!--carousel-->
            <div class="col-sm"><br><br>
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel"> <!-- A Bootstrap slideshow component -->
                    <div class="carousel-inner">
                        <?php
                        $firstimage = true;
                        for ($i=0; $i<$foodlistcounter; $i++) {
                            if ($foodsignaturelist[$i] == 1){
                                if ($firstimage){echo '<div class="carousel-item active">';$firstimage=false;}else{echo '<div class="carousel-item">';}
                                echo '
                                <img class="d-block w-100" src=\'' .$foodimagelist[$i]. '\' title=\'' .$foodnamelist[$i]. '\' alt=\'' .$foodnamelist[$i]. '\'>
                                </div>';
                            }
                        }
                        ?>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Précédente</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Suivante</span>
                    </a>
                </div>
                <br><br>
            </div><!--end of carousel-->
            <div class="col-sm">
                <div class="arranging"><br><hr>
                    <h4 class="text-center">Notre histoire</h4>
                    <p><br>  Le restaurant Quai Antique, a ouvert ses portes en 2004 à « Chambéry », l'une des plus anciennes villes de France. En 2010, le restaurant a obtenu son premier certificat de meilleur restaurant et l'a conservée depuis.<br><br> 
                </div>
            </div>
        </div>
    </div>
</section>
<!--end of about us section-->

<!--<div class="header2"></div>-->

<!----gallery    ****************************  GALLERY  **************************** -->
<div class="gallery" id="gallery"><br><br><br>
    <div class="container">
        <h3 class="text-center"><br>Galerie</h3>
        <div class="d-flex flex-row flex-wrap justify-content-center">
            <?php
            for ($i=0; $i<$foodlistcounter; $i++) {
                if ($foodsignaturelist[$i] == 1){
                    echo '<div class="d-flex flex-column">
                    <img class="img-fluid" src=\'' .$foodimagelist[$i]. '\' title=\'' .$foodnamelist[$i]. '\' alt=\'' .$foodnamelist[$i]. '\'>
                    </div>';
                }
            }
            ?>
        </div>
    </div>
</div><br><br>
<!----end of gallery -->

<div class="container" id="reservation">
    <h4 class="text-center"><br><br><br><br>Réservation<br><br></h4>
    <img  src="img/tables.jpg" class="img-fluid rounded">
    <button type="button" onclick="window.location.href='reservation.php'" class="btn btn-outline-dark btn-block btn-lg">Réserver votre table maintenant!</button>
</div>

<!--<div class="header2"></div>-->


<!--OPEN HOURS    *************************** OPEN HOURS *************************** -->
<!-- main page opening and closing Hour  and Visit us section-->
<section id="footer">
    <div class="container">
        <div class="row staff">
            <div class="col-sm"><br><br><br>
                <div class="horaireTitle">Nos</div>
                <div class="horaireSubTitle">Horaires d'ouvertures</div>
                <div class="signup-form">
                    <?php
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
                                if ( ($row['open_time'] == '00:00:00' && $row['close_time'] == '00:00:00') || ( $row['eveningopentime'] == '00:00:00' || $row['eveningclosetime'] == '00:00:00' ) ) {
                                    echo " 
                                    <div class='row schedulehour'>
                                            <div class='col sheduleday'><em>". $row['day'] . "</em></div>
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
                                                <div class='col sheduleday'><em>". $row['day'] . "</em></div>
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
                        } else {
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
                        ?>
                </div><br>
            </div>
            <div class="col-sm"><br><br><br><br><br><br>
                <h4 class="text-right"><strong>Rendez nous visite</strong></h4>
                <p class="text-right">Quai Antique<br><i class="fa fa-map-marker"></i>&nbsp; Avenue du Général de Gaulle, <br>Chambéry<br><br>email: info_Quai_Antique@gmail.com<br>mobile: +00 (33) 612345678</p>
            </div>
	    </div>
    </div>
</section>
<!--end of main page map section-->
<?php
require "footer.php";
echo'<div>here it is working at the level lost ...</div>';
//close connection
mysqli_close($conn);
?>